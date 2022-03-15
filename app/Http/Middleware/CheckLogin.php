<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check())
        {
//            dd('dbgghds');
            $admin = Auth::guard('admin')->user();
            if ($admin->status==1)
            {
                return $next($request);
            }
            else {
                Auth::logout();
                return redirect()->route('admin.login');
            }
        }

        return redirect()->route('admin.login');
    }
}
