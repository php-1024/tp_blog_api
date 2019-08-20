<?php

namespace app\iszmxw\controller;

use app\api\model\Blog;
use app\iszmxw\model\Area;
use app\iszmxw\model\City;
use app\iszmxw\model\Facility;
use app\iszmxw\model\Province;
use app\iszmxw\model\ShopSet;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class ExportExcel extends Controller
{

    // 导出excel方法
    public function export_excel(Request $request)
    {
        $list = Facility::where([])
            ->field([
                'a.id',
                'a.machine_code',
                'a.machine_name',
                'a.shop_id',
                'a.address',
                'a.lat',
                'a.lng',
                'b.type_id',
                'c.type',
            ])
            ->alias('a')
            ->join('shop_set b', 'a.shop_id=b.id', 'left')
            ->join('shop_type c', 'b.type_id=c.id', 'left')
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
            'E' => '屏幕1',
            'F' => '屏幕2',
            'G' => '屏幕3',
            'H' => '屏幕4',
            'I' => '屏幕尺寸',
            'J' => '省份',
            'K' => '城市',
            'L' => '区/县',
            'M' => '详细地址',
            'N' => 'poi名称',
            'O' => 'poi地址',
            'P' => '经度',
            'Q' => '纬度',
            'R' => '场景',
            'S' => '是否联网',
            'T' => '每日触达人数',
            'U' => '售卖方式',
            'V' => '是否可售'
        ];
        $export_data = [];
        $excel_data[1] = $excel;

        foreach ($list as $key => $val) {
            $export_data['A'] = $val['machine_code'];
//            $export_data['B'] = $val['machine_name'];
            $export_data['B'] = null;
            $export_data['C'] = null;
            $export_data['D'] = 1;
            $export_data['E'] = 1024;
            $export_data['F'] = 768;
            $export_data['G'] = 30.41;
            $export_data['H'] = 22.81;
            $export_data['I'] = 15;
            $export_data['J'] = self::area($val['shop_id'], 1);
            $export_data['K'] = self::area($val['shop_id'], 2);
            $export_data['L'] = self::area($val['shop_id'], 3);
            $export_data['M'] = self::address($val['shop_id'], $val['address']);
            $export_data['N'] = self::area($val['shop_id'], 4);
            $export_data['O'] = self::address($val['shop_id'], $val['address']);
            $export_data['P'] = $val['lng'];
            $export_data['Q'] = $val['lat'];
            $export_data['R'] = self::scence($val['type']);
            $export_data['S'] = '是';
            $export_data['T'] = 750;
            $export_data['U'] = '是';
            $export_data['V'] = 'CPM';
            array_push($excel_data, $export_data);
        }

        // 数据输出到表格
        $set_value = $objPHPExcel->setActiveSheetIndex(0);
        foreach ($excel_data as $key => $val) { // 注意 key 是从 0 还是 1 开始，此处是 0
            foreach ($val as $k => $v) {
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                $set_value->setCellValue($k . $key, $val[$k]);
            }
        }

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
    }

    // 获取地址
    public static function area($shop_id, $type = 1)
    {
        if (empty($shop_id)) {
            return "";
        }
        switch ($type) {
            case 1:
                $re = ShopSet::where(['id' => $shop_id])->field('province_id')->find();
                $re = empty($re) ? array() : $re->toArray();
                if (empty($re['province_id'])) {
                    $address = ['name' => ''];
                } else {
                    $address = Province::where(['province_id' => $re['province_id']])->field('name')->find()->toArray();
                }
                break;
            case 2:
                $re = ShopSet::where(['id' => $shop_id])->field('city_id')->find();
                $re = empty($re) ? array() : $re->toArray();
                if (empty($re['city_id'])) {
                    $address = ['name' => ''];
                } else {
                    $address = City::where(['city_id' => $re['city_id']])->field('name')->find()->toArray();
                }
                break;
            case 3:
                $re = ShopSet::where(['id' => $shop_id])->field('area_id')->find();
                $re = empty($re) ? array() : $re->toArray();
                if (empty($re['area_id'])) {
                    $address = ['name' => ''];
                } else {
                    $address = Area::where(['area_id' => $re['area_id']])->field('name')->find()->toArray();
                }
                break;

            case 4:
                $re = ShopSet::where(['id' => $shop_id])->field('name')->find();
                $re = empty($re) ? array() : $re->toArray();
                if (empty($re['name'])) {
                    $address = ['name' => ''];
                } else {
                    $address = $re;
                }
                break;
            default:
                $re = ShopSet::where(['id' => $shop_id])->field('province_id')->find();
                $re = empty($re) ? array() : $re->toArray();
                if (empty($re['province_id'])) {
                    $address = ['name' => ''];
                } else {
                    $address = Province::where(['province_id' => $re['province_id']])->field('name')->find()->toArray();
                }
                break;
        }
        return $address['name'];
    }


    // 处理真实地址
    public static function address($shop_id, $address)
    {
        $re = ShopSet::where(['id' => $shop_id])->field(['province_id', 'city_id', 'area_id'])->find();
        $re = empty($re) ? array() : $re->toArray();
        if (empty($re['province_id'])) {
            $info = ['province' => '', 'city' => '', 'area' => ''];
        } else {
            $province = Province::where(['province_id' => $re['province_id']])->field('name')->find();
            $province = empty($province) ? array() : $province->toArray();
            $city = City::where(['city_id' => $re['city_id']])->field('name')->find();
            $city = empty($city) ? array() : $city->toArray();
            $area = Area::where(['area_id' => $re['area_id']])->field('name')->find();
            $area = empty($area) ? array() : $area->toArray();
            $info = [
                'province' => empty($province) ? '' : $province['name'],
                'city' => empty($city) ? '' : $city['name'],
                'area' => empty($area) ? '' : $area['name'],
            ];
        }
        return $info['province'] . $info['city'] . $info['area'] . $address;
    }


    // 场景处理
    public static function scence($type)
    {
        $name = $type;
        switch ($type) {
            case "KTV  酒吧  洗浴中心";
                $name = "KTV";
                break;
            case "药房  诊所";
                $name = "门诊诊所";
                break;
            case "奶茶店";
                $name = "餐饮";
                break;
            case "百货商场";
                $name = "生活超市";
                break;
            case "旅游";
                $name = "机场";
                break;
            case "社区门店";
                $name = "居民楼";
                break;
            case "电影院";
                $name = "影院";
                break;
            case "商务中心";
                $name = "写字楼";
                break;
            case "健身房";
                $name = "运动场馆";
                break;
            case "专科医院";
                $name = "医院";
                break;
            case "售出设备";
                $name = "便利店";
                break;
            case "健康养生美容";
                $name = "医美整形";
                break;
            case "批量添加(过滤标识 勿删)";
                $name = "其他综合";
                break;
            case "培训中心";
                $name = "培训机构";
                break;
            case "交通枢纽";
                $name = "停车场";
                break;
            case "行政单位";
                $name = "写字楼";
                break;
            case "刷单设备";
                $name = "其他综合";
                break;
            case "通用";
                $name = "其他综合";
                break;
        }
        return $name;
    }


    // 将json数据转换为excel
    public function json_excel(Request $request)
    {
        $json_string = file_get_contents('json/excel.json');
        // 用参数true把JSON字符串强制转成PHP数组
        $list = json_decode($json_string, true);
        $objPHPExcel = new \PHPExcel();

        //设置文件的一些属性，在xls文件——>属性——>详细信息里可以看到这些值，xml表格里是没有这些值的
        $objPHPExcel
            ->getProperties()//获得文件属性对象，给下文提供设置资源
            ->setCreator("设备粉丝数据")//设置文件的创建者
            ->setLastModifiedBy("设备粉丝数据")//设置最后修改者
            ->setTitle("设备粉丝数据excel")//设置标题
            ->setSubject("Office2007 XLSX Test Document")//设置主题
            ->setDescription("设备粉丝数据")//设置备注
            ->setKeywords("office 2007 openxmlphp")//设置标记
            ->setCategory("Test resultfile");      //设置类别
        $excel = [
            'A' => '设备号',
            'B' => '位置',
        ];
        $export_data = [];
        $excel_data[1] = $excel;

        foreach ($list as $key => $val) {
            dump($key, $val);
            exit;
            $export_data['A'] = $key;
            $export_data['B'] = $list[$key]['address'];
            array_push($excel_data, $export_data);
        }
        // 数据输出到表格
        $set_value = $objPHPExcel->setActiveSheetIndex(0);
        foreach ($excel_data as $key => $val) { // 注意 key 是从 0 还是 1 开始，此处是 0
            foreach ($val as $k => $v) {
                //Excel的第A列，uid是你查出数组的键值，下面以此类推
                $set_value->setCellValue($k . $key, $val[$k]);
            }
        }

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


    }

}
