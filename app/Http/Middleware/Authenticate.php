<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

     //ログインセッションが切れたらログイン画面へリダイレクトする
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('loginView');
        }
    }
}
