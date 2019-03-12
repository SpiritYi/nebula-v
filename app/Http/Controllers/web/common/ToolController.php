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
        $formatData = $this->_formatSheetData($allOriginData);
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

    private function _formatSheetData($dataArr) {
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
}