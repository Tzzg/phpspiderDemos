<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */




//$page = 2017141;
//$page = 1974065;
$page = 1945277;

echo  'id'."\t".'类型'."\t".'工厂'."\t".'地址'."\t".'手机号'. "\n";
while ($page>1912183) {//

    $html = requests::get("http://www.eeff.net/forum.php?mod=viewthread&tid={$page}&extra=page%3D1%26filter%3Dsortid%26sortid%3D221");
    $caption = selector::select($html, "//div[contains(@class,'typeoption')]//table/caption");

    if(trim($caption)!='服装加工'){
        $page--;

        usleep(5000);
        continue;
    }
    $type = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[1]/td");

    if(!empty($type) &&  in_array(trim($type),['找订单','找工厂'])){
        $name = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[3]/td");
        $address = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[5]/td");
        $moblie = selector::select($html, "//div[contains(@class,'typeoption')]//table/tbody/tr[6]/td");


        echo  $page."\t".trim($type)."\t".$name."\t".$address."\t".$moblie. "\n";

    }


    $page--;

    sleep(1);
}

exit;




