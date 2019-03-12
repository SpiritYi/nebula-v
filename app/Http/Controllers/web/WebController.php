<?php
/**
 * web 页面基类
 */

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class WebController extends Controller {

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