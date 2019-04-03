<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */


//http://www.eeff.net/forum.php?mod=viewthread&tid=2008378&extra=page%3D65%26filter%3Dsortid%26sortid%3D225
//http://www.eeff.net/forum.php?mod=viewthread&tid=2040215&extra=page%3D1%26filter%3Dsortid%26sortid%3D225


//$page = 2040215;


$page = 1916676;//2008378;
echo  'id'."\t".'类型'."\t".'发布时间'."\t".'工厂'."\t".'地址'."\t".'手机号'."\t".'电话'. "\n";
while ($page>1882737) {//

    $html = requests::get("http://www.eeff.net/forum.php?mod=viewthread&tid={$page}&extra=page%3D1%26filter%3Dsortid%26sortid%3D221");
    $caption = selector::select($html, "//div[contains(@class,'typeoption')]//table/caption");

    if(trim($caption)!='供应求购'){
        $page--;

        usleep(5000);
        continue;
    }
    $type = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[1]/td");

    $time = selector::select($html, "//div[contains(@class,'authi')][1]//em");

    if (is_array($time)){
        $time = $time[0];
    }
    $isMatched = preg_match('/\d{4}(\-|\/|.)\d{1,2}\1\d{1,2}/', $time, $matches);
    if ($isMatched){
        $time_str = $matches[0];
    }else{
        $time_str = '';
    }
    if(!empty($type) &&  in_array(trim($type),['供应'])){
        $name = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[3]/td");
        $address = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[5]/td");
        $moblie = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[6]/td");
        $tel = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[7]/td");


        echo  $page."\t".trim($type)."\t".$time_str."\t".$name."\t".$address."\t".$moblie."\t".$tel. "\n";

    }


    $page--;

    sleep(1);
}

exit;




