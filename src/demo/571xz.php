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
$page = 46152;
// echo  '手机号'."\t".'QQ'. "\n";
while ($page>165) {

    $html = requests::get("http://hz.571xz.com/shop.htm?id={$page}");

    $normol = 3;
    $name = selector::select($html, "/html/body/div[{$normol}]/div/div[3]/div[2]/h3");
    ///html/body/div[2]/div/div[3]/div[2]/h3

    if (empty($name)){
        
        
        $normol = 2;
        $name = selector::select($html, "/html/body/div[{$normol}]/div/div[3]/div[2]/h3");
        if (empty($name)){
            echo '/* page '.$page.'  no name */'."\n";
            $page--;
            continue;
        }
    }

    $add = selector::select($html, "/html/body/div[{$normol}]/div/div[3]/div[4]/div[1]/ul[1]/li[1]/text()");
    $tel = selector::select($html, "/html/body/div[{$normol}]/div/div[3]/div[4]/div[1]/ul[1]/li[2]/text()");
    $main = selector::select($html, "/html/body/div[{$normol}]/div/div[3]/div[4]/div[1]/ul[1]/li[3]/text()");
    
    
    if ($normol==3){//正常
        $reg='/(13|14|15|17|18|19)[0-9]{9,12}/';//匹配数字的正则表达式
        preg_match_all($reg,$html,$result);
        
        
        $tem = [];
        if (!empty($result[0])){
            foreach ($result[0] as $val){
                if (strlen($val)==11){
                    $tem[] = $val;
                }
            }
        }
        $content = join(',',$tem);
    }else{
        $content = '该店已关闭';
    }
    
    
   
    
   
    
    echo 'Insert Ignore Into `571xz` (`id`,`name`,`address`,`tel`,`main`,`content`) Values ("'.$page.'","'.$name.'","'.$add.'","'.$tel.'","'.$main.'","'.$content.'");'."\n";
        
    
    
    $page--;

    usleep(200);
}

exit;







