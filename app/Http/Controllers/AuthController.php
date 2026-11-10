<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập quản trị viên
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        // Lưu mốc thời gian hiển thị form để phát hiện bot tự động gửi form tức thì (< 1s)
        $request->session()->put('login_form_rendered_at', microtime(true));

        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập với các lớp bảo vệ chống Hacker, Brute-force, Bot & Khóa email ngoài luồng
     */
    public function login(Request $request)
    {
        // 1. Lớp phòng thủ 1: Honeypot ẩn (Bẫy bot cào tự động)
        if ($request->filled('website_url_hp')) {
            Log::warning('Hacker/Bot honeypot triggered on admin login', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'payload' => $request->input('website_url_hp'),
            ]);

            return back()->withErrors(['email' => 'Yêu cầu không hợp lệ. Truy cập bị từ chối.'])->withInput();
        }

        // 2. Lớp phòng thủ 2: Chống gửi form quá nhanh (< 1 giây) từ script tấn công tự động
        if (! app()->environment('testing') && $request->session()->has('login_form_rendered_at')) {
            $renderedAt = (float) $request->session()->get('login_form_rendered_at');
            if ((microtime(true) - $renderedAt) < 0.8) {
                Log::warning('Bot fast-submit detected on admin login', [
                    'ip' => $request->ip(),
                    'elapsed' => microtime(true) - $renderedAt,
                ]);

                return back()->withErrors(['email' => 'Phát hiện thao tác bất thường. Vui lòng thử lại.'])->withInput();
            }
        }

        // 3. Lớp phòng thủ 3: Giới hạn tần suất đăng nhập (Rate Limiting)
        // Tối đa 5 lần thử sai / 15 phút (900 giây) trên mỗi cặp Email + IP
        $throttleKey = $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            Log::alert('Admin login brute-force blocked', [
                'ip' => $request->ip(),
                'email' => $request->input('email'),
                'lockout_seconds' => $seconds,
            ]);

            throw ValidationException::withMessages([
                'email' => ["Hệ thống phát hiện dấu hiệu bất thường. Cổng quản trị đã tạm khóa bảo vệ trong {$minutes} phút. Vui lòng thử lại sau."],
            ]);
        }

        // 4. Validate dữ liệu đầu vào nghiêm ngặt
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:100'],
        ]);

        // 5. Lớp phòng thủ 4: CHỈ DUY NHẤT EMAIL QUẢN TRỊ VIÊN ĐƯỢC PHÉP ĐĂNG NHẬP
        $allowedAdminEmail = strtolower((string) config('app.admin_email', 'verdictlab@gmail.com'));
        $inputEmail = strtolower((string) $request->input('email'));

        if ($inputEmail !== $allowedAdminEmail) {
            RateLimiter::hit($throttleKey, 900);

            Log::warning('Unauthorized email attempt on admin login', [
                'attempted_email' => $inputEmail,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return back()->withErrors([
                'email' => 'Thông tin đăng nhập không chính xác hoặc bạn không có quyền truy cập.',
            ])->onlyInput('email');
        }

        // 6. Thực hiện xác thực thông tin tài khoản
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Đăng nhập thành công -> Xóa bộ đếm RateLimiter
            RateLimiter::clear($throttleKey);

            // Tái tạo session ID phòng chống tấn công Session Fixation
            $request->session()->regenerate();
            $request->session()->forget('login_form_rendered_at');

            Log::info('Admin user authenticated successfully', [
                'user_id' => Auth::id(),
                'email' => Auth::user()->email,
                'ip' => $request->ip(),
            ]);

            return redirect()->intended(route('admin.dashboard'));
        }

        // Đăng nhập thất bại -> Ghi nhận 1 lần thử sai, khóa 15 phút (900s) khi chạm 5 lần
        RateLimiter::hit($throttleKey, 900);

        Log::warning('Failed admin login attempt (incorrect password)', [
            'email' => $inputEmail,
            'ip' => $request->ip(),
        ]);

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác hoặc bạn không có quyền truy cập.',
        ])->onlyInput('email');
    }

    /**
     * Xử lý đăng xuất an toàn
     */
    public function logout(Request $request)
    {
        Log::info('Admin logged out', [
            'user_id' => Auth::id(),
            'ip' => $request->ip(),
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất an toàn khỏi hệ thống quản trị.');
    }

    /**
     * Tạo khóa định danh Rate Limiter kết hợp IP và Email
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower((string) $request->input('email')).'|'.$request->ip());
    }
}
