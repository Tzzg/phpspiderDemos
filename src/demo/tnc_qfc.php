<?php
ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */



$page = 22140;//22140
//13000
echo  '工厂名'."\t".'tel'. "\n";

$cookies = "_ga=GA1.3.672621585.1522136189; m_c_=654247; __qfca=1599035627.1522136235.1522656457.1522656489.6; _gid=GA1.3.1939972926.1527130211; Hm_lvt_e82a92eb6606539ba3fcb86e4d841f73=1527130212; _de_us=f34d29066b688e496835daf5e1596ff8d16666b9; JSESSIONID=abcWsfJpCmb27fQgEdqow; SECURITY_TNC_MEMBER=MWE2YjRjMTUtY2VlMy00NjQyLTk1MGEtMmFmNGUwZTkxMGMx; _gat=1; _de_fs=49ea7d7fc5504ba3bd0f5757c8cdb870; Hm_lpvt_e82a92eb6606539ba3fcb86e4d841f73=1527153033";
requests::set_cookies($cookies, 'fzjg.tnc.com.cn');



while ($page>=13000) {

    $html = requests::get("https://fzjg.tnc.com.cn/factory/detail-qfc-{$page}_card/contact.html");

    $name = selector::select($html, "/html/body/div[5]/div[2]/div[1]/ul/li[1]/h1");

    $tel = selector::select($html, "/html/body/div[5]/div[3]/div[2]/div/div[2]/div[2]/div/div[2]/p[1]/text()");


    $email = selector::select($html, "/html/body/div[13]/div/div[2]/div[1]/div[2]/div[2]/div[1]/div[2]/div[6]/text()");

    if (!empty($name)|| !empty($tel)){


        echo  $name."\t".$tel."\t".$email. "\n";


    }



    $page--;

    usleep(500);
}

exit;







