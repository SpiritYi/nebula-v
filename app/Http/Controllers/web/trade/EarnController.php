<?php

namespace App\Http\Controllers\Web\Trade;

use App\Http\Controllers\Web\WebController;
use Code_base\Base\Trade\Manager\Earn;

class EarnController extends WebController {

    public function ratelist_get() {
        return view('/web/trade/earn_list');
    }

    public function ratelist_ajax_get() {
        $companyConfig = Earn::$COMPANY_CONFIG;
        //获取各公司收益曲线
        $allEarnList = array();
        $allDate = array();
        foreach ($companyConfig as $company => $configItem) {
            $earnList = $this->ctx->base->trade->manager_earn->getCompanyEarnList($company);
            foreach ($earnList as $dateStr => $rate) {
                if (!in_array($dateStr, $allDate)) {
                    $allDate[] = $dateStr;
                }
            }
            $allEarnList[$company] = $earnList;
        }
        sort($allDate);
        array_walk($allDate, function(&$value, $key) {
            $value = strval($value);
        });

        $rateSeriesMap = array();
        foreach ($companyConfig as $company => $configItem) {
            if (!isset($totalSeriesMap[$company]['name'])) {
                $initItem = array(
                    'name' => $configItem['name'],
                    'marker' => array(
                        'symbol' => $configItem['line_marker'],
                    ),
                );
                $rateSeriesMap[$company] = $initItem;
            }

            foreach ($allDate as $dateStr) {
                $rate = $allEarnList[$company][$dateStr] ?? 0;
                $rateSeriesMap[$company]['data'][] = array(
                    'y' => $rate,
                    'pointWidth' => 20,
                );
            }
        }

        $chartsData = array(
            'date_arr' => $allDate,
            'rate_series' => array_values($rateSeriesMap),
        );
        return $this->output($chartsData);
    }

    public function totallist_ajax_get() {
        $companyConfig = Earn::$COMPANY_CONFIG;
        //获取各公司收益曲线
        $allEarnList = array();
        $allDate = array();
        foreach ($companyConfig as $company => $configItem) {
            $earnList = $this->ctx->base->trade->manager_earn->getCompanyEarnList($company);
            foreach ($earnList as $dateStr => $rate) {
                if (!in_array($dateStr, $allDate)) {
                    $allDate[] = $dateStr;
                }
            }
            $allEarnList[$company] = $earnList;
        }
        sort($allDate);
        array_walk($allDate, function(&$value, $key) {
            $value = strval($value);
        });

        $totalSeriesMap = array();
        foreach ($companyConfig as $company => $configItem) {
            $currentTotal = 10000;
            if (!isset($totalSeriesMap[$company]['name'])) {
                $initItem = array(
                    'name' => $configItem['name'],
                    'marker' => array(
                        'symbol' => $configItem['line_marker'],
                    ),
                    'data' => [$currentTotal],
                );
                $totalSeriesMap[$company] = $initItem;
            }

            foreach ($allDate as $dateStr) {
                $rate = $allEarnList[$company][$dateStr] ?? 0;
                $currentTotal = sprintf('%.2f', $currentTotal * (1 + $rate / 100));        //换算到净值
                $totalSeriesMap[$company]['data'][] = floatval($currentTotal);
            }
        }
        array_unshift($allDate, $allDate[0]);

        $chartsData = array(
            'date_arr' => $allDate,
            'total_series' => array_values($totalSeriesMap),
        );
        return $this->output($chartsData);
    }
}