<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;


class isAdmin
{

    public function handle(Request $request, Closure $next): Response
    {

        $user = json_decode(Auth::user(), true);
        $role = $user['role'];

        if (Auth::check() && $role == 1) {
            return $next($request);
        }

        // If not an admin, redirect to the homepage (you can change this as needed)
        return redirect('/error');
    }
}
