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




