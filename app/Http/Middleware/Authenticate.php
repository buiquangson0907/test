<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Arr;
class Authenticate extends Middleware
{
    protected $guards;
    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;
        return parent::handle($request, $next, ...$guards);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('adminLogin');
    //     }
    // }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Arr::first($this->guards) === 'admin') {
                return route('adminLogin');
            }

            return route('/');
        }
    }
}
