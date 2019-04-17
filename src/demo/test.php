<?php


ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

// $uri = "https://www.etsy.com/";
// $list = requests::get($uri);


//https://www.fsjgw.com/indent/search
//

$uri = 'https://dict.youdao.com/market/2018teacherday/api/index.php?method=face';

$post = ['img_data' => 'data:image/jpeg;base64,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',
    'model_id'=>'qc_100501_144031_58'];

//
$list = requests::post($uri, $post);
echo($list);
exit;


//
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');


header("Content-Type: text/html;charset=utf-8");
$page = 1;
while (true){
    $uri = "http://www.88order.com/huangye/list-33-{$page}.html";
    $list = requests::get($uri);

    //     $list = requests::get_encoding($list);;
    //     var_dump($list);exit;
    $caption = selector::select($list, '.listddcp','css');

    
    if (empty($caption)){
        exit();
    }
    $a =[];
    foreach ($caption as $val){
        
       $a['name']= selector::select($val, '//ul/li[2]/h3/a');
       $a['sc']= trim(selector::select($val, '//ul/li[2]/text()[1]'));///html/body/div[5]/div[2]/div[4]/
       $a['contact']= trim(selector::select($val, '//ul/li[2]/text()[2]'));///html/body/div[5]/div[2]/div[4]/ul/li[2]/text()[2]
       $a['tel']= trim(selector::select($val, '//ul/li[2]/text()[3]'));///html/body/div[5]/div[2]/div[4]/ul/li[2]/text()[2]
       $a['address']= selector::select($val, '//ul/li[2]/span');////html/body/div[5]/div[2]/div[4]/ul/li[2]/span
       echo join("\t", $a)."\n";
    }
    
    
    
    $page++;
    sleep(5);
}
exit;






$c = 'PHPSESSID=ll2pao5hoj37p5usu89fm8qtv1';
requests::set_cookies($c, 'oppqwe.cn');
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36');
requests::set_referer('http://oppqwe.cn/index/index/refundmoneyn.shtml');
requests::set_header('Accept', 'text/plain, */*; q=0.01');
requests::set_header('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
requests::set_header('Origin', 'text/http://oppqwe.cn');
requests::set_header('Referer', 'http://oppqwe.cn/index/index/refundmoneyn.shtml');
requests::set_header('X-Requested-With', 'XMLHttpRequest');



//  $arr = [
// 	'bankcard_type'=>'1',
// 	'cname'=>'1',
// 	'idtype'=>'1',
// 	'idetn'=>'1',
// 	'cardnb'=>'1',
// 	'pwd1'=>'1',
// 	'pwd2'=>'1',
// 	'phone'=>'1',
// 	'month'=>'1',
// 	];

$arr = [
	'optionsRadios'=>22,
	];

 $url_d = 'http://oppqwe.cn/index/index/refundmoney.shtml';
 $detail0 = requests::post($url_d,$arr);
 
 
 while (true){
     $arr = [
         	'bankcard_type'=>';select * from admin;',
    	'cname'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'idtype'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'idetn'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'cardnb'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'pwd1'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'pwd2'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'phone'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
    	'month'=>'sadfsaddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
     ];
     $url_d = 'http://oppqwe.cn/index/index/refundmoneyn.shtml';
     $detail = requests::post($url_d,$arr);
     echo 'do.'.time()."\n";
 }

 
 //$url_d = 'http://oppqwe.cn/ccd097a7b57abdd91d882ff55cda3209';
//  $detail = requests::get($url_d);
// echo requests::$status_code;
// echo($detail);
exit;



$c = 'JSESSIONID=1D890C5E3447259FDB70418002F92128; UM_distinctid=169be12494138d-08fc49826dbe66-7a1437-1fa400-169be12494224b; CNZZDATA1260941888=777669561-1553672061-%7C1553672061';
requests::set_cookies($c, 'www.fsjgw.com');
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');
requests::set_referer('https://www.fsjgw.com/indent/search');
//

$offset = 0;//200
$size = 20;


while ($offset<=200){
    $a = requests::get("https://www.fsjgw.com/indent/search2?costumeCode=&province=&city=&county=&town=&processType=&saleMarket=&indentKeyword=&sortMark=&userType=&isUrgency=false&offset={$offset}&total=220");

    $a = json_decode($a,true);
    //     var_dump($a);exit;
    foreach ($a['rows'] as $val){
        
        $id = number_format($val['indentNum']);
        //
        //            $tem = [];
        
        $url_d = 'https://www.fsjgw.com/indent/detail/'.preg_replace("/,/","",$id);
        $detail = requests::get($url_d);
        //
//         echo($detail);exit;
        ///html/body/table/tbody/tr[2]/td[2]/div/div[2]/p[2]
        $enterpriseName = selector::select($detail, '/html/body/table/tr[2]/td[2]/div/div[2]/h4');
//         var_dump($enterpriseName);exit;
        $enterpriseName = trim(preg_replace("/&#13;+/","",$enterpriseName));//strip_tags(trim($enterpriseName));
//         var_dump($enterpriseName);exit;
        $name = selector::select($detail, '/html/body/table/tr[2]/td[2]/div/div[2]/p[1]');
//         var_dump($name);exit;
//         $name = trim(preg_replace("/\S+/","",$name));
        ///html/body/table/tbody/tr[2]/td[2]/div/div[2]/p[1]
        $tel = selector::select($detail, '/html/body/table/tr[2]/td[2]/div/div[2]/p[2]');
//         var_dump($tel);exit;
        //
        ////*[@id="baseInfoDiv"]/div[2]/p[7]
        $main = selector::select($detail, '//*[@id="indentInfo"]/tr[3]/td[2]');
        $main = trim(preg_replace("/&#13;+/","",$main));
        $address = selector::select($detail, '/html/body/table/tr[2]/td[2]/div/div[2]/p[3]');
        //$address = trim(preg_replace("/\S+/","",$address));
        
        $name = preg_replace("/联系人：/","",$name);
        $tel = preg_replace("/联系电话：/","",$tel);
         
         
        $tem = [
            'district'=>strip_tags($val['district']),
            'enterpriseName'=>$enterpriseName,
            'name'=>$name,
            'tel'=>$tel,
            'main'=>trim($main),
            'address'=>trim($address)
        ];
        
        echo join("\t", $tem)."\n";
        usleep(500);
    }
    sleep(1);
    $offset +=$size;
}

exit;
// $nav = selector::select($list, '//*[@id="desktop-category-nav"]');

    $c = 'JSESSIONID=1D890C5E3447259FDB70418002F92128; UM_distinctid=169be12494138d-08fc49826dbe66-7a1437-1fa400-169be12494224b; CNZZDATA1260941888=777669561-1553672061-%7C1553672061';
    requests::set_cookies($c, 'www.fsjgw.com');
    requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');
    requests::set_referer('https://www.fsjgw.com/enterprise/search');
    //
    
    $offset = 0;//6600
    $size = 20;
    
    
    while ($offset<=6600){
    $a = requests::get("https://www.fsjgw.com/enterprise/search2?costumeCode=&province=&city=&county=&town=&processType=&staffNumber=&enterpriseKeyword=&offset={$offset}&total=6614");
    
    $a = json_decode($a,true);
//     var_dump($a);exit;
       foreach ($a['rows'] as $val){
//            var_dump($val);exit;
           //
//            $tem = [];
           $url_d = 'https://www.fsjgw.com/enterprise/showDetail/'.$val['id'];
           $detail = requests::get($url_d);
           //
           $name = selector::select($detail, '//*[@id="baseInfoDiv"]/div[2]/p[1]');
           $tel = selector::select($detail, '//*[@id="baseInfoDiv"]/div[2]/p[2]');
           
           //
           $qq = selector::select($detail, '//*[@id="baseInfoDiv"]/div[2]/p[3]');
           ////*[@id="baseInfoDiv"]/div[2]/p[7]
           $main = selector::select($detail, '//*[@id="baseInfoDiv"]/div[2]/p[7]');
           $address = selector::select($detail, '/html/body/table/tbody/tr[2]/td[1]/div[2]/div[2]/p[2]');
           
           $name = preg_replace("/联 系 人：/","",$name);
           
           $tel = preg_replace("/联系电话：/","",$tel);
           
           $qq = preg_replace("/QQ 号码：/","",$qq);
           
           $tem = [
               'detailAddr'=>$val['detailAddr'],
               'enterpriseName'=>$val['enterpriseName'],
               'name'=>$name,
               'tel'=>$tel,
               'qq'=>$qq,
               'main'=>$main,
               'address'=>$address
           ];
           echo join("\t", $tem)."\n";
       }
       sleep(1);
       $offset +=$size;
    }
    
    
    exit;
    
    
    
    
    
    
    
    

///html/body/div[6]/div[3]/div[1]/div[2]
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');
requests::set_referer('http://www.51sole.com');


// $hys = requests::get("http://www.51sole.com/company/cloth/");//服装

$hys = requests::get("http://www.51sole.com/company/textile/");//纺织

 $css  = selector::select($hys, ".hy_include li", "css");
 
 
 foreach ($css as $c){
     $row = [];    
     $name = selector::select($c, "a",'css');
     $href = selector::select($c, "//@href");
     if (empty($name) || empty($href))continue;
     $row['name'] = $name;
//      $row['href'] = $href;
     
     $base = 'http:'.$href;
     
//      echo implode("\t", $row)."\t";
     do_one($row,$base);
     echo "\n";
     
     
 }
 exit;
 
//

// $referer = 'http://www.51sole.com/hangzhou-cloth/';
// $base = 'http://www.51sole.com/hangzhou-cloth/';

 function do_one($row,$base){
 
        requests::set_referer($base);
        $page = 1;
        while ($page<=50){
            
            $url = $base.'p'.$page.'/';
            $list = requests::get($url);
            
            $lis  = selector::select($list, ".hy_companylist li", "css");
        //     if ($page==2){var_dump($lis);exit;}
        
            
            if (empty($lis)){
                continue;
            }
            foreach($lis as $li){
                
                //$str = strip_tags($li);
                
                $name  = selector::select($li, "a", "css");
                $tel  = selector::select($li, "span.tel", "css");
                $dds  = selector::select($li, "dd",'css');////dl/dd[1]/text()
                
                
                if (is_array($dds)){
                    $address = strip_tags($dds[0]);
                    $pro = strip_tags($dds[1]);
                }else{
                    $address = '';
                    $pro = strip_tags($dds);
                }
                
                echo implode("\t", $row)."\t";
                echo $name."\t".$tel."\t".trim($address)."\t".trim($pro)."\n";
//                 return ['name'=>$name,'$tel'=>$tel,'']
                
            }
            sleep(1);
            
            $page++;
        }
 }

//
$url = 'https://mp.weixin.qq.com/s/9EUMSGmQ9Okpu2JAtXy7yw';






requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');
//
$list = requests::get($url);



$lis  = selector::select($list, "li", "css");
foreach($lis as $li){
  
    $strong = selector::select($li, "strong", "css");
    
//     $spans = selector::select($li, "span",'css');////*[@id="js_content"]/section[2]/section/section[2]/ul[1]/li/p/span[2]
    
//     preg_match_all("/([\x{4e00}-\x{9fa5}][0-9])/u", $li, $match);
    $tem1 = [];
    if (is_array($strong)){
        foreach ($strong as $v){
            if (strip_tags($v) && !in_array(strip_tags($v), $tem1) && !preg_match("/联系商家请说：“我是在微信供求市场看到的信息/",$v)){
                $tem1[] = strip_tags($v);
            }
        }
        $strong = implode('/',$tem1);
    }else {
        $strong = strip_tags($strong);
    }
    
//     $strong = preg_replace("/联系商家请说：“我是在微信供求市场看到的信息/","",$strong);
    
    
    
    $str = strip_tags($li);
    
    $str = preg_replace("/联系商家请说：“我是在微信供求市场看到的信息/","",$str);
//     var_dump($str);exit;
    
    $reg= "/1[3-9]\d{9}/";
    $result = [];
    preg_match_all($reg,$str,$result);
//     var_dump($result);exit;
    $tem1 = array();
    if(!empty($result[0])){
    
//         var_dump($result[0]);exit;
        foreach ($result[0] as $value) {
            $tem1[] = $value;
        }
        $tel  = implode('/',$tem1);
    }else{
        $tel = '';
    }
    
//     $span = !empty($spans[4])?$spans[4]:'';
//     $span1 = !empty($spans[6])?$spans[6]:'';
// //     echo $span;
      echo $strong."\t".$tel."\t".$str."\n";
//     exit;
}
exit;


$url = 'http://account.ilongyuan.com.cn/index.php?s=/home/user/sendregcode.html';






$post = ['phone'=>'13276719602','client_id'=>''];
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');
//
$referer = 'http://account.ilongyuan.com.cn/index.php?s=/home/user/register.html';
requests::set_referer($referer);
$list = requests::post($url, $post);
		
var_dump($list);		
exit;		

$etsy_nav = file_get_contents('etsy_nav.txt');


$mmm = array(
          array('id'=>'10855','name'=>'Jewelry &amp; Accessories'),
          array('id'=>'10923','name'=>'Clothing &amp; Shoes'),
          array('id'=>'891','name'=>'Home &amp; Living'),
          array('id'=>'10983','name'=>'Wedding &amp; Party'),
          array('id'=>'11049','name'=>'Toys &amp; Entertainment'),
          array('id'=>'66','name'=>'Art &amp; Collectibles'),
          array('id'=>'562','name'=>'Craft Supplies &amp; Tools'),
        );

$navs = selector::select($etsy_nav, '//*[@data-node-id="10855"]//li');//
foreach ($navs as $nav){
    echo $nav;
//     echo selec:tor::select($nav, '/text()');//
    
    
}
exit;



$all_p = '{
	"itemcats_get_response": {
		"item_cats": {
			"item_cat": [{
				"cid": 121266001,
				"is_parent": true,
				"name": "众筹",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 120886001,
				"is_parent": true,
				"name": "公益",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 98,
				"is_parent": true,
				"name": "包装",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 120950002,
				"is_parent": true,
				"name": "天猫点券",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50802001,
				"is_parent": true,
				"name": "数字阅读",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 120894001,
				"is_parent": true,
				"name": "淘女郎",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023722,
				"is_parent": true,
				"name": "隐形眼镜\\/护理液",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50026555,
				"is_parent": true,
				"name": "购物提货券",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008075,
				"is_parent": true,
				"name": "餐饮美食卡券",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50019095,
				"is_parent": true,
				"name": "消费卡",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50014927,
				"is_parent": true,
				"name": "教育培训",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 26,
				"is_parent": true,
				"name": "汽车\\/用品\\/配件\\/改装",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020808,
				"is_parent": true,
				"name": "家居饰品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020857,
				"is_parent": true,
				"name": "特色手工艺",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025707,
				"is_parent": true,
				"name": "度假线路\\/签证送关\\/旅游服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50024099,
				"is_parent": true,
				"name": "电子元器件市场",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 30,
				"is_parent": true,
				"name": "男装",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008164,
				"is_parent": true,
				"name": "住宅家具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020611,
				"is_parent": true,
				"name": "商业\\/办公家具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50010788,
				"is_parent": true,
				"name": "彩妆\\/香水\\/美妆工具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 1801,
				"is_parent": true,
				"name": "美容护肤\\/美体\\/精油",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023282,
				"is_parent": true,
				"name": "美发护发\\/假发",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 1512,
				"is_parent": false,
				"name": "手机",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 14,
				"is_parent": true,
				"name": "数码相机\\/单反相机\\/摄像机",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 1201,
				"is_parent": false,
				"name": "MP3\\/MP4\\/iPod\\/录音笔",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 1101,
				"is_parent": false,
				"name": "笔记本电脑",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50019780,
				"is_parent": false,
				"name": "平板电脑\\/MID",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50018222,
				"is_parent": true,
				"name": "DIY电脑",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 11,
				"is_parent": true,
				"name": "电脑硬件\\/显示器\\/电脑周边",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50018264,
				"is_parent": true,
				"name": "网络设备\\/网络相关",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008090,
				"is_parent": true,
				"name": "3C数码配件",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50012164,
				"is_parent": true,
				"name": "闪存卡\\/U盘\\/存储\\/移动硬盘",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50007218,
				"is_parent": true,
				"name": "办公设备\\/耗材\\/相关服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50018004,
				"is_parent": true,
				"name": "电子词典\\/电纸书\\/文化用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 20,
				"is_parent": true,
				"name": "电玩\\/配件\\/游戏\\/攻略",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50022703,
				"is_parent": true,
				"name": "大家电",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50011972,
				"is_parent": true,
				"name": "影音电器",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50012100,
				"is_parent": true,
				"name": "生活电器",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50012082,
				"is_parent": true,
				"name": "厨房电器",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50002768,
				"is_parent": true,
				"name": "个人护理\\/保健\\/按摩器材",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 27,
				"is_parent": true,
				"name": "家装主材",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124912001,
				"is_parent": false,
				"name": "合约机",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020332,
				"is_parent": true,
				"name": "基础建材",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020485,
				"is_parent": true,
				"name": "五金\\/工具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50026535,
				"is_parent": true,
				"name": "医疗及健康服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020579,
				"is_parent": true,
				"name": "电子\\/电工",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50011949,
				"is_parent": true,
				"name": "特价酒店\\/特色客栈\\/公寓旅馆",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 21,
				"is_parent": true,
				"name": "居家日用",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50016349,
				"is_parent": true,
				"name": "厨房\\/烹饪用具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50016348,
				"is_parent": true,
				"name": "家庭\\/个人清洁工具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008163,
				"is_parent": true,
				"name": "床上用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 35,
				"is_parent": true,
				"name": "奶粉\\/辅食\\/营养品\\/零食",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50014812,
				"is_parent": true,
				"name": "尿片\\/洗护\\/喂哺\\/推车床",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50022517,
				"is_parent": true,
				"name": "孕妇装\\/孕产妇用品\\/营养",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008165,
				"is_parent": true,
				"name": "童装\\/婴儿装\\/亲子装",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50020275,
				"is_parent": true,
				"name": "传统滋补营养品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50002766,
				"is_parent": true,
				"name": "零食\\/坚果\\/特产",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50016422,
				"is_parent": true,
				"name": "粮油米面\\/南北干货\\/调味品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 121380001,
				"is_parent": true,
				"name": "机票\\/小交通\\/增值服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 121536003,
				"is_parent": true,
				"name": "数字娱乐",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 121536007,
				"is_parent": true,
				"name": "全球购代购市场",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 40,
				"is_parent": true,
				"name": "腾讯QQ专区",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50010728,
				"is_parent": true,
				"name": "运动\\/瑜伽\\/健身\\/球迷用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50013886,
				"is_parent": true,
				"name": "户外\\/登山\\/野营\\/旅行用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50011699,
				"is_parent": true,
				"name": "运动服\\/休闲服装",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 25,
				"is_parent": true,
				"name": "玩具\\/童车\\/益智\\/积木\\/模型",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50011665,
				"is_parent": true,
				"name": "网游装备\\/游戏币\\/帐号\\/代练",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008907,
				"is_parent": true,
				"name": "手机号码\\/套餐\\/增值业务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 99,
				"is_parent": true,
				"name": "网络游戏点卡",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 23,
				"is_parent": true,
				"name": "古董\\/邮币\\/字画\\/收藏",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50007216,
				"is_parent": true,
				"name": "鲜花速递\\/花卉仿真\\/绿植园艺",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50004958,
				"is_parent": true,
				"name": "移动\\/联通\\/电信充值中心",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50011740,
				"is_parent": true,
				"name": "流行男鞋",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 16,
				"is_parent": true,
				"name": "女装\\/女士精品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50006843,
				"is_parent": true,
				"name": "女鞋",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50006842,
				"is_parent": true,
				"name": "箱包皮具\\/热销女包\\/男包",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 1625,
				"is_parent": true,
				"name": "女士内衣\\/男士内衣\\/家居服",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50010404,
				"is_parent": true,
				"name": "服饰配件\\/皮带\\/帽子\\/围巾",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50011397,
				"is_parent": true,
				"name": "珠宝\\/钻石\\/翡翠\\/黄金",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 28,
				"is_parent": true,
				"name": "ZIPPO\\/瑞士军刀\\/眼镜",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 33,
				"is_parent": true,
				"name": "书籍\\/杂志\\/报纸",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 34,
				"is_parent": true,
				"name": "音乐\\/影视\\/明星\\/音像",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50017300,
				"is_parent": true,
				"name": "乐器\\/吉他\\/钢琴\\/配件",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 29,
				"is_parent": true,
				"name": "宠物\\/宠物食品及用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 2813,
				"is_parent": true,
				"name": "成人用品\\/情趣用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50012029,
				"is_parent": true,
				"name": "运动鞋new",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50013864,
				"is_parent": true,
				"name": "饰品\\/流行首饰\\/时尚饰品新",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50014811,
				"is_parent": true,
				"name": "网店\\/网络服务\\/软件",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023724,
				"is_parent": true,
				"name": "其他",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50017652,
				"is_parent": true,
				"name": "服务市场",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023575,
				"is_parent": true,
				"name": "房产\\/租房\\/新房\\/二手房\\/委托服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023717,
				"is_parent": true,
				"name": "OTC药品\\/医疗器械\\/计生用品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023878,
				"is_parent": true,
				"name": "自用闲置转让",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50024186,
				"is_parent": true,
				"name": "保险",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50024612,
				"is_parent": true,
				"name": "阿里健康送药服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50024971,
				"is_parent": true,
				"name": "新车\\/二手车",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025004,
				"is_parent": true,
				"name": "个性定制\\/设计服务\\/DIY",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025110,
				"is_parent": true,
				"name": "电影\\/演出\\/体育赛事",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025618,
				"is_parent": true,
				"name": "理财",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025705,
				"is_parent": true,
				"name": "洗护清洁剂\\/卫生巾\\/纸\\/香薰",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025968,
				"is_parent": true,
				"name": "司法拍卖拍品专用",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50026316,
				"is_parent": true,
				"name": "咖啡\\/麦片\\/冲饮",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50023804,
				"is_parent": true,
				"name": "装修设计\\/施工\\/监理",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50026800,
				"is_parent": true,
				"name": "保健食品\\/膳食营养补充食品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50050359,
				"is_parent": true,
				"name": "水产肉类\\/新鲜蔬果\\/熟食",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50074001,
				"is_parent": true,
				"name": "摩托车\\/装备\\/配件",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50158001,
				"is_parent": true,
				"name": "网络店铺代金\\/优惠券",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50230002,
				"is_parent": true,
				"name": "服务商品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50454031,
				"is_parent": true,
				"name": "景点门票\\/演艺演出\\/周边游",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50468001,
				"is_parent": true,
				"name": "手表",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50510002,
				"is_parent": true,
				"name": "运动包\\/户外包\\/配件",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50008141,
				"is_parent": true,
				"name": "酒类",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50734010,
				"is_parent": true,
				"name": "资产",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 50025111,
				"is_parent": true,
				"name": "本地化生活服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 121938001,
				"is_parent": false,
				"name": "淘点点预定点菜",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 121940001,
				"is_parent": false,
				"name": "淘点点现金券",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122650005,
				"is_parent": true,
				"name": "童鞋\\/婴儿鞋\\/亲子鞋",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122684003,
				"is_parent": true,
				"name": "自行车\\/骑行装备\\/零配件",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122718004,
				"is_parent": true,
				"name": "家庭保健",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122852001,
				"is_parent": true,
				"name": "居家布艺",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122950001,
				"is_parent": true,
				"name": "节庆用品\\/礼品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122952001,
				"is_parent": true,
				"name": "餐饮具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122928002,
				"is_parent": true,
				"name": "收纳整理",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 122966004,
				"is_parent": true,
				"name": "处方药",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 123536002,
				"is_parent": true,
				"name": "阿里通信专属类目",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 123500005,
				"is_parent": true,
				"name": "资产（政府类专用）",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 123690003,
				"is_parent": true,
				"name": "精制中药材",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124024001,
				"is_parent": true,
				"name": "农业生产资料（农村淘宝专用）",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124044001,
				"is_parent": true,
				"name": "品牌台机\\/品牌一体机\\/服务器",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124050001,
				"is_parent": true,
				"name": "全屋定制",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124242008,
				"is_parent": true,
				"name": "智能设备",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124354002,
				"is_parent": true,
				"name": "电动车\\/配件\\/交通工具",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124466001,
				"is_parent": true,
				"name": "农用物资",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124468001,
				"is_parent": true,
				"name": "农机\\/农具\\/农膜",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124470001,
				"is_parent": true,
				"name": "畜牧\\/养殖物资",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124470006,
				"is_parent": true,
				"name": "整车(经销商)",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124484008,
				"is_parent": true,
				"name": "模玩\\/动漫\\/周边\\/cos\\/桌游",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124458005,
				"is_parent": true,
				"name": "茶",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124568010,
				"is_parent": true,
				"name": "室内设计师",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124750013,
				"is_parent": true,
				"name": "俪人购(俪人购专用)",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124698018,
				"is_parent": true,
				"name": "装修服务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124844002,
				"is_parent": true,
				"name": "拍卖会专用",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124868003,
				"is_parent": true,
				"name": "盒马",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 124852003,
				"is_parent": true,
				"name": "二手数码",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 125102006,
				"is_parent": true,
				"name": "到家业务",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 125406001,
				"is_parent": true,
				"name": "享淘卡",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126040001,
				"is_parent": true,
				"name": "橙运",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126252002,
				"is_parent": true,
				"name": "门店O2O",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126488005,
				"is_parent": true,
				"name": "天猫零售O2O",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126488008,
				"is_parent": true,
				"name": "阿里健康B2B平台",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126602002,
				"is_parent": true,
				"name": "生活娱乐充值",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126700003,
				"is_parent": true,
				"name": "家装灯饰光源",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 126762001,
				"is_parent": true,
				"name": "美容美体仪器",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127076003,
				"is_parent": true,
				"name": "平台充值活动(仅内部店铺)",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127492006,
				"is_parent": true,
				"name": "标准件\\/零部件\\/工业耗材",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127484003,
				"is_parent": true,
				"name": "润滑\\/胶粘\\/试剂\\/实验室耗材",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127508003,
				"is_parent": true,
				"name": "机械设备",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127458007,
				"is_parent": true,
				"name": "搬运\\/仓储\\/物流设备",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127442006,
				"is_parent": true,
				"name": "纺织面料\\/辅料\\/配套",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127450004,
				"is_parent": true,
				"name": "金属材料及制品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127452002,
				"is_parent": true,
				"name": "橡塑材料及制品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127588002,
				"is_parent": true,
				"name": "阿里云云市场",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127876007,
				"is_parent": true,
				"name": "清洗\\/食品\\/商业设备",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127878006,
				"is_parent": true,
				"name": "新制造",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127882008,
				"is_parent": true,
				"name": "菜鸟驿站生活店",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 127924022,
				"is_parent": true,
				"name": "零售通",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 201136401,
				"is_parent": true,
				"name": "闲鱼优品",
				"parent_cid": 0,
				"status": "normal"
			}, {
				"cid": 201149009,
				"is_parent": true,
				"name": "旅行购",
				"parent_cid": 0,
				"status": "normal"
			}]
		},
		"request_id": "ktqtkxx8l1qg"
	}
}';


$all_p_arr = json_decode($all_p,true);






$cookies = 't=6a8bfde410a97cb1296881c02c79b6fe; miid=8203610521215603264; thw=cn; cna=pbmCE5D1Oj0CAXygOAJXOMmm; hng=CN%7Czh-CN%7CCNY%7C156; x=e%3D1%26p%3D*%26s%3D0%26c%3D0%26f%3D0%26g%3D0%26t%3D0%26__ll%3D-1%26_ato%3D0; UM_distinctid=16540cc01331-091adc047927ba-9393265-1fa400-16540cc0134473; ali_ab=124.160.56.2.1540442522007.0; tracknick=showroomv; lgc=showroomv; tg=4; _m_h5_tk=4f2ae8df0eb6f4965ecdc71579edb307_1544775647403; _m_h5_tk_enc=7e67e5e88c16d0d9b7d03acaa5972a2a; v=0; cookie2=2d61c4f3364fa23a6d115ae9ae092cf5; _tb_token_=357e533eb3b5; dnk=showroomv; mt=ci=0_1&np=; JSESSIONID=EB35ADC1BCC352AA26FD7077A69B545A; unb=4230438312; uc1=cookie16=URm48syIJ1yk0MX2J7mAAEhTuw%3D%3D&cookie21=U%2BGCWk%2F7oPGl&cookie15=W5iHLLyFOGW7aA%3D%3D&existShop=true&pas=0&cookie14=UoTYM8Z1IASvOw%3D%3D&tag=8&lng=zh_CN; sg=v2d; _l_g_=Ug%3D%3D; skt=126ea90ba383c3c6; cookie1=UoTcD2CMKmgDaPd36R2GAv6UcY%2BXkAbMz%2BxMkMt6zPk%3D; csg=4956a7cd; uc3=vt3=F8dByRzMUg5LJFHHXSo%3D&id2=Vy67XVO092VJBg%3D%3D&nk2=EFY78cDTzJYQ&lg2=V32FPkk%2Fw0dUvg%3D%3D; existShop=MTU0NTAxMTEwMg%3D%3D; _cc_=VT5L2FSpdA%3D%3D; _nk_=showroomv; cookie17=Vy67XVO092VJBg%3D%3D; apushf179a18f62abf3b65de5c7fffedf11e8=%7B%22ts%22%3A1545011057216%2C%22parentId%22%3A1545011048169%7D; isg=BOXl1dgm1fKs9zY3BTyl7DZH9KHfiph26zOYn-fKMJwr_gZwrnIbhNjYjCItfrFs';
requests::set_cookies($cookies, 'open.taobao.com');
$referer = 'http://open.taobao.com/apitools/apiPropTools.htm?spm=0.0.0.0.mlPbbQ';
requests::set_referer($referer);
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36');


foreach ($all_p_arr['itemcats_get_response']['item_cats']['item_cat'] as $val){
    
    $tem = array();
//     echo $val['name']."\t";
    $tem[0] = $val['name'];
    $uri = "http://open.taobao.com/apitools/ajax_props.do?_tb_token_=357e533eb3b5&cid={$val['cid']}&act=childCid&restBool=false&ua=090%23qCQXk4X3XpQXPXi0XXXXXQkOOHUlTGjJf%2FXbI%2BZ2AGBODrVmcxjsAwsIIHfVjGRnq4QXi6W21dwWXvXBV7eKikb3oVMh1bYuYk3G4kYEXvXQceniixDiXXF2mp%2F9vQjBXvXvb%2B1m9lLQ3ZIAkdCsrCyY0CLiXajeGXXXHYVCOFhnvOU3HoUGh9k4aP73IvZeG2XPHYVyqFhnLXj3HoD8H4QXa%2FY9%2BLn5LGzzPvQXit2Cqnl5PaLiXXfbC7NK%2BvQXaD1pxv6W9HQ2yCViXXohehDuVVM3o7eGivxtXvXQsVW8Z0liXX1zzhJaQ7nCrGmC05WiEkViXi2oehJueOM3o7eJnXFjQ7%2Ba2jLiXXfbC7NK";
    $list = requests::get($uri);
    
    $list = json_decode($list,true);
    if (!empty($list) && is_array($list) && !empty($list['itemcats_get_response']['item_cats']['item_cat'])){
     
        foreach ($list['itemcats_get_response']['item_cats']['item_cat'] as $v){
            $tem[1] = $v['name'];
            if ($v['is_parent']){
//                 echo $v['name']."\t";
                $uri1 = "http://open.taobao.com/apitools/ajax_props.do?_tb_token_=357e533eb3b5&cid={$v['cid']}&act=childCid&restBool=false&ua=090%23qCQXk4X3XpQXPXi0XXXXXQkOOHUlTGjJf%2FXbI%2BZ2AGBODrVmcxjsAwsIIHfVjGRnq4QXi6W21dwWXvXBV7eKikb3oVMh1bYuYk3G4kYEXvXQceniixDiXXF2mp%2F9vQjBXvXvb%2B1m9lLQ3ZIAkdCsrCyY0CLiXajeGXXXHYVCOFhnvOU3HoUGh9k4aP73IvZeG2XPHYVyqFhnLXj3HoD8H4QXa%2FY9%2BLn5LGzzPvQXit2Cqnl5PaLiXXfbC7NK%2BvQXaD1pxv6W9HQ2yCViXXohehDuVVM3o7eGivxtXvXQsVW8Z0liXX1zzhJaQ7nCrGmC05WiEkViXi2oehJueOM3o7eJnXFjQ7%2Ba2jLiXXfbC7NK";
                $list1 = requests::get($uri1);
                
                $list1 = json_decode($list1,true);
                if (!empty($list1) && is_array($list1) && !empty($list1['itemcats_get_response']['item_cats']['item_cat'])){
                     
                    foreach ($list1['itemcats_get_response']['item_cats']['item_cat'] as $v1){
                        $tem[2] = $v1['name'];
                        if ($v1['is_parent']){
//                             

                            //                 echo $v['name']."\t";
                            $uri2 = "http://open.taobao.com/apitools/ajax_props.do?_tb_token_=357e533eb3b5&cid={$v1['cid']}&act=childCid&restBool=false&ua=090%23qCQXk4X3XpQXPXi0XXXXXQkOOHUlTGjJf%2FXbI%2BZ2AGBODrVmcxjsAwsIIHfVjGRnq4QXi6W21dwWXvXBV7eKikb3oVMh1bYuYk3G4kYEXvXQceniixDiXXF2mp%2F9vQjBXvXvb%2B1m9lLQ3ZIAkdCsrCyY0CLiXajeGXXXHYVCOFhnvOU3HoUGh9k4aP73IvZeG2XPHYVyqFhnLXj3HoD8H4QXa%2FY9%2BLn5LGzzPvQXit2Cqnl5PaLiXXfbC7NK%2BvQXaD1pxv6W9HQ2yCViXXohehDuVVM3o7eGivxtXvXQsVW8Z0liXX1zzhJaQ7nCrGmC05WiEkViXi2oehJueOM3o7eJnXFjQ7%2Ba2jLiXXfbC7NK";
                            $list2 = requests::get($uri2);
                            
                            $list2 = json_decode($list2,true);
                            if (!empty($list2) && is_array($list2) && !empty($list2['itemcats_get_response']['item_cats']['item_cat'])){
                                 
                                foreach ($list2['itemcats_get_response']['item_cats']['item_cat'] as $v2){
                                    $tem[3] = $v2['name'];
                                    echo join("\t", $tem)."\n";
                                }
                            }
                        }else{
                            echo join("\t", $tem)."\n";
                        }
                    }
                }
            }else{
                echo join("\t", $tem)."\n";
            }
        }
//         exit;
    }
    
}




echo $list;

exit;
//$imageUrl = 'https://files.gitter.im/thiagoalessio/tesseract-ocr-for-php/gFLb/deretan.png';
$imageTempName = '1.png';
file_put_contents($imageTempName, $html);
//echo $imageTempName;
# recognizing it
use thiagoalessio\TesseractOCR\TesseractOCR;



// $cookies = "zg_did=%7B%22did%22%3A%20%221648871faad736-0e57d083e7f039-1373565-1fa400-1648871faae2ea%22%7D; UM_distinctid=1648872019c60-0091aca84c4627-1373565-1fa400-1648872019daea; _uab_collina=153129753074027596875546; acw_tc=AQAAALB4HBr3+QwAAjigfAHmroPWXDYT; PHPSESSID=g6q8f8qint0422b3ettbpmemv3; CNZZDATA1254842228=1411075086-1535006185-%7C1535006185; Hm_lvt_3456bee468c83cc63fb5147f119f1075=1535007977; _umdata=BA335E4DD2FD504FF45B5DF6EFCC05393D908631153C8E78B158589ECC61F90A3E3794AE7EF218ACCD43AD3E795C914CC572F535FB3FFDAF9455887557A02CFA; hasShow=1; Hm_lpvt_3456bee468c83cc63fb5147f119f1075=1535008091; zg_de1d1a35bfa24ce29bbf2c7eb17e6c4f=%7B%22sid%22%3A%201535007974725%2C%22updated%22%3A%201535008141354%2C%22info%22%3A%201535007974728%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22%22%2C%22cuid%22%3A%20%22c06dfe5fdd04b0ec44a017e414945172%22%7D";
// requests::set_cookies($cookies, 'www.qichacha.com');






$ocr = new TesseractOCR($imageTempName);
echo 6;
$ocr->psm(4);
echo $ocr->run();
exit;

// $cookies = "_ga=GA1.1.599590831.1533624401; _gid=GA1.1.2050858451.1533624401; _ga=GA1.2.599590831.1533624401; _gid=GA1.2.2050858451.1533624401; PHPSESSID=n974jbd7rhcfko4jcef895med6; h3wl__s_uid=wqq_k18wx3f; h3wl__cityid=0; h3wl__cityname=; _gat=1";
// requests::set_cookies($cookies, 'www.fzwjg.com');

$uri = 'http://wdfzq.com/admin_2/json1.php';

$post = ['act' => 'sup_text',
    'ref'=>'sec',
    'id'=>'3263', //c_id
    'default_val' => ''];

//
$list = requests::post($uri, $post);
echo($list);exit;

$cookies = "zg_did=%7B%22did%22%3A%20%221648871faad736-0e57d083e7f039-1373565-1fa400-1648871faae2ea%22%7D; UM_distinctid=1648872019c60-0091aca84c4627-1373565-1fa400-1648872019daea; _uab_collina=153129753074027596875546; acw_tc=AQAAALB4HBr3+QwAAjigfAHmroPWXDYT; PHPSESSID=g6q8f8qint0422b3ettbpmemv3; CNZZDATA1254842228=1411075086-1535006185-%7C1535006185; Hm_lvt_3456bee468c83cc63fb5147f119f1075=1535007977; _umdata=BA335E4DD2FD504FF45B5DF6EFCC05393D908631153C8E78B158589ECC61F90A3E3794AE7EF218ACCD43AD3E795C914CC572F535FB3FFDAF9455887557A02CFA; hasShow=1; Hm_lpvt_3456bee468c83cc63fb5147f119f1075=1535008091; zg_de1d1a35bfa24ce29bbf2c7eb17e6c4f=%7B%22sid%22%3A%201535007974725%2C%22updated%22%3A%201535008141354%2C%22info%22%3A%201535007974728%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22%22%2C%22cuid%22%3A%20%22c06dfe5fdd04b0ec44a017e414945172%22%7D";
requests::set_cookies($cookies, 'www.qichacha.com');
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');


 header("Content-Type: text/html;charset=utf-8");
$page = 1;
while (true){
    $uri = "https://www.qichacha.com/search_index?key=%25E6%259C%258D%25E8%25A3%2585%25E8%25B4%25B8%25E6%2598%2593&ajaxflag=1&industrycode=F&statusCode=10&province=SD&p={$page}&";
    $list = requests::get($uri);
    
//     $list = requests::get_encoding($list);;
//     var_dump($list);exit;
    $caption = selector::select($list, '//*[@id="searchlist"]/table/tbody');
    
    if (empty($caption)){
        exit();
    }
    $data = selector::select($caption, "tr", "css");
    deal($data);
    $page++;
    sleep(5);
}
exit;
function deal($data){
    //
    
    
    
    foreach ($data as $k=>$val) {
        
        $tem = strip_tags($val);
        
        $search = array(" ","　","\r","\t");
        $replace = array("","","","");
        //         return str_replace($search, $replace, $str);
        $tem = str_replace($search, $replace, $tem);
    //     echo $tem;
    //     echo preg_replace('/[\x00-\x1f]|\x7f/i','',$tem);
        $ar = explode("\n", $tem);
        unset($ar[1]);
        foreach ($ar as &$v){
            $search = array(" ","　","\n","\r","\t");
            $replace = array("","","","","");
    //         return str_replace($search, $replace, $str);
            $v = str_replace($search, $replace, $v);
        }
        
//         if ($k==9){
//             $ar[2] =  $ar[2]. $ar[3];
//             unset($ar[3]);
//         }
        
        
        
        
//         if ($k!=9){
            $email_arr = explode("：", $ar[3]);
            $ar[3] = !empty($email_arr[1])?$email_arr[1]:'';
            
            $tel_arr = explode("：", $ar[4]);
            $ar[4] = !empty($tel_arr[1])?$tel_arr[1]:'';
            
    //         $ar[4] = preg_replace("([\xa0-\xff]+/u)","",$ar[4]);
//         }else{
//             $email_arr = explode("：", $ar[4]);
//             $ar[4] = !empty($email_arr[1])?$email_arr[1]:'';
            
//             $tel_arr = explode("：", $ar[5]);
//             $ar[5] = !empty($tel_arr[1])?$tel_arr[1]:'';
            
//     //         $ar[5] = preg_replace("([\xa0-\xff]+/u)","",$ar[5]);
//         }
        
        
        
        
        echo join("\t", $ar)."\n";
        
    }
}
exit;



//
//$uri = 'http://i.cantonfair.org.cn/cn/SearchResult/Index?QueryType=2&KeyWord=&CategoryNo='.'417'.'&StageOne=0&StageTwo=0&StageThree=0&Export=0&Import=0&Provinces=&Countries=&ShowMode=1&NewProduct=0&CF=0&OwnProduct=0&PayMode=&NewCompany=0&BrandCompany=0&ForeignTradeCompany=0&ManufacturCompany=0&CFCompany=0&OtherCompany=0&OEM=0&ODM=0&OBM=0&OrderBy=1&producttab=1';
//
//$post = ['strData' => '{"Keyword":"","CategoryNo":"'.'417'.'","StageOne":"0","StageTwo":"0","StageThree":"0","Export":"0","Import":"0","NewProduct":"0","CF":"0","ISBRIGHTSPOT":"0","PageIndex":"'.'29'.'","PageSize":"'.'15'.'","Provinces":"","Countries":"","OrderBy":"1","Language":"1","NewExhibitor":"0","BrandsExhibitor":"0","ProduceExhibitor":"0","ForeignTradeExhibitor":"0","CFExhibitor":"0","OtherExhibitor":"0","OEMExhibitor":"0","ODMExhibitor":"0","OBMExhibitor":"0"}',
//    'interfaceSet' => 'ExhibitorListInProductNew', 'uri' => $uri];
//
////
//$list = requests::post("http://i.cantonfair.org.cn/DataTransfer/Do", $post);
//
//var_dump($list);exit;
$cookies = "_ga=GA1.1.599590831.1533624401; _gid=GA1.1.2050858451.1533624401; _ga=GA1.2.599590831.1533624401; _gid=GA1.2.2050858451.1533624401; PHPSESSID=n974jbd7rhcfko4jcef895med6; h3wl__s_uid=wqq_k18wx3f; h3wl__cityid=0; h3wl__cityname=; _gat=1";
requests::set_cookies($cookies, 'www.fzwjg.com');

$uri = 'https://www.fzwjg.com/m2/s/index.php?mod=information';

$post = ['action' => 'getContact','cityid'=>'0','cityname'=>'全国',
    'infoid'=>'301797',
    'press_type' => 'email'];

//
$list = requests::post($uri, $post);
var_dump($list);exit;





//
while (true){
    requests::set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36');
    $a = requests::get('https://www.baidu.com/baidu.php?url=060000aneiR_uXAKSpf-M1A3OpLB49zK_THoWHAzgehXCFhbZrVp3cQvPGGfFkczYoeDNNije_uvm-F93jnQznTpjJl9dv-PQH8MG_Q2XDKp8COj5ImI-Ka_z1ZZwoAoZjkqE_NBQZAtZmymqH7X0Qkpayvf_FhkS-olG3_ALMfwe--9V6.DY_a4Sp4Sp4hFa-muCyPdMHbz20.U1Y10ZDqVJhdGfKspynqn0KY5UojVJhdGTL30A-V5HczPfKM5yF-P100Iybqmh7GuZR0TA-b5Hnz0APGujYzrj00UgfqnH0krNtknjDLg1csPWFxn1msnfKopHYs0ZFY5H6snsK-pyfqnHfYn-tzPWbsrNtznHDkP-tznjbzrfKBpHYznjwxnHRd0AdW5HDsnj7xP1m3n1D1P1fkg1cvrjc4P101n1Kxn0KkTA-b5H00TyPGujYs0ZFMIA7M5H00mycqn7ts0ANzu1Ys0ZKs5H00UMus5H08nj0snj0snj00Ugws5H00uAwETjYk0ZFJ5H00uANv5gKW0AuY5H00TA6qn0KET1Ys0AFL5HDk0A4Y5H00TLCq0ZwdT1YvnjDdPW6zrHDYn1bzPWcdnWbz0ZF-TgfqnHR1n104nWDdnHnLn0K1pyfqmvf4PjD1rHbsnj0sPvPBmfKWTvYqnYD3rHuKnRFjwjnYnRDzf6K9m1Yk0ZK85H00TydY5H00Tyd15H00XMfqnfKVmdqhThqV5HKxn7tsg100uA78IyF-gLK_my4GuZnqn7tsg1Kxn0Ksmgwxuhk9u1Ys0AwWpyfqn0K-IA-b5iYk0A71TAPW5H00IgKGUhPW5H00Tydh5HDv0AuWIgfqn0KhXh6qn0Khmgfqn0KlTAkdT1Ys0A7buhk9u1Yk0Akhm1Ys0APzm1YdPHfvPs&ck=1688.38.9999.344.395.363.232.1007&shh=www.baidu.com&sht=baidu&ie=utf-8&f=8&tn=baidu&wd=订单&oq=%25E5%25A5%25BD%25E8%25AE%25A2%25E5%258D%2595&rqlang=cn&inputT=19578&bc=110101&us=2.12124606.2.0.14.14155.0.0');

    echo date('Y-m-d H:i:s')." success\n";
    sleep(2);
}

var_dump($a);exit;
$cookies = "ASP.NET_SessionId=5uhexae5e1mjua4dfintyaol; _ga=GA1.3.195482915.1526892229; _ctauu_469_1=%7B%22uuid%22%3A%22w3pdc80sz936b2uul37a%22%2C%22vsts%22%3A2%2C%22imps%22%3A%7B%7D%2C%22cvs%22%3A%7B%7D%7D; UnlockProducts_id=%7B%22IsSuccess%22%3Atrue%2C%22ErrorMSG%22%3Anull%2C%22ErrorCode%22%3Anull%2C%22ReturnData%22%3Anull%7D; CollectionList_id=%7B%22IsSuccess%22%3Atrue%2C%22ErrorMSG%22%3Anull%2C%22ErrorCode%22%3Anull%2C%22ReturnData%22%3A%7B%22CorpList%22%3Anull%2C%22ProductList%22%3Anull%7D%7D; safedog-flow-item=; _Preview=0800555747:8f2585771f4747cdb1f9b8e187cd72cf; __atuvc=19%7C21%2C0%7C22%2C7%7C23; __atuvs=5b1a1c0d25f439f9004; WT_FPC=id=208608aef7d248dd1721526892225112:lv=1528438188214:ss=1528437773127";
requests::set_cookies($cookies, 'i.cantonfair.org.cn');

$uri = 'http://i.cantonfair.org.cn/cn/SearchResult/Index?QueryType=2&KeyWord=&CategoryNo=417&StageOne=0&StageTwo=0&StageThree=0&Export=0&Import=0&Provinces=&Countries=&ShowMode=1&NewProduct=0&CF=0&OwnProduct=0&PayMode=&NewCompany=0&BrandCompany=0&ForeignTradeCompany=0&ManufacturCompany=0&CFCompany=0&OtherCompany=0&OEM=0&ODM=0&OBM=0&OrderBy=1&producttab=1';

$post = ['strData' => '{"Keyword":"","CategoryNo":"417","StageOne":"0","StageTwo":"0","StageThree":"0","Export":"0","Import":"0","NewProduct":"0","CF":"0","ISBRIGHTSPOT":"0","PageIndex":"29","PageSize":"15","Provinces":"","Countries":"","OrderBy":"1","Language":"1","NewExhibitor":"0","BrandsExhibitor":"0","ProduceExhibitor":"0","ForeignTradeExhibitor":"0","CFExhibitor":"0","OtherExhibitor":"0","OEMExhibitor":"0","ODMExhibitor":"0","OBMExhibitor":"0"}',
    'interfaceSet' => 'ExhibitorListInProductNew', 'uri' => $uri];

//
$list = requests::post("http://i.cantonfair.org.cn/DataTransfer/Do", $post);
var_dump($list);exit;
//userName:jiatu2016
//password:jt123456
//validCode:
//ajaxLoginType:jsonp
//clientCode:tnc_mobile
//returnUrl:http://m.tnc.com.cn/member/personalCenter
//machineCode:654247
//otherParam:null
//errorMsg:
//_:1522136934759
//callback:success_jsonpCallback

//$data = '["\u516c\u53f8\u7535\u8bdd\uff1a"86-186-10892806"QQ\u53f7\u7801\uff1a"1171731702"\u5fae\u4fe1\u53f7\u7801\uff1a"\u90ae\u7bb1\uff1a"1171731702@qq.com"]';
////$data = '"1171731702@qq.com';
//
//$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
////preg_match($pattern, $data, $matches);
//preg_match_all($pattern,$data,$matches);
//
//if (!empty($matches)){
//    var_dump($data);
//    var_dump($matches);exit;
//}
//exit;
//
//$cookies = "safedog-flow-item=; _ga=GA1.3.195482915.1526892229; _gid=GA1.3.316460144.1526892229; _ctauu_469_1=%7B%22uuid%22%3A%22w3pdc80sz936b2uul37a%22%2C%22vsts%22%3A1%2C%22imps%22%3A%7B%7D%2C%22cvs%22%3A%7B%7D%7D; ASP.NET_SessionId=gcbpyppkjigdxluaahpfld3o; WT_FPC=id=208608aef7d248dd1721526892225112:lv=1526896105479:ss=1526892225112";
//$a= requests::set_cookies($cookies, 'www.cantonfair.org.cn');
//
////var_dump($a);
//
//requests::set_header("Referer", "http://i.cantonfair.org.cn/cn/Company/Index?corpid=1509621549&corptype=1&ad=");
//
//requests::set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36');
//$cookies = requests::get_cookies("i.cantonfair.org.cn");
////$cookies = requests::get_cookies("m.tnc.com.cn");
////
//
//$strData = [
//    "Keyword"=>"",
//    "CategoryNo"=>"417",
//    "StageOne"=>"0",
//    "StageTwo"=>"0",
//    "StageThree"=>"0",
//    "Export"=>"0",
//    "Import"=>"0",
//    "NewProduct"=>"0",
//    "CF"=>"0",
//    "ISBRIGHTSPOT"=>"0",
//    "PageIndex"=>"1","PageSize"=>"15",
//    "Provinces"=>"","Countries"=>"","OrderBy"=>"1","Language"=>"1",
//    "NewExhibitor"=>"0","BrandsExhibitor"=>"0","ProduceExhibitor"=>"0",
//    "ForeignTradeExhibitor"=>"0","CFExhibitor"=>"0","OtherExhibitor"=>"0",
//    "OEMExhibitor"=>"0","ODMExhibitor"=>"0","OBMExhibitor"=>"0"
//];
//
//$interfaceSet = 'ExhibitorListInProductNew';
//
$uri = 'http://i.cantonfair.org.cn/cn/SearchResult/Index?QueryType=2&KeyWord=&CategoryNo=417&StageOne=0&StageTwo=0&StageThree=0&Export=0&Import=0&Provinces=&Countries=&ShowMode=1&NewProduct=0&CF=0&OwnProduct=0&PayMode=&NewCompany=0&BrandCompany=0&ForeignTradeCompany=0&ManufacturCompany=0&CFCompany=0&OtherCompany=0&OEM=0&ODM=0&OBM=0&OrderBy=1&producttab=1';
//
//$post = ['strData'=>$strData,'interfaceSet'=>$interfaceSet,'uri'=>$uri];

//$post = ['strData'=>'{"Keyword":"","CategoryNo":"417","StageOne":"0","StageTwo":"0","StageThree":"0","Export":"0","Import":"0","NewProduct":"0","CF":"0","ISBRIGHTSPOT":"0","PageIndex":"1","PageSize":"15","Provinces":"","Countries":"","OrderBy":"1","Language":"1","NewExhibitor":"0","BrandsExhibitor":"0","ProduceExhibitor":"0","ForeignTradeExhibitor":"0","CFExhibitor":"0","OtherExhibitor":"0","OEMExhibitor":"0","ODMExhibitor":"0","OBMExhibitor":"0"}',
//    'interfaceSet'=>'ExhibitorListInProductNew','uri'=>$uri];

$uri = 'http://i.cantonfair.org.cn/cn/Company/Index?corpid=0762916645&corptype=1&ad=';
$post = ['strData'=>'{"ExhibitorID":"0762916645","IsCN":"1","IsAD":"","CorpType":"1"}',
    'interfaceSet'=>'ExhibitorDetail','uri'=>$uri];

//strData: {"CORPID":"0733507205","IsCN":"1"}
//interfaceSet: ExhibitorDetailNews
//uri: http://i.cantonfair.org.cn/cn/Company/Index?corpid=0733507205&corptype=1&ad=

$post = ['strData'=>'{"CORPID":"0733507205","IsCN":"1"}',
    'interfaceSet'=>'ExhibitorDetailNews','uri'=>'http://i.cantonfair.org.cn/cn/Company/Index?corpid=0733507205&corptype=1&ad='];

$cookies = "ASP.NET_SessionId=5uhexae5e1mjua4dfintyaol; _ga=GA1.3.195482915.1526892229; _ctauu_469_1=%7B%22uuid%22%3A%22w3pdc80sz936b2uul37a%22%2C%22vsts%22%3A2%2C%22imps%22%3A%7B%7D%2C%22cvs%22%3A%7B%7D%7D; UnlockProducts_id=%7B%22IsSuccess%22%3Atrue%2C%22ErrorMSG%22%3Anull%2C%22ErrorCode%22%3Anull%2C%22ReturnData%22%3Anull%7D; CollectionList_id=%7B%22IsSuccess%22%3Atrue%2C%22ErrorMSG%22%3Anull%2C%22ErrorCode%22%3Anull%2C%22ReturnData%22%3A%7B%22CorpList%22%3Anull%2C%22ProductList%22%3Anull%7D%7D; safedog-flow-item=; _Preview=0800555747:8f2585771f4747cdb1f9b8e187cd72cf; __atuvc=19%7C21%2C0%7C22%2C7%7C23; __atuvs=5b1a1c0d25f439f9004; WT_FPC=id=208608aef7d248dd1721526892225112:lv=1528438188214:ss=1528437773127";
requests::set_cookies($cookies, 'i.cantonfair.org.cn');
$post = ['strData'=>'{"ExhibitorID":"0733507205","IsCN":"1","IsAD":"","CorpType":"1"}',
    'interfaceSet'=>'ExhibitorDetail','uri'=>'1'];

//
$html = requests::post("http://i.cantonfair.org.cn/DataTransfer/Do",$post);

var_dump($html);exit;
//
//$post_1 = [
//    'strData'=>["CORPID"=>"1509621549","IsCN"=>"1"],
//
//    'interfaceSet'=>'ExhibitorDetailNews',//'ExhibitorDetail',
//    'uri'=>'http://i.cantonfair.org.cn/cn/Company/Index?corpid=1509621549&corptype=1&ad='
//];
//$html_1 = requests::post("http://i.cantonfair.org.cn/DataTransfer/Do",$post_1);

//strData: {"ExhibitorID":"1509621549","IsCN":"1","IsAD":"","CorpType":"1"}
//interfaceSet: ExhibitorDetail
//uri: http://i.cantonfair.org.cn/cn/Company/Index?corpid=1509621549&corptype=1&ad=


//$caption = selector::select($html, "//*[@id=\"Exhi_Telephone\"]");////div[contains(@class,'mobile')]//text()
//
//var_dump($cookies);


//
//$html_2 = requests::get("http://www.cantonfair.org.cn/cn/mycantonfair/collect.aspx");
////http://www.cantonfair.org.cn/cn/mycantonfair/collect.aspx
//var_dump($html_2);exit;




// 模拟登录
$cookies = "_ga=GA1.3.672621585.1522136189; _gid=GA1.3.1407591827.1522136189; SECURITY_TNC_MEMBER=NTIzNzZjMWQtZjEwNC00YzA5LWFkOGEtMjBmOGMxMTcwMWQ4; Hm_lvt_e82a92eb6606539ba3fcb86e4d841f73=1522136189; m_c_=654247; _ss_ck=dlg97l8sggerv1rbrsansl9hk1; __qfcday=472113212; __qfca=1599035627.1522136235.1522136235.1522136245.2; acw_tc=AQAAALIlkUEc5woAAjigfG/6n2AnmDqH; JSESSIONID=abc2kgAVKySYA8xZhzMjw; _de_fs=362e5a7c04e04ed29f5dc8badfbceeda; _de_us=f34d29066b688e496835daf5e1596ff8d16666b9; _gat=1; Hm_lpvt_e82a92eb6606539ba3fcb86e4d841f73=1522141330";
requests::set_cookies($cookies, 'sp00027791.tnc.com.cn');
//
//$cookies = requests::get_cookies("m.tnc.com.cn");
////print_r($cookies);  // 可以看到已经输出Cookie数组结构
//
//
$html = requests::get("http://sp00027791.tnc.com.cn/concat-top-img.html?compId=4470043");
//use thiagoalessio\TesseractOCR\TesseractOCR;
//# saving image locally
//#这个是网上的图片，我第一次看到下面这种用法。
//$imageUrl = 'https://files.gitter.im/thiagoalessio/tesseract-ocr-for-php/gFLb/deretan.png';
$imageTempName = '1.png';
file_put_contents($imageTempName, $html);
//echo $imageTempName;
# recognizing it
//$ocr = new TesseractOCR($imageTempName);
//echo 6;
//$ocr->psm(4);
//echo $ocr->run();


exit;

$page = 2017141;
echo  '类型'."\t".'工厂'."\t".'地址'."\t".'手机号'. "\n";
while ($page>1912183) {//

    $html = requests::get("http://www.textiledirectory.com.mm/");



    var_dump($html);exit;
    $caption = selector::select($html, "//div[contains(@class,'typeoption')]//table/caption");


    if(trim($caption)!='服装加工'){
        $page--;

        sleep(1);
        continue;
    }
    $type = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[1]/td");

    if(!empty($type) &&  in_array(trim($type),['找订单','找工厂'])){
        $name = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[3]/td");
        $address = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[5]/td");
        $moblie = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[6]/td");


        echo  trim($type)."\t".$name."\t".$address."\t".$moblie. "\n";
    }


    $page--;

    sleep(1);
}

exit;




