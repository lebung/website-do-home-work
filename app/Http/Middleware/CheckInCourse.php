<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckInCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route()->parameter('id');
        if(!$request->user()->courses->contains($id)) abort(404);
        return $next($request);
    }
}
