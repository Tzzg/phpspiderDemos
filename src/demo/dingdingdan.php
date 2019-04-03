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
    'name' => 'dingdingdan',
//    'log_show' => true,
    //'log_type' => 'error,debug',
    'multiserver' => false,
    'serverid' => 1,
    'INTERVAL'=>1000,
    'tasknum' => 1,
    'domains' => array(
        'dingdingdan.com',
        'www.dingdingdan.com',
    ),
    'scan_urls' => array(
        'https://www.dingdingdan.com/factory/index/page/1.html'
    ),
    'list_url_regexes' => array(///categories/fashion-textile-products/children-infants-wear/page2.html?q=Children%20
//        "/search/factory-c-0-k--p\d+",<a href="/factory/index/page/2.html">2</a>
        "/factory/index/page/"
    ),
    'content_url_regexes' => array(///factory/index/page/<a href="/store/4015/index.html" class="title" target="_blank" title="邓洋（个体经营）">邓洋（个体经营）</a>
        "/store/\d+/index.html",
    ),
    'max_try' => 5,
    //'proxies' => array(
        //'http://H784U84R444YABQD:57A8B0B743F9B4D2@proxy.abuyun.com:9010'
    //),
//    'export' => array(
//        'type' => 'csv',
//        'file' => '../data/tnc.csv',
//    ),
    'export' => array(
        'type'  => 'sql',
        'file'  => '../data/dingdingdan.sql',
        'table' => 'dingdingdan',
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
            'selector' => "/html/body/div[3]/div/div[1]/h1/a/text()",
            'required' => true,
        ),

        ///html/body/div[5]/div/div[2]/div[1]/div[1]/span[2]/em
        array(
            'name' => "type",
            'selector' => "/html/body/div[5]/div/div[2]/div[1]/div[1]/span[2]/em",
            'required' => true,
        ),

        array(
            'name' => "tel",
            'selector' => "/html/body/div[5]/div/div[2]/div[2]/dl[3]/dd/div/div[1]/div[2]/text()",
            'required' => true,
        ),
        array(
            'name' => "email",
            'selector' => "/html/body/div[5]/div/div[2]/div[2]/dl[3]/dd/div/div[2]/div/text()",
            'required' => true,
        ),


    ),
);

$spider = new phpspider($configs);

$spider->on_start = function($phpspider){


    $cookies = "PHPSESSID=tengsrn9gl01t44cmsenthn0k2; think_template=default; UM_distinctid=164f36bbf6146f-072b9409b0b4c-17356953-fa000-164f36bbf626a; Hm_lvt_89d46204dd4db3ede5e3a809080eadc8=1533092283; _caijianb7993d41e785ef7b85c452dbe30877b8=think%3A%7B%229871d3a2c554b27151cacf1422eec048%22%3A%226607%22%2C%225f4dcc3b5aa765d61d8327deb882cf99%22%3A%228ee3255dcbea231a5a032ae4cc4b0761%22%7D; think_language=zh-CN; CNZZDATA1271345572=687624401-1533089116-%7C1533100082; Hm_lpvt_89d46204dd4db3ede5e3a809080eadc8=1533105183";
    requests::set_cookies($cookies, 'www.dingdingdan.com');


    requests::set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36');
    requests::set_header("Referer", "https://www.dingdingdan.com/factory/index/page/1.html");


// 生成列表页URL入队列
//    for ($i = 0; $i <= 10; $i++)
//    {
//        $url = "http://fzjg.tnc.com.cn/search/factory-c-0-k--p{$i}.html";
//        $phpspider->add_url($url);
//    }

};




$spider->on_status_code = function($status_code, $url, $content, $phpspider)
{

};

$spider->is_anti_spider = function($url, $content, $phpspider)
{
    // $content中包含"404页面不存在"字符串
    if (strpos($content, "404页面不存在") !== false)
    {

        // 如果使用了代理IP，IP切换需要时间，这里可以添加到队列等下次换了IP再抓取
        // $phpspider->add_url($url);
        return true; // 告诉框架网页被反爬虫了，不要继续处理它
    }
    // 当前页面没有被反爬虫，可以继续处理
    return false;
};



$spider->on_download_page = function($page, $phpspider)
{
};



$spider->on_scan_page = function($page, $content, $phpspider)
{


//    var_dump($content);exit;


    //return false;
};


$spider->on_list_page = function($page, $content, $phpspider)
{
//    preg_match_all('#//www.tnc.com.cn/company/d\d+#', $content, $out);
//
//
//    var_dump($out);exit;
//    return true;
};
$spider->on_fetch_url = function($url, $phpspider)
{
//    if (strpos($url, "#filter") !== false)
//    {
//        return false;
//    }
//    return $url;
};

$spider->on_content_page = function($page, $content, $phpspider)
{





};

$spider->on_download_attached_page = function($content, $phpspider)
{
//var_dump($content);exit;
};



$spider->on_extract_field = function($fieldname, $data, $page)
{

    if ($fieldname == 'tel' && !empty($data))
    {



        $reg='/[1-9]([0-9]{5,11})/';//匹配数字的正则表达式
        preg_match($reg,$data,$result1);

        $data = $result1[0]??'';


    }else if($fieldname == 'email' && !empty($data)){

        $reg= "/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
        preg_match($reg,$data,$result2);

        $data = $result2[0]??'';

    }
    return $data;


};



$spider->start();


