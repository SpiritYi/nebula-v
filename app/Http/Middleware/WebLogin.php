<?php
/**
 * web 登录控制
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cookie;

class WebLogin {

    public function handle($request, \Closure $next) {
        $verifyUser = array();
        $verifyCookie = Cookie::get('verify_user');
        if (!empty($verifyCookie)) {
            $verifyUser = json_decode($verifyCookie, true);
        }
        if (empty($verifyUser['username']) || time() - $verifyUser['t'] > 30 * 86400) {           //超过30天的web登录时间
            return redirect('/user/account/login?reurl=' . $_SERVER['REQUEST_URI']);
        }

        return $next($request);
    }
}
