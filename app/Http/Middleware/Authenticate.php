<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (in_array('api', $guards)){
            if ($this->auth->guard('api')->guest()) {
                return message(false, [],'Unauthorized!', 401);
            }
            return $next($request);
        }
        return parent::handle($request, $next, $guards);
    }
}
