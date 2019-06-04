<?php
/**
 * 用户管理
 */

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Cookie;

class AccountController extends WebController {

    public function login_get() {
        $reurl = request()->get('reurl', '/');
        $pageData = array(
            'reurl' => $reurl
        );
        return view('/web/user/account_login', $pageData);
    }

    public function login_ajax_post() {
        $identity = request()->get('identity');

        $accessUser = env('ACCESS_IDENTITY', '');
        if (!empty($accessUser) && $accessUser == $identity) {
            $this->setUserWebCookie($accessUser);
            return $this->output([]);
        } else {
            return $this->error(-3001, '用户认证失败');
        }
    }

    public function signout_ajax_post() {
        $cookie = Cookie::forget('verify_user');
        Cookie::queue($cookie);

        return $this->output([]);
    }
}