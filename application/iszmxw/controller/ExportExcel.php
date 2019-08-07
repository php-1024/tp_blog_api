<?php

namespace app\iszmxw\controller;

use app\api\model\Blog;
use app\iszmxw\model\Facility;
use think\Db;
use think\Request;
use think\Controller;

class ExportExcel extends Controller
{

    // 导出excel方法
    public function export_excel(Request $request)
    {
        $list = Facility::where([])
            ->field([
                'id',
                'machine_code',
                'machine_name',
                'address',
                'lat',
                'lng',
                'tag_id',
            ])
            ->select()
            ->toArray();
        $objPHPExcel = new \PHPExcel();

        //设置文件的一些属性，在xls文件——>属性——>详细信息里可以看到这些值，xml表格里是没有这些值的
        $objPHPExcel
            ->getProperties()//获得文件属性对象，给下文提供设置资源
            ->setCreator("追梦小窝")//设置文件的创建者
            ->setLastModifiedBy("追梦小窝")//设置最后修改者
            ->setTitle("追梦小窝的excel")//设置标题
            ->setSubject("Office2007 XLSX Test Document")//设置主题
            ->setDescription("冯硕需要的数据表格式")//设置备注
            ->setKeywords("office 2007 openxmlphp")//设置标记
            ->setCategory("Test resultfile");      //设置类别
        $excel = [
            'A' => '媒体设备ID（必填）',
            'B' => '设备名称',
            'C' => '设备组名称',
            'D' => '屏幕数',
            'E' => '屏幕',
            'F' => '屏幕尺寸',
            'G' => '省份',
            'H' => '城市',
            'I' => '区/县',
            'J' => '详细地址',
            'K' => 'poi名称',
            'L' => 'poi地址',
            'M' => '经度',
            'N' => '纬度',
            'O' => '场景',
            'P' => '是否联网',
            'Q' => '每日触达人数',
            'R' => '售卖方式',
            'S' => '是否可售'
        ];
        $excel_data[1] = $excel;
        dump($list);
        exit;
        foreach ($list as $key => $val) {

            // 计算总额
            $total_price += $val['bill_money'];
            // 处理提现银行
            $bank_name = self::getBankName($val['bank_name']);
            // 处理提现状态
            $bill_status = self::checkStatus($val['bill_status']);

            $export_data['A'] = $val['id'];
            $export_data['B'] = $val['nickname'];
            $export_data['C'] = $val['bill_money'];
            $export_data['D'] = $val['pay_type'];
            $export_data['E'] = $val['account_name'];
            $export_data['F'] = "\t" . $val['account'] . "\t";
            $export_data['G'] = $bank_name;
            $export_data['H'] = $bill_status;
            $export_data['I'] = date('Y/m/d H:i', $val['add_time']);
            $export_data['J'] = date('Y/m/d H:i', $val['check_time']);
            array_push($excel_data, $export_data);
        }
        //给表格添加数据
        $objPHPExcel->setActiveSheetIndex(0)//设置第一个内置表（一个xls文件里可以有多个表）为活动的
        ->setCellValue('A1', '媒体设备ID（必填）')//给表的单元格设置数据
        ->setCellValue('B1', 'world!')//数据格式可以为字符串
        ->setCellValue('C1', 12)//数字型
        ->setCellValue('D1', 12)//
        ->setCellValue('D3', true)//布尔型
        ->setCellValue('D4', '=SUM(C1:D2)');//公式

        $objActSheet = $objPHPExcel->getActiveSheet();

        //给当前活动的表设置名称
        $objActSheet->setTitle('给当前活动的表设置名称');
        $excel_name = "追梦小窝的报表.xls";
        //生成2003excel格式的xls文件
        header("Content-Type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=$excel_name");
        header("Cache-Control:max-age=0");
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
        dump($list);
    }
}
