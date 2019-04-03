<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */



$page = 18014;
// $page = 900;

requests::set_referer('http://www.nz86.com/companies/');
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36');
while ($page<60000) {
    $temp =[];
    $var = $page;
    if ($page<1000){
        $var=sprintf("%04d", $page);
    }else if($page<9999){
        $var=sprintf("%05d", $page);
    }
    $ip = rand(2,254).'.'.rand(2,254).'.'.rand(2,254).'.'.rand(2,254);
    requests::set_client_ip($ip);
    $html = requests::get("http://user{$var}.nz86.com/");
    if(requests::$status_code==404){
        $page++;
        continue;
    }
    $temp['page'] = $var;
    
    $temp['name'] =  trim(selector::select($html, "h1", "css"));
    
    $box = selector::select($html, "ul.brd-file", "css");
    
    
    if(!empty($box)){//右下结构
       $lis = selector::select($box, "//li");
       
//        var_dump($lis);exit; 
        
        foreach ($lis as $li){
            $f = selector::select($li, "//p");
            switch ($f) {
                case '联 系 人：':
                    $temp['contact'] = selector::select($li, "//div/span");
                    break;
                case '固定电话：':
                    $temp['tel'] = selector::select($li, "//div/span/img//@src");
                    break;
                case '移动电话：':
                    $temp['mobile'] = selector::select($li, "//div/span/img//@src");
                    break;
                case '企业网址：':
                    $temp['url'] = selector::select($li, "//div/span/a//@href");
                    break;
                case '联系地址：':
                    $temp['url'] = selector::select($li, "//div/span");
                    break;
                default:
                    ;
                break;
            }
            
        }
        
        
        echo json_encode($temp)."\n";
    }else{////顶部
        $box1 = selector::select($html, "ul.arch_ul", "css");
        if(!empty($box1)){
            $ps = selector::select($box, "//p");
             
            //        var_dump($lis);exit;
            
            foreach ($ps as $p){
                $f = selector::select($li, "//@text");
                $f = trim($f);
                switch ($f) {
                    case '市场定位：':
                        $temp['market'] = selector::select($li, "//span");
                        break;
                    case '主营风格：':
                        $temp['main'] = selector::select($li, "//span");
                        break;
                    case '联系人：':
                        $temp['contact'] = selector::select($li, "//span");
                        break;
                    case '手机：':
                        $temp['mobile'] = selector::select($li, "//div/span/img//@src");
                        break;
                    default:
                        ;
                        break;
                }
            
            }
            
            
            echo json_encode($temp)."\n";
            
            
            
        }
    }
    
    
    usleep(200);
    $page++;
}

exit;







