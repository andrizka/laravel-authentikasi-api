<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $email = session('email');
        $user = User::where('email', $email)->first();
        if ($email !== null) {
            if ($email == $user->email) {
                return $next($request);
            } else {
                return redirect(url('logout'));
            }
        } else {
            return redirect(url('login'));
        }
    }
}
