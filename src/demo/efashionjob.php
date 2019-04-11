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
    'name' => 'efashionjob',
//    'log_show' => true,
    //'log_type' => 'error,debug',
    'multiserver' => false,
    'serverid' => 1,
    'INTERVAL'=>1000,
    'tasknum' => 1,
    'domains' => array(
        'www.efashionjob.com'
    ),
    'scan_urls' => array(
        'https://www.efashionjob.com/wFactories'
    ),
    'list_url_regexes' => array(///categories/fashion-textile-products/children-infants-wear/page2.html?q=Children%20
//        "/search/factory-c-0-k--p\d+",
        "https://www.efashionjob.com/wFactories\?page=",
    ),
    'content_url_regexes' => array(
        "/wFactoryDetails/\d+$",
        "https://www.efashionjob.com/wFactoryDetails/\d+$",
    ),
    'max_try' => 5,
    //'proxies' => array(
        //'http://H784U84R444YABQD:57A8B0B743F9B4D2@proxy.abuyun.com:9010'
    //),
   'export' => array(
       'type' => 'csv',
       'file' => '../data/efashionjob.csv',
   ),
//     'export' => array(
//         'type'  => 'sql',
//         'file'  => '../data/efashionjob.sql',
//         'table' => 'efashionjob',
//     ),
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
            'selector' => "/html/body/div[3]/div/div/div[1]/p[1]/a",
            'required' => true,
        ),
        array(
            'name' => "contact",
            'selector' => "/html/body/div[4]/div/div[2]/div/div[1]/div[2]/div/div[2]/ul/li[6]/p[3]/span",
            'required' => false,
        ),
        array(
            'name' => "tel",
            'selector' => "/html/body/div[4]/div/div[2]/div/div[1]/div[2]/div/div[2]/ul/li[6]/p[5]/span",
            'required' => false,
        ),
        array(
            'name' => "address",
            'selector' => "/html/body/div[3]/div/div/div[1]/p[2]/a",
            'required' => false,
        ),
       
        array(
            'name' => "a1",
            'selector' => "/html/body/div[4]/div/div[2]/div/div[1]/div[2]/div/div[2]/ul/li[2]/p[2]",
            'required' => false,
        ),
        array(
            'name' => "b2",
            'selector' => "/html/body/div[4]/div/div[2]/div/div[1]/div[2]/div/div[2]/ul/li[4]/p[2]/a",
            'required' => false,
        ),
        array(
            'name' => "c3",
            'selector' => "/html/body/div[4]/div/div[2]/div/div[1]/div[2]/div/div[2]/ul/li[5]/p[2]/span",
            'required' => false,
        ),
        
    ),
);

$spider = new phpspider($configs);

$spider->on_start = function($phpspider){


    $cookies = "Hm_lvt_df0d6cfced3a3ca5b66bfa209c62f47a=1554883310; nb-referrer-hostname=www.efashionjob.com; nb-start-page-url=https%3A%2F%2Fwww.efashionjob.com%2Flogin; Hm_lvt_a2b6dbbca35a7e3c1e933834be11562b=1554883352; Hm_lpvt_df0d6cfced3a3ca5b66bfa209c62f47a=1554951686; Hm_lpvt_a2b6dbbca35a7e3c1e933834be11562b=1554951701; XSRF-TOKEN=eyJpdiI6IlBvdnBzXC9oY3RrcGZpbThodlNtXC8xdz09IiwidmFsdWUiOiJNa1lxS1ZhVXJJVlVibEJYS1pyb1V0WFwvaERZZHdsQ2drMmhjQm5xVmF6SXZYSmlqaWtwem56RHR4S2tVSnlqSWthQnhyeTFXOURtOGErWTFMVnJZcnc9PSIsIm1hYyI6IjM3MjhlNTNjZDk4Y2YwMjBhZjU2ZmQ3MTMyNDJiOThjYmM2ZWEzOWJjMDMwYjMzNDU1NTE3MWIwNTllNGJhMjUifQ%3D%3D; laravel_session=eyJpdiI6Imt6anVPR2VoN0tHNFZRNmlnOG5UQkE9PSIsInZhbHVlIjoiRnFMVkZOYnp2RTNqY3NlbUhIa2JldjUwZEhNajBEa0VlOEU5cEt3WU05aWJaaHIwYnJvdjFBUkZPNVYzRWdEM3RhelRcL0ZwNTVxMDYxbVVSWGU4XC9aQT09IiwibWFjIjoiYjNkNTdmNTM0Y2QwZTNhZTUyYWNhYzM0NGNiMTU0YzUzMDcwYWZiYTU4YmQ5OGMyMjI4ZDQ0YzkyMGUxMDI0NSJ9";
    requests::set_cookies($cookies, 'www.efashionjob.com');



    requests::set_header("Referer", "https://www.efashionjob.com/wFactories");


    
   
    
// // 生成列表页URL入队列
//    for ($i = 0; $i <= 100; $i++)
//    {
//        $url =  "https://www.efashionjob.com/wFactories?page=".$i;
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
        
        echo '404页面不存在';
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



//         $url = $page['url'] . 'contact.html';
//         // 将新的url插入待爬的队列中
//         $phpspider->add_url($url);


};

$spider->on_download_attached_page = function($content, $phpspider)
{
//var_dump($content);exit;
};



$spider->on_extract_field = function($fieldname, $data, $page)
{
//     if ($fieldname == 'contact' && !empty($data))
//     {
//         if(is_array($data)){
//             $data = $data[1];
//         }
//     }else if($fieldname == 'email' && !empty($data)){
//         $email = '';
//         if(is_array($data)){
//            foreach ($data as $value){
//                $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
//                preg_match($pattern, $value, $matches);
//                if (!empty($matches)){
//                    $email = $matches[0];
//                    break;
//                }
//            }
//             $data = $email;
//         }


//     }
// var_dump($data);
// exit;
$a = trim($data);//preg_replace('/\S/',$data,'');
$a = strip_tags($a);
 var_dump($a);
    return $a;
};



$spider->start();


