<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class isTestReviewed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = json_decode(Auth::user(), true);
        $role = $user['role'];

        if (Auth::check() && $role == 1)
            return $next($request);


        $testTaken = $user['test_taken'];
        if (Auth::check() && $role == 2 && $testTaken == 0) {
            return redirect('/test');
        }
        if (Auth::check() && $role == 2 && $testTaken > 1) {
            return $next($request);
        }

        return redirect('/wait');
    }
}
