<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */



//$page = 166;  -- 118

//169 -- 166
$page = 169;
echo  '手机号'."\t".'QQ'. "\n";
while ($page>165) {

    $html = requests::get("http://bbs.fobshanghai.com/viewthread.php?tid=4774726&extra=&page={$page}");

    $data = selector::select($html, "div.t_msgfont", "css");


    foreach ($data as $val) {
        //var_dump($val);
        //echo preg_replace("/\D/s",' ',preg_replace('/\s+/', '', $val)). "\n";

        // 手机号的获取
       $reg= "/[^0-9+]*(?P(\+86[0-9]{11})|([0-9]{11})|([0-9]{3,4}-[0-9]{7,10}))[^0-9+]*/";
        preg_match_all($reg,$val,$result);

        $tem1 = array();
        if(!empty($result[0])){

            foreach ($result[0] as $value) {
                $tem1[] = $value;
            }
            echo implode('/',$tem1)."\t";
        }else{
            echo  ''."\t";
        }


        //qq号  [1-9]\\d{4,14}
        $reg='/[1-9]([0-9]{5,11})/';//匹配数字的正则表达式
        preg_match_all($reg,$val,$result1);
        $tem2 = array();
        if(!empty($result1[0])){

            foreach ($result1[0] as $value) {
                if (!in_array($value,$tem1)){
                    $tem2[] = $value;
                }
            }
            echo implode('/',$tem2)."\t";
        }else{
            echo  '';
        }

        echo "\n";
    }
    $page--;

    sleep(3);
}

exit;







