<?php


ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */






$cookies = "zg_did=%7B%22did%22%3A%20%221648871faad736-0e57d083e7f039-1373565-1fa400-1648871faae2ea%22%7D; UM_distinctid=1648872019c60-0091aca84c4627-1373565-1fa400-1648872019daea; _uab_collina=153129753074027596875546; PHPSESSID=qk7v2kuvete10jkk7vmnn7se67; acw_tc=9903eb4815361148920735095e832e89a86554611c187381e7b2cef1c7; CNZZDATA1254842228=1411075086-1535006185-%7C1536284500; hasShow=1; Hm_lvt_3456bee468c83cc63fb5147f119f1075=1535007977,1536114882,1536284971; _umdata=BA335E4DD2FD504FF45B5DF6EFCC05393D908631153C8E78B158589ECC61F90A3E3794AE7EF218ACCD43AD3E795C914CFFD6009B0AC3E56A6E525BD4431A2517; Hm_lpvt_3456bee468c83cc63fb5147f119f1075=1536287027; zg_de1d1a35bfa24ce29bbf2c7eb17e6c4f=%7B%22sid%22%3A%201536286840426%2C%22updated%22%3A%201536287036321%2C%22info%22%3A%201536114881812%2C%22superProperty%22%3A%20%22%7B%7D%22%2C%22platform%22%3A%20%22%7B%7D%22%2C%22utm%22%3A%20%22%7B%7D%22%2C%22referrerDomain%22%3A%20%22www.qichacha.com%22%2C%22cuid%22%3A%20%2270147588a4061f2cd5b0cc52db615170%22%7D";
requests::set_cookies($cookies, 'www.qichacha.com');
requests::set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36');

$referer = 'https://www.qichacha.com/search?key=%E6%9C%8D%E8%A3%85%E8%BF%9B%E5%87%BA%E5%8F%A3';
requests::set_referer($referer);
 header("Content-Type: text/html;charset=utf-8");
$page = 1;
while (true){
    $uri = "https://www.qichacha.com/search_index?key=%25E6%259C%258D%25E8%25A3%2585%25E8%25BF%259B%25E5%2587%25BA%25E5%258F%25A3&ajaxflag=1&statusCode=10&province=SD&p={$page}&";
    $list = requests::get($uri);
    
//     $list = requests::get_encoding($list);;
//     var_dump($list);exit;
    $caption = selector::select($list, '//*[@id="searchlist"]/table/tbody');
    
    if (empty($caption)||$page>248){
        exit();
    }
    $data = selector::select($caption, "tr", "css");
    deal($data);
    $page++;
    sleep(rand(5,15));
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


