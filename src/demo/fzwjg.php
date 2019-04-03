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


$cookies = "_ga=GA1.1.599590831.1533624401; _gid=GA1.1.2050858451.1533624401; _ga=GA1.2.599590831.1533624401; _gid=GA1.2.2050858451.1533624401; PHPSESSID=n974jbd7rhcfko4jcef895med6; h3wl__s_uid=wqq_k18wx3f; h3wl__cityid=0; h3wl__cityname=";
requests::set_cookies($cookies, 'www.fzwjg.com');

requests::set_useragent('Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1');
requests::set_header("Referer", "https://www.fzwjg.com/m2/app/app.html");
requests::set_header("nemosrc", "nemoApp");


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


$cookies = "_ga=GA1.1.599590831.1533624401; _gid=GA1.1.2050858451.1533624401; _ga=GA1.2.599590831.1533624401; _gid=GA1.2.2050858451.1533624401; PHPSESSID=n974jbd7rhcfko4jcef895med6; h3wl__s_uid=wqq_k18wx3f; h3wl__cityid=0; h3wl__cityname=; _gat=1";
requests::set_cookies($cookies, 'www.fzwjg.com');

//https://www.fzwjg.com/m2/s/index.php?mod=category&action=filter

$type_arr = [
    ['id'=>'246','name'=>'外发加工'],
    ['id'=>'264','name'=>'承接加工'],
    ['id'=>'323','name'=>'厂房住房'],
    ['id'=>'309','name'=>'设备'],
    ['id'=>'338','name'=>'面辅料'],
    ['id'=>'327','name'=>'库存批发'],

    ['id'=>'367','name'=>'招聘'],
    ['id'=>'299','name'=>'求职'],
];


$page_size = 15;


$url = 'https://www.fzwjg.com/m2/s/index.php?mod=category&action=filter';
$uri = 'https://www.fzwjg.com/m2/s/index.php?mod=information';
foreach ($type_arr as $type){


//https://www.fzwjg.com/m2/s/index.php?mod=category&action=filter

        $page = 1;

    $flag = true;
    while ($flag) {


        $post = ['catid' => $type['id'], 'cityid' => '0', 'page' => $page];


//
        $list = requests::post($url, $post);


        $list = json_decode($list);
        if (!empty($list->info_list)) {
            $flag = true;
        } else {
            $flag = false;
            continue;
        }


        foreach ($list->info_list as $info) {

            $post = ['action' => 'getContact','cityid'=>'0','cityname'=>'全国',
                    'infoid'=>$info->id,
                'press_type' => 'email'];



            $re = requests::post($uri, $post);

            $re = json_decode($re);
            echo $type['name']."\t".$re->contact_tel."\t".$re->contact_email."\n";
//            var_dump($re);exit;
            usleep(500);
        }

        sleep(2);
        $page++;
    }


}





