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

        //给表格添加数据
        $objPHPExcel->setActiveSheetIndex(0)//设置第一个内置表（一个xls文件里可以有多个表）为活动的
        ->setCellValue('A1', 'Hello')//给表的单元格设置数据
        ->setCellValue('B2', 'world!')//数据格式可以为字符串
        ->setCellValue('C1', 12)//数字型
        ->setCellValue('D2', 12)//
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
