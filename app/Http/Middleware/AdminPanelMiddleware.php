<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
//        if(!auth()->user()->is_admin == 1 || !auth()->user()->is_manager == 1) {
//            abort(404);
//        }
//
//        return $next($request);
//Не правильно отрабатывает Route admin-panel, не учитывает условие

        if (Auth::user()->is_admin == 1 || Auth::user()->is_manager == 1) {
            return $next($request);
        }

        return redirect('/')->with('error','You have not admin access');
    }
}
