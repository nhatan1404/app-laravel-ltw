<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Employee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = $request->user()->role;
        if ($role == 'admin' || $role == 'employee') {
            return $next($request);
        }
        request()->session()->flash('error', 'Bạn không có quyền truy cập vào đây');
        return redirect()->route(($request->user()->role));
    }
}
