<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!isset($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])) {
            $this->die();
        }
        if($_SERVER['PHP_AUTH_USER'] !== env('BASIC_USER') || $_SERVER['PHP_AUTH_PW'] !== env('BASIC_PASS')) {
            $this->die();
        }
        
        // Basic認証の場合、$_SERVER['PHP_AUTH_USER'] と $_SERVER['PHP_AUTH_PW'] に認証用のユーザー名とパスワードが送信されてきます。
        // とパスワードと一致しない場合はdieメソッドを呼び出しています。
        
        return $next($request);
    }
    
    protected function die()
    {
        header('WWW-Authenticate:Basic realm="Enter username and password.');
        abort(401);
    }
}
