<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();
        if ($user->role == $roles) {
            // dd($roles);
            return $next($request);
        }
        return redirect('/login')->with('error', "kamu gak punya akses");

        // if (!session()->has('loggedInUser') && ($request->path() != 'login' && $request->path() != 'register')) {
        //     // dd('1');
        //     return redirect('/login');
        // }
        // if (session()->has('loggedInUser') && ($request->path() == 'login' || $request->path() == 'register')) {
        //     return back();
        // }

        // return $next($request)
        //     ->header('Chache-control', 'no-cache', 'no-store', 'max-age=0', 'must-revalidate')
        //     ->header('Pragma', 'no-cache')
        //     ->header('Expires', 'sat 01 jan 1990 00:00:00 GMT');
    }
}
