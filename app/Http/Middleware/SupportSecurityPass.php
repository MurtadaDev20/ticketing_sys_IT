<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SupportSecurityPass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $support = Auth::guard('support')->user();

        if ($support && $support->security_pass == 0) {
            Auth::guard('support')->logout();
            toastr()->warning('Login Again');
            return redirect()->route('support.login');
        }
        return $next($request);
    }
}
