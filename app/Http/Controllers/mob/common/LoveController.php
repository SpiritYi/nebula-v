<?php

namespace App\Http\Controllers\Mob\Common;

use App\Http\Controllers\Mob\MobController;

class LoveController extends MobController {

    public function tick_get() {
        $pageData = array(
            'love_time' => $this->_diffDate('2015/10/20', date('Y/m/d')),
        );
        return view('/mob/common/love_tick', $pageData);
    }

    private function _diffDate($date1, $date2) {
        $datetime1 = new \DateTime($date1);
        $datetime2 = new \DateTime($date2);
        $interval = $datetime1->diff($datetime2);
        $time['y']         = $interval->format('%Y');
        $time['m']         = $interval->format('%m');
        $time['d']         = $interval->format('%d');
        $time['h']         = $interval->format('%H');
        $time['i']         = $interval->format('%i');
        $time['s']         = $interval->format('%s');
        $time['a']         = $interval->format('%a');    // 两个时间相差总天数
        return $time;
    }
}