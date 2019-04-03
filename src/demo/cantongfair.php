<?php
// composer下载方式
// 先使用composer命令下载：
// composer require owner888/phpspider
// 引入加载器
//require './vendor/autoload.php';

// GitHub下载方式
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\util;
use phpspider\core\requests;
use phpspider\core\selector;

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$cookies = "ASP.NET_SessionId=5uhexae5e1mjua4dfintyaol; _ga=GA1.3.195482915.1526892229; _ctauu_469_1=%7B%22uuid%22%3A%22w3pdc80sz936b2uul37a%22%2C%22vsts%22%3A2%2C%22imps%22%3A%7B%7D%2C%22cvs%22%3A%7B%7D%7D; UnlockProducts_id=%7B%22IsSuccess%22%3Atrue%2C%22ErrorMSG%22%3Anull%2C%22ErrorCode%22%3Anull%2C%22ReturnData%22%3Anull%7D; CollectionList_id=%7B%22IsSuccess%22%3Atrue%2C%22ErrorMSG%22%3Anull%2C%22ErrorCode%22%3Anull%2C%22ReturnData%22%3A%7B%22CorpList%22%3Anull%2C%22ProductList%22%3Anull%7D%7D; __atuvc=19%7C21%2C0%7C22%2C10%7C23; safedog-flow-item=; _Preview=0800555747:91ecee59ca5c4c83a17572e3b07d4dd7; WT_FPC=id=208608aef7d248dd1721526892225112:lv=1528679726709:ss=1528679697252";
requests::set_cookies($cookies, 'i.cantonfair.org.cn');

$page_size = 15;

$type_arr = [
    ['id'=>'417','name'=>'男女装','total_page'=>78],
    ['id'=>'418','name'=>'童装','total_page'=>13],
    ['id'=>'419','name'=>'内衣','total_page'=>17],
    ['id'=>'420','name'=>'运动服及休闲服','total_page'=>22],
    ['id'=>'421','name'=>'革皮羽绒及制品','total_page'=>5],
    ['id'=>'422','name'=>'服装饰物及配件','total_page'=>37],
    ['id'=>'423','name'=>'家用纺织品','total_page'=>96],
    ['id'=>'424','name'=>'纺织原料面料','total_page'=>47],
    ['id'=>'425','name'=>'地毯及挂毯','total_page'=>10],
];

foreach ($type_arr as $type) {
    //分页循环
    for ($page_index = 1;$page_index<=$type['total_page'];$page_index++){
        $uri = 'http://i.cantonfair.org.cn/cn/SearchResult/Index?QueryType=2&KeyWord=&CategoryNo='.$type['id'].'&StageOne=0&StageTwo=0&StageThree=0&Export=0&Import=0&Provinces=&Countries=&ShowMode=1&NewProduct=0&CF=0&OwnProduct=0&PayMode=&NewCompany=0&BrandCompany=0&ForeignTradeCompany=0&ManufacturCompany=0&CFCompany=0&OtherCompany=0&OEM=0&ODM=0&OBM=0&OrderBy=1&producttab=1';

        $post = ['strData' => '{"Keyword":"","CategoryNo":"'.$type['id'].'","StageOne":"0","StageTwo":"0","StageThree":"0","Export":"0","Import":"0","NewProduct":"0","CF":"0","ISBRIGHTSPOT":"0","PageIndex":"'.$page_index.'","PageSize":"'.$page_size.'","Provinces":"","Countries":"","OrderBy":"1","Language":"1","NewExhibitor":"0","BrandsExhibitor":"0","ProduceExhibitor":"0","ForeignTradeExhibitor":"0","CFExhibitor":"0","OtherExhibitor":"0","OEMExhibitor":"0","ODMExhibitor":"0","OBMExhibitor":"0"}',
            'interfaceSet' => 'ExhibitorListInProductNew', 'uri' => $uri];

//
        $list = requests::post("http://i.cantonfair.org.cn/DataTransfer/Do", $post);


        if (empty($list)) {
            continue;
        }

        //echo $type['id'].'---'.$page_index."\n";continue;
        $list = json_decode($list, true);

        if (!empty($list['ErrorCode'])) {
            continue;
        }
        $c_list = $list['ReturnData']['ProductLists'];

        if (!empty($c_list)) {
            foreach ($c_list as $c) {

                $uri = "http://i.cantonfair.org.cn/cn/Company/Index?corpid={$c['ExhibitorID']}&corptype={$c['CorpType']}&ad=#";
                $c_post = [
                    'strData' => '{"ExhibitorID":"' . $c['ExhibitorID'] . '","IsCN":"1","IsAD":"","CorpType":"' . $c['CorpType'] . '"}',
                    'interfaceSet' => 'ExhibitorDetail',
                    'uri' => $uri];
                $c_info = requests::post("http://i.cantonfair.org.cn/DataTransfer/Do", $c_post);

                if (!empty($c_info)) {
                    $c_info = json_decode($c_info, true);
//            var_dump($c_info);exit;
                    if (!empty($c_info['ErrorCode'])) {
                        continue;
                    } else {
                        $c = $c_info['ReturnData'];
        //              var_dump($c);exit;
                        echo
                            $type['id'] . "\t".
                            $page_index . "\t".
                            $type['name'] . "\t" .
                            (isset($c['ExhibitorName']) ? $c['ExhibitorName'] : '') . "\t" .
                            (isset($c['Linkman']) ? $c['Linkman'] : '') . "\t" .
                            (isset($c['Address']) ? $c['Address'] : '') . "\t" .
                            (isset($c['WebSite']) ? $c['WebSite'] : '') . "\t" .
                            (isset($c['Telephone']) ? $c['Telephone'] : '') . "\t" .
                            (isset($c['Email']) ? $c['Email'] : '') . "\n";

                    }
                }
                usleep(500);
            }
        }
        usleep(500);
    }
    sleep(2);

}




