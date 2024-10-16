<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SupportStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $support = Auth::guard('support')->user();
        if ($support && $support->status == 1) {
            return $next($request);
        }
        Auth::guard('support')->logout();
        toastr()->warning('Your Account is Desable');
        return redirect()->back();
    }
}
