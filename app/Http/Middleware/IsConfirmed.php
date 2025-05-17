<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsConfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (null === session('confirmed') || session('confirmed') !== 'true') {
            return redirect('/');
        } else /*(isset($_SESSION['confirmed']) && !empty($_SESSION['confirmed']) && $_SESSION['confirmed'] == "true")*/ {
            return $next($request);
        }
    }
}
