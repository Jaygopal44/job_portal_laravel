<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        // if (!auth()->check()) {
        //     return redirect('/account/login');
        // }

        if ($type === 'guest' && Auth::check()) {
            return redirect()->route('account.profile'); // Redirect authenticated users to the dashboard
        }

        if ($type === 'auth' && !Auth::check()) {
            return redirect()->route('account.login'); // Redirect guests to the login page
        }
        return $next($request);
    }
}
