<?php
/**
 * web 页面基类
 */

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Code_base\Frame\Ctx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class WebController extends Controller {

    /**
     * @var Ctx
     */
    protected $ctx = null;
    protected $verifyUser;

    public function __construct(Request $request) {
        $this->ctx = app('ctx_base');

        $verifyCookie = $request->cookie('verify_user');
        if (!empty($verifyCookie)) {
            $this->verifyUser = json_decode(Crypt::decrypt($verifyCookie), true);
        } else {
            $this->verifyUser = array(
                'username' => '',
                't' => 0,
            );
        }
    }

    public function loginUsername() {
        if (empty($this->verifyUser['username']) || time() - $this->verifyUser['t'] < 30 * 86400) {
            return '';
        }
        return $this->verifyUser['username'];
    }

    //登录注册成功后写用户cookie
    public function setUserWebCookie($username) {
        $cookieData = array(
            'username' => $username,
            't' => time(),
        );
        Cookie::queue('verify_user', json_encode($cookieData), 30 * 86400);
    }


    /**
     * ajax 接口输出数据调用
     * @param array|Object $data           //返回的data 里面的数据
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function output($data, $msg = 'success', $code = 0) {
        $jsonData = array(
            'ec' => $code,
            'em' => $msg,
            'data' => $data,
        );
        $GLOBALS['tart_webdata_log']['resp'] = $jsonData;       //记录到全局变量, 等shutdown 后记录日志

        return response()->json($jsonData, $code == 0 ? 200 : 400);
    }

    //出错时输出
    public function error($errorCode, $errorMsg, $data = []) {
        return $this->output($data, $errorMsg, $errorCode);
    }
}