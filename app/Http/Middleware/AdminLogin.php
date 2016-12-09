<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        //判断session,没有跳到登陆首页
        if(!session('user_info')){
            return redirect('admin/login');
        }

        return $next($request);
    }
}


interface Milldeware {
    public static function handle(Closure $next);
}

class VerfiyCsrfToekn implements Milldeware {

    public static function handle(Closure $next)
    {
        echo '验证csrf Token <br>';
        $next();
    }
}


class ShowErrorsFromSession implements Milldeware {

    public static function handle(Closure $next)
    {
        echo '共享session中的Error变量 <br>';
        $next();
    }
}

class StartSession implements Milldeware {

    public static function handle(Closure $next)
    {
        echo '开启session <br>';
        $next();
        echo '关闭ession <br>';
    }
}

class AddQueuedCookieToResponse implements Milldeware {

    public static function handle(Closure $next)
    {
        $next();
        echo '添加下一次请求需要的cookie <br>';
    }
}

class EncryptCookies implements Milldeware {
    public static function handle(Closure $next)
    {
        echo '解密cookie <br>';
        $next();
        echo '加密cookie <br>';
    }
}

class CheckForMaintenacceMode implements Milldeware {
    public static function handle(Closure $next)
    {
        echo '确定当前程序是否处于维护状态 <br>';
        $next();
    }
}

function getSlice() {
    return function($stack,$pipe) {
        return function() use($stack,$pipe){
            return $pipe::handle($stack);
        };
    };
}


function then() {
    $pipe = [
        'CheckForMaintenacceMode',
        'EncryptCookies',
        'AddQueuedCookieToResponse',
        'StartSession',
        'ShowErrorsFromSession',
        'VerfiyCsrfToekn'
    ];

    $firstSlice = function() {
        echo '请求向路由传递,返回相应 <br>';
    };

    $pipe = array_reverse($pipe);
    $callback = array_reduce($pipe,getSlice(),$firstSlice);

    call_user_func($callback);
}

then();