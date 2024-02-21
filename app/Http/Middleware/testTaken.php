<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class testTaken
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
        $testTaken = $user['test_taken'];

        if (Auth::check() && $role == 2 && $testTaken == 1) {
            return $next($request);
        }

        // If not an admin, redirect to the homepage (you can change this as needed)
        return redirect('/test');
    }
}
