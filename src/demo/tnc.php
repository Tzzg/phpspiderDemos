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
    'name' => 'tnc',
//    'log_show' => true,
    //'log_type' => 'error,debug',
    'multiserver' => false,
    'serverid' => 1,
    'INTERVAL'=>1000,
    'tasknum' => 1,
    'domains' => array(
        'fzjg.tnc.com.cn',
        'www.tnc.com.cn'
    ),
    'scan_urls' => array(
        'https://fzjg.tnc.com.cn/'
    ),
    'list_url_regexes' => array(///categories/fashion-textile-products/children-infants-wear/page2.html?q=Children%20
//        "/search/factory-c-0-k--p\d+",
        "/search/factory-c-"
    ),
    'content_url_regexes' => array(
        "www.tnc.com.cn/company/d\d+",
        "www.tnc.com.cn/company/d\d+/contact.html"
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
        'file'  => '../data/tnc.sql',
        'table' => 'tnc',
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
            'selector' => "/html/body/div[11]/div/ul/li[1]/h1",
            'required' => true,
        ),
        array(
            'name' => "contact_url",
            'selector' => "/html/body/div[12]/ul/li[3]/a//@href",
            'required' => true,
        ),
          array(
            'name' => "contact",
            'repeated' => true,
              'required' => true,
              'source_type' => 'attached_url',
              'attached_url' => 'contact_url',
              'selector' => "//div[contains(@class,'mobile')]//text()",
          ),
        ///html/body/div[13]/div/div[1]/div[1]/div[2]/div[1]/div[3]/ul/li[1]/div[2]
        array(
            'name' => "type",
            'repeated' => true,
            'required' => true,
            'source_type' => 'attached_url',
            'attached_url' => 'contact_url',
            'selector' => "/html/body/div[13]/div/div[1]/div[1]/div[2]/div[1]/div[3]/ul/li[1]/div[2]//text()",
        ),
        array(
            'name' => "email",
            'repeated' => true,
            'required' => true,
            'source_type' => 'attached_url',
            'attached_url' => 'contact_url',
            'selector' => "//div[contains(@class,'telephone')]//text() ",
        ),
    ),
);

$spider = new phpspider($configs);

$spider->on_start = function($phpspider){


    $cookies = "_ga=GA1.3.672621585.1522136189; m_c_=654247; __qfca=1599035627.1522136235.1522656457.1522656489.6; Hm_lvt_e82a92eb6606539ba3fcb86e4d841f73=1527130212; _de_us=f34d29066b688e496835daf5e1596ff8d16666b9; JSESSIONID=abcWsfJpCmb27fQgEdqow; _gid=GA1.3.958908997.1527470783; SECURITY_TNC_MEMBER=ODQ2ZDg4MDYtZWU5Zi00NmFkLWI4NjYtOGQ3NTlhNTE2MDQy; _gat=1; _gali=login-form; _de_fs=7869e0f4b0a743b4b9da8928e34b0334; Hm_lpvt_e82a92eb6606539ba3fcb86e4d841f73=1527484535";
    requests::set_cookies($cookies, 'www.tnc.com.cn');



    requests::set_header("Referer", "https://my.tnc.com.cn/login.htm?returnUrl=https%3A%2F%2Ffzjg.tnc.com.cn%2Fsearch%2Ffactory-c-0-k--p1.html&registSite=fzjg&clientCode=tnc_market_fzjg");


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



        $url = $page['url'] . 'contact.html';
        // 将新的url插入待爬的队列中
        $phpspider->add_url($url);


};

$spider->on_download_attached_page = function($content, $phpspider)
{
//var_dump($content);exit;
};



$spider->on_extract_field = function($fieldname, $data, $page)
{
    if ($fieldname == 'contact' && !empty($data))
    {
        if(is_array($data)){
            $data = $data[1];
        }
    }else if($fieldname == 'email' && !empty($data)){
        $email = '';
        if(is_array($data)){
           foreach ($data as $value){
               $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
               preg_match($pattern, $value, $matches);
               if (!empty($matches)){
                   $email = $matches[0];
                   break;
               }
           }
            $data = $email;
        }


    }
    return $data;
};



$spider->start();


