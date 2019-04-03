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

/* Do NOT delete this comment */
/* 不要删除这段注释 */



//Children & Infants Wear
//Fashion & Ladies Wear
//Garment Factories
//Men's Wear
//Silk Wear
//Sports Wear



//http://www.textiledirectory.com.mm/categories/mandalay-region/chan-aye-thar-zan/7-children-infants-wear/U16913_U16913_khint-thit
//http://www.textiledirectory.com.mm/categories/yangon-region/mayangone/7-children-infants-wear/L00263391_L020164369_dr-baby
//http://www.textiledirectory.com.mm/categories/mandalay-region/chan-aye-thar-zan/7-children-infants-wear/U30575_U30575_khint-oo-may
$configs = array(
    'name' => 'textiledirectory',
    //'log_show' => true,
    //'log_type' => 'error,debug',
    'multiserver' => false,
    'serverid' => 1,
    'INTERVAL'=>1000,
    'tasknum' => 1,
    'domains' => array(
        'textiledirectory.com.mm',
        'www.textiledirectory.com.mm'
    ),
    'scan_urls' => array(
        'http://www.textiledirectory.com.mm/categories/fashion-textile-products/children-infants-wear.html\?q=Children%20\&Infants_Wear='
    ),
    'list_url_regexes' => array(///categories/fashion-textile-products/children-infants-wear/page2.html?q=Children%20
        "/categories/fashion-textile-products/children-infants-wear/page\d+.html\?q=Children%20"
    ),
    'content_url_regexes' => array(
        "/categories/yangon-region/mayangone/7-children-infants-wear/",
        "/categories/mandalay-region/chan-aye-thar-zan/7-children-infants-wear/",
        "/categories/yangon-region/shwe-pyi-thar/20-garment-factories/",
    ),
    'max_try' => 5,
    //'proxies' => array(
        //'http://H784U84R444YABQD:57A8B0B743F9B4D2@proxy.abuyun.com:9010'
    //),
//    'export' => array(
//        'type' => 'csv',
//        'file' => '../data/textiledirectory.csv',
//    ),
    'export' => array(
        'type'  => 'sql',
        'file'  => '../data/textiledirectory.sql',
        'table' => 'content',
    ),
    //'export' => array(
        //'type' => 'db', 
        //'table' => 'content',
    //),
    //'db_config' => array(
        //'host'  => '127.0.0.1',
        //'port'  => 3306,
        //'user'  => 'root',
        //'pass'  => 'root',
        //'name'  => 'qiushibaike',
    //),
    //'queue_config' => array(
        //'host'      => '127.0.0.1',
        //'port'      => 6379,
        //'pass'      => '',
        //'db'        => 5,
        //'prefix'    => 'phpspider',
        //'timeout'   => 30,
    //),
    'fields' => array(
        array(
            'name' => "name",
            'selector' => "//*[@id=\"body\"]/div[2]/div[2]/div[1]/div[2]/div[1]/h1",
            'required' => true,
        ),
        array(
            'name' => "Address",
            'selector' => "//*[@id=\"body\"]/div[2]/div[2]/div[1]/div[2]/div[1]/dl[1]/dd/label",
            'required' => true,
        ),
        array(
            'name' => "Township",
            'selector' => "//*[@id=\"body\"]/div[2]/div[2]/div[1]/div[2]/div[1]/dl[2]/dd/label",
            'required' => true,
        ),
        array(
            'name' => "Phone",
            'selector' => "//*[@id=\"body\"]/div[2]/div[2]/div[1]/div[2]/div[1]/dl[3]/dd/label",
            'required' => true,
        ),
    ),
);

$spider = new phpspider($configs);


$spider->on_scan_page = function($page, $content, $phpspider)
{

    //var_dump($page);exit;
    //return false;
};


$spider->on_list_page = function($page, $content, $phpspider)
{


};


$spider->on_content_page = function($page, $content, $phpspider)
{




};

$spider->on_extract_field = function($fieldname, $data, $page)
{


    $encoding = util::get_encoding($page['raw']);



    if ($fieldname == 'name'){


        $data  = iconv("UTF-8","GB2312//IGNORE",$data);
        //$data = preg_replace($regex,"",$data);
        //echo $data."\n";exit;

    }elseif ($fieldname == 'Address'){
        echo $data."\n";exit;
    }elseif ($fieldname == 'Township'){
        echo $data."\n";exit;
    }elseif ($fieldname == 'Phone'){
        echo $data."\n";exit;
    }



    return $data;


};



$spider->start();


