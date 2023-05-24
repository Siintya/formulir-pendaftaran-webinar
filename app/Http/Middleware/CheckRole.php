<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$user_role)
    {
        // dd($request->user());
        if (in_array($request->user()->user_role_id, $user_role)) {
          return $next($request);
        }
        // jika tdk sesuai dg role yg ada akan dilempar ke hal. welcome
        return redirect('/login');
    }
}
