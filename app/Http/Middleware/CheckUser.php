<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (FacadesAuth::check()) {
            //            dd('dbgghds');
            //     $user = Auth::guard('user')->user();
            //     if ($user->status==1)
            //     {
            //         return $next($request);
            //     }
            //     else {
            //         Auth::logout();
            //         return redirect()->route('admin.login');
            //     }
            return redirect()->route('frontend.index');
        }

        return $next($request);
    }
}
