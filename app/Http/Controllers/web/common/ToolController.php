<?php
/**
 * 工具类
 */

namespace App\Http\Controllers\Web\Common;

use App\Http\Controllers\Web\WebController;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ToolController extends WebController {

    public function parsexlsx_get() {

        return view('/web/common/tool_parsexlsx');
    }

    public function uploadxlsx_ajax_post() {
        $type = request()->get('type');

        $fileInfo = array_pop($_FILES);
        $xlsxFile = $fileInfo['tmp_name'];

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        try {
            $spreadsheet = $reader->load($xlsxFile);
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            die($e->getMessage());
        }

        $allOriginData = array();
        //$sheet = $spreadsheet->getActiveSheet();
        $allSheetNames = $spreadsheet->getSheetNames();
        foreach ($allSheetNames as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);
            $sheetRowData = $this->_readSheetData($sheet);
            $allOriginData[$sheetName] = $sheetRowData;
        }
        switch ($type) {
            case 'use_open':
                $formatData = $this->_formatUseOpenData($allOriginData);
                break;

            case 'liucun':
                $formatData = $this->_formatGiguangLiuCun($allOriginData);
                break;

            case 'day_active':
                $formatData = $this->_formatGiguangDayactive($allOriginData);
                break;

            default:
                return $this->error(-3001, '无法识别类型');
                break;
        }
        return $this->output($formatData);
    }

    /**
     * 读取xlsx 一个表里面的数据
     * @param Worksheet $sheet
     * @return array
     */
    private function _readSheetData($sheet) {
        $res = array();
        foreach ($sheet->getRowIterator() as $row) {
            $tmp = array();
            foreach ($row->getCellIterator() as $cell) {
                $tmp[] = $cell->getFormattedValue();
            }
            $res[$row->getRowIndex()] = $tmp;
        }
        return $res;
    }

    private function _formatUseOpenData($dataArr) {
        $availableTableName = array(
            '所有数据' => 'all',
            'iOS数据' => 'ios',
            'Android数据' => 'android',
        );
        $formatData = array();
        foreach ($dataArr as $tableName => $rowList) {
            if (!array_key_exists($tableName, $availableTableName)) {       //不识别的表不处理
                continue;
            }
            $business = $availableTableName[$tableName];
            foreach ($rowList as $rowIndex => $rowItem) {
                if ($rowIndex <= 2) {           //前面两列标题丢弃
                    continue;
                }
                $formatData[$business][] = array(
                    'date' => $rowItem[0],
                    'push_count' => $rowItem[1],
                    'open_count' => $rowItem[2],
                    'use_time' => $rowItem[3],
                );
            }
        }
        return $formatData;
    }

    private function _formatGiguangLiuCun($dataArr) {
        $availableTableName = array(
            'Android数据' => 'android',
            'iOS数据' => 'ios',
        );
        $formatData = array();
        foreach ($dataArr as $tableName => $rowList) {
            if (!array_key_exists($tableName, $availableTableName)) {       //不识别的表不处理
                continue;
            }
            $business = $availableTableName[$tableName];
            foreach ($rowList as $rowIndex => $rowItem) {
                if ($rowIndex <= 2) {           //前面两列标题丢弃
                    continue;
                }
                $formatData[$business][] = array(
                    'date' => $rowItem[0],
                    'day1' => $rowItem[1],
                    'day2' => $rowItem[2],
                    'day3' => $rowItem[3],
                    'day4' => $rowItem[4],
                    'day5' => $rowItem[5],
                    'day6' => $rowItem[6],
                    'day7' => $rowItem[7],
                    'day14' => $rowItem[8],
                    'day30' => $rowItem[9],
                    'new_user' => $rowItem[10],
                );
            }
        }
        return $formatData;
    }

    //格式化极光日活
    private function _formatGiguangDayactive($dataArr) {
        $availableTableName = array(
            '所有数据' => 'all',
        );
        $formatData = array();
        foreach ($dataArr as $tableName => $rowList) {
            if (!array_key_exists($tableName, $availableTableName)) {       //不识别的表不处理
                continue;
            }
            $business = $availableTableName[$tableName];
            foreach ($rowList as $rowIndex => $rowItem) {
                if ($rowIndex <= 2) {           //前面两列标题丢弃
                    continue;
                }
                $formatData[$business][] = array(
                    'date' => $rowItem[0],
                    'new_user' => $rowItem[1],
                    'active_user' => $rowItem[2],
                );
            }
        }
        return $formatData;
    }
}