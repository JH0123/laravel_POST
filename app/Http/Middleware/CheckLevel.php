<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    /**
     * $role은 미들웨어 파라미터로 $next의 다음으로 받을 수 있다
     */
    {
        switch ($role) {
            case 'admin':
            case 'user':
                if (auth()->user()->user_lavel < config("ext.user.user_level.roles.{$role}.level")) {
                    return redirect('/');
                }
                break;
            default:
                return redirect('/');
                break;
        }
        return $next($request);
    }
}
