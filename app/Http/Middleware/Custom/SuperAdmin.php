<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Helpers\Qs;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            \Log::info('SuperAdmin middleware: User not authenticated');
            return redirect()->route('login');
        }
        
        if (!Qs::userIsSuperAdmin()) {
            \Log::info('SuperAdmin middleware: User is not super admin. User type: ' . Auth::user()->user_type);
            return redirect()->route('login');
        }
        
        \Log::info('SuperAdmin middleware: User authenticated and is super admin');
        return $next($request);
    }
}
