<?php

namespace Code_base\Base\Trade\Manager;

use Code_base\Frame\BaseFrame;

class Earn extends BaseFrame {

    const COMPANY_NUBULA = 'nebula';
    const COMPANY_SHANGZHENG = 'shangzheng';
    const COMPANY_CHUANGYE = 'chuangye';

    public static $COMPANY_CONFIG = array(
        self::COMPANY_NUBULA => array(
            'name' => '星云财富',
            'line_marker' => 'diamond',
        ),
        self::COMPANY_SHANGZHENG => array(
            'name' => '上证指数',
            'line_marker' => 'square',
        ),
        self::COMPANY_CHUANGYE => array(
            'name' => '创业板指',
            'line_marker' => 'circle',
        )
    );

    public function getCompanyEarnList($company) {
        $earnRateList = array(
            '201901' => array(
                self::COMPANY_NUBULA => -1.09,
                'shangzheng' => 2.90,
                'chuangye' => 0.46,
            ),
            '201902' => array(
                'nebula' => 20.41,
                'shangzheng' => 13.43,
                'chuangye' => 30.14,
            ),
            '201903' => array(
                'nebula' => 9.35,
                'shangzheng' => 9.08,
                'chuangye' => 5.24,
            ),
            '201904' => array(
                'nebula' => -9.59,
                'shangzheng' => -12.00,
                'chuangye' => -15.60,
            ),
        );
        $formatList = array();
        foreach ($earnRateList as $dateStr => $item) {
            $formatList[$dateStr] = $item[$company];
        }
        return $formatList;
    }
}