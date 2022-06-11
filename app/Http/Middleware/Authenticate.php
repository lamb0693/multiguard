<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    //내가 추가
    protected function authenticate($request, array $guards)
    {
        Log::info('authenticate@authenticate.php executed');
        var_dump($guards);

        if (empty($guards)) {
            $guards = [null];
        }

        // if(Auth::guard('seller')->check()) return $this->auth->shouldUse('seller');

        foreach ($guards as $guard) {

            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $this->unauthenticated($request, $guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Route::is('seller.*')) {
                return route('seller.login');
            }

            return route('login');
        }

    }
}
