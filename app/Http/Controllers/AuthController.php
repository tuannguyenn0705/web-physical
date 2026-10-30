<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập với bảo vệ chống Brute-force & Bot
     */
    public function login(Request $request)
    {
        // 1. Chống Bot bằng Honeypot
        if ($request->filled('website_url_hp')) {
            return back()->withErrors(['email' => 'Yêu cầu không hợp lệ.'])->withInput();
        }

        // 2. Rate Limiting: Tối đa 5 lần thử sai / 1 phút
        $throttleKey = $this->throttleKey($request);
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => ["Bạn đã thử đăng nhập sai quá nhiều lần. Vui lòng chờ {$seconds} giây trước khi thử lại."],
            ]);
        }

        // 3. Validate dữ liệu đầu vào nghiêm ngặt
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:100'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Đăng nhập thành công -> Xóa bộ đếm RateLimiter
            RateLimiter::clear($throttleKey);

            // Tái tạo session ID phòng chống Session Fixation
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        // Đăng nhập thất bại -> Ghi nhận 1 lần thử sai, khóa 60s khi chạm giới hạn
        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }

    /**
     * Xử lý đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất an toàn khỏi hệ thống.');
    }

    /**
     * Tạo khóa định danh Rate Limiter kết hợp IP và Email
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(Str::lower((string) $request->input('email')).'|'.$request->ip());
    }
}
