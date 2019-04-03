<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */



$page = 1;

requests::set_referer('http://www.nz86.com/brands/');
requests::set_useragent('Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1');
while ($page<=312) {
    
    
    $temp =[];
    
    
    $ip = rand(2,254).'.'.rand(2,254).'.'.rand(2,254).'.'.rand(2,254);
    requests::set_client_ip($ip);
    $html = requests::get("http://www.nz86.com/brands/p{$page}/");

    
    if(requests::$status_code==404){
        $page++;
        continue;
    }
    
    
    $ul = selector::select($html, "ul.ppdq_ullist", "css");
    
    $lis = selector::select($ul, "//li");
    
    foreach ($lis as $li){
        ///html/body/div[6]/div[2]/div[4]/ul/li[1]/div[1]/div[2]/div/span[1]/a
        $temp =[];
        $temp['brands'] = selector::select($li, "//div[1]/div[2]/div/span[1]/a//@title");
        $temp['url'] = selector::select($li, "//div[1]/div[2]/div/span[1]/a//@href");
        
        $result = explode('/', $temp['url']);
        
        $temp['sec'] = $result[4];
        //http://m.nz86.com/brand/getLinkMan.shtml?brandId=ff80808141df860b0141e44c426d000c
        
        $contact_html = requests::get("http://m.nz86.com/brand/getLinkMan.shtml?brandId={$temp['sec']}");
        
        $div = selector::select($contact_html, "div.msg_contact", "css");
        
        $uls = selector::select($div, "//ul");
        
        if (!is_array($uls)){
            $a = $uls;
            unset($uls);
            $uls[] = $a;
        }
        $com_s = array();
        foreach ($uls as $ul){
            $lis = selector::select($ul, "//li");
            $tem = [];
           
            if (!is_array($lis)){
                $a = $lis;
                unset($lis);
                $lis[] = $a;
            }
            foreach ($lis as $li){
                
                $f = selector::select($li, "//span[1]");
               
                if (is_array($f))$f = $f[0];
                switch ($f) {
                    case '联系人:':
                        $tem['contact'] = selector::select($li, "//span[2]");
                        break;
                    case '移动电话:':
                        $tem['mobile'] = selector::select($li, "//span[2]/a//@href");
                        
                        if (is_array($tem['mobile']))$tem['mobile'] = $tem['mobile'][0];
                        $mmm = explode(':', $tem['mobile']);
                        
                        $tem['mobile'] = $mmm[1];
                        
                        break;
                    case '固定电话:':
                        $tem['tel'] = selector::select($li, "//span[2]/a//@href");
                        
                        if (is_array($tem['tel']))$tem['tel'] = $tem['tel'][0];
                        $mmm = explode(':', $tem['tel']);
                        
                        $tem['tel'] = $mmm[1];
                        break;
                    default:
                        ;
                    break;
                }
                
            }
            $com_s[] = $tem;
        }
        
        $temp['com_s'] = $com_s;
        echo json_encode($temp)."\n";
    }
    
    
    
    usleep(200);
    $page++;
}

exit;







