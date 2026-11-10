<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthorized
{
    /**
     * Handle an incoming request.
     * Enforce strict admin access restricted only to the designated owner email.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedAdminEmail = strtolower((string) config('app.admin_email', 'verdictlab@gmail.com'));
        $currentUser = $request->user();

        if (! $currentUser || strtolower((string) $currentUser->email) !== $allowedAdminEmail) {
            Log::warning('Unauthorized access attempt to admin area blocked', [
                'user_id' => $currentUser?->id,
                'email' => $currentUser?->email,
                'ip' => $request->ip(),
                'path' => $request->path(),
                'user_agent' => $request->userAgent(),
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Truy cập bị từ chối. Chỉ tài khoản quản trị viên duy nhất được phép truy cập.',
            ]);
        }

        return $next($request);
    }
}
