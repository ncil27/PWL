<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (Auth::check()) {
        //     $role = Auth::user()->role;

        //     return match ($role) {
        //         'admin' => redirect('/admin/dashboard'),
        //         'kaprodi' => redirect('/kaprodi/dashboard'),
        //         default => redirect('/dashboard'),
        //     };
        // }

        // return $next($request);

        if (Auth::user() != null && in_array(Auth::user()->id_role, $roles)){
            return $next($request);
        }
        return response(view('welcome'));
    }

}
