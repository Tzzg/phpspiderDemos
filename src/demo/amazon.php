<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */


requests::set_referer('https://www.amazon.com/gp/site-directory?ref=nav_shopall_btn');
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36');
    
    
$temp =[];


$ip = rand(2,254).'.'.rand(2,254).'.'.rand(2,254).'.'.rand(2,254);
requests::set_client_ip($ip);
requests::set_header('accept-language', 'zh-CN,zh;q=0.9');

$base = "https://www.amazon.com";

$html = requests::get("https://www.amazon.com/gp/site-directory?ref=nav_shopall_btn");


$ts = selector::select($html, 'div.fsdDeptCol','css');////*[@id="a-page"]/div[2]/div[1]
foreach ($ts as $t){
   $tem_1= selector::select($t, '//a');
   $tem_2= selector::select($t, '//a/@href');
   
   $html_temp = '';
   
   foreach ($tem_1 as $k=>$val){
       $tem = []; 
       
       $tem['name'] = $val;
       $tem['url'] = $base.$tem_2[$k];
       
       
       echo $tem['name'].'-';
//        echo $tem['url']."\n";
       //递归
       
       
      do_con($tem['url']);
//        $html_temp = requests::get($tem['url']);
       
//        $a = selector::select($html_temp, '//*[@id="leftNav"]/ul[1]');
       
//        if (empty($a)){
//            echo "\n";
//            continue;
//        };
       
       
//        $ul2_f = selector::select($html_temp, '//*[@id="leftNav"]/ul[1]/ul/div');//
       
       
       
//        if (empty($ul2_f)){
//            echo "\n";
//            continue;
//        };
       
//        //还有 继续
//        $a1s = selector::select($ul2_f, 'span.a-list-item','css');//
//        foreach ($a1s as $a1){
//            ////*[@id="leftNav"]/ul[1]/ul/div/li[1]/span/a
//            $tem1 = [];
//            $tem1['name'] = selector::select($a1, '/span');
//            $tem1['url'] = $base.selector::select($a1, '/a/@href');
//        }
       
       
       
       
//        exit;
   }
   
   
   
}

// var_dump($ts);

exit;

function do_con($url){
    
    
   
        $html_temp = requests::get($url);
       
       $a = selector::select($html_temp, '//*[@id="leftNav"]/ul[1]');
       $a = !empty($a)?$a:selector::select($html_temp, '//*[@id="leftNavContainer"]/ul[1]');
       
       if (empty($a)){
           echo "\n";
           return ;
       };
       
       
       $ul2_f = selector::select($html_temp, '//*[@id="leftNav"]/ul[1]/ul/div');////*[@id="leftNavContainer"]/ul[1]/ul/div
       
       $ul2_f = !empty($ul2_f)?$ul2_f:selector::select($html_temp, '//*[@id="leftNavContainer"]/ul[1]/ul/div');
       
       if (empty($ul2_f)){
           echo "\n";
           return ;
       };
       
       //还有 继续
       $a1s = selector::select($ul2_f, 'span.a-list-item','css');//
       if (empty($a1s)){
           echo "\n";
           return ;
       };
       
       $base = "https://www.amazon.com";
       foreach ($a1s as $a1){
           ////*[@id="leftNav"]/ul[1]/ul/div/li[1]/span/a
           $tem1 = [];
           $tem1['name'] = selector::select($a1, '/span');
           $tem1['url'] = $base.selector::select($a1, '/a/@href');
           
           echo $tem1['name'].'-';
           do_con($tem1['url']);
           
           
       }
       
    
    
    
}





