<?php
// composer下载方式
// 先使用composer命令下载：
// composer require owner888/phpspider
// 引入加载器
//require './vendor/autoload.php';

// GitHub下载方式
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\util;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */



requests::set_useragent('Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1');
requests::set_header("Referer", "http://wdfzq.com/");
// requests::set_header("nemosrc", "nemoApp");

// $cookies = "PHPSESSID=44k9utac5365ralpukimj76uv5";
// requests::set_cookies($cookies, 'wdfzq.com');
//$uri = 'https://www.fzwjg.com/m2/s/index.php?mod=information';
//
//$post = ['action' => 'getContact','cityid'=>'0','cityname'=>'全国',
//    'infoid'=>'301797',
//    'press_type' => 'email'];

//$uri = 'https://www.fzwjg.com/m2/s/index.php?mod=category&action=filter';
//
//
////Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36
//$post = ['catid' => "246",'cityid'=>"0",'page'=>1];
//
////
//$list = requests::post($uri, $post);
//var_dump($list);exit;


//https://www.fzwjg.com/m2/s/index.php?mod=category&action=filter

$type_arr = [
//     ['id'=>'3','name'=>'工厂尾货','ref'=>'sec'],
    ['id'=>'9','name'=>'尾货批发','ref'=>'sup']
    
];


$page_size = 10;


$url = 'http://wdfzq.com/admin_2/json1.php';


echo '类'."\t".
    'name'."\t".'发布时间'."\t".'类别'."\t".
    '所在区域'."\t".'详细地址'."\t".
    '联系人'."\t".'联系电话'."\t".
    '备注'."\t".'数量'."\t".
    '图片网址'."\n";

foreach ($type_arr as $type){


//https://www.fzwjg.com/m2/s/index.php?mod=category&action=filter

        $page = 1;

    $flag = true;
    
    
    
    
    while ($flag) {


        $post = [
        'act'=>'get_other',
        'ref'=>$type['ref'],
            
        'class_id'=>$type['id'],
         'is_sale'=>'',
        'page'=>$page,
//          'default_val' => '{"userid":"97572","rand_code":"15407824756VVT","lat":"30.25924446","lon":"120.21937542","baidu_address":"浙江省杭州市江干区钱江路","system":"weixin","source":"1","uuids":"moniqi","z_beta":"1.0"}'
            
        ];
        
        

//
        $list = requests::post($url, $post);


        $list = json_decode($list);
        if (!empty($list->data)) {
            $flag = true;
        } else {
            $flag = false;
            continue;
        }


        foreach ($list->data as $info) {

          
            $post = ['act' => 'sup_text',
                'ref'=>$type['ref'],
                'id'=>$info->id, //c_id
//                 'default_val' => '{"userid":"97572","rand_code":"15407824756VVT","lat":"30.25924446","lon":"120.21937542","baidu_address":"浙江省杭州市江干区钱江路","system":"weixin","source":"1","uuids":"moniqi","z_beta":"1.0"}'
                
            ];
            
            //
            $re = requests::post($url, $post);

            $re = json_decode($re);
    
            echo $type['name']."\t".
                     $re->data->title."\t".$re->data->addtime."\t".''."\t".
                    $re->data->area."\t".$re->data->address."\t".
                    $re->data->contact."\t".$re->data->tel."\t".
                    ($re->data->note?$re->data->note:'')."\t".$re->data->nums."\n";
//            var_dump($re);exit;
            usleep(500);
        }

        sleep(2);
        $page++;
    }


}





