<?php


ini_set("memory_limit", "10240M");
require_once __DIR__ . '/../autoloader.php';
use phpspider\core\phpspider;
use phpspider\core\requests;
use phpspider\core\selector;


//
while (true){
    requests::set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36');
    
    $url = "https://www.baidu.com/baidu.php?url=K000000fJeHuq9k18aFLvUUwhl1afhnTMbawozqik9anm4aOfcLtS_D-OxWvytRaZVOk6Ro-QTsdIpr4nZF25p0k_670o8AO1R1mJ17iIShPGebuDf00fcahRU60PH61wgBgajqLApLLVcnb5LKeixqKu0tawNgQdCWGGSyaUdQ5nkq8O0.Db_a4Sp4Sp4hFahGv-5QWdQjPakkzIMH8R0.U1Yk0ZDq8_rvJUy-1x60TA-W5H00IjvlsepGVpR0pyYqnW0Y0ATqTZPYT6KdpHdBmy-bIfKspyfqn1c0mv-b5Hc3n0KVIjYknjD4g1DsnHIxn1msnfKopHYs0ZFY5HDkn6K-pyfqnHfdrNtzPWbkn7tznH04PdtkrjRvn7tzPWbzn-tznjbzPsKBpHYznjwxnHRd0AdW5HDsnj7xP1TYP10Lnjn1g100TgKGujYs0Z7Wpyfqn0KzuLw9u1Ys0A7B5HKxn0K-ThTqn0KsTjYknjbYPj0vnjT10A4vTjYsQW0snj0snj0s0AdYTjYs0AwbUL0qnfKzpWYs0Aw-IWdsmsKhIjYs0ZKC5H00ULnqn0KBI1Ykn0K8IjYs0ZPl5fKYIgnqPW0kPHm3nWbkPjn4nWmzPHc4n6Kzug7Y5HDdn1Rsnjnzn1bLPWm0Tv-b5Hb3nAwbm1wBnj0snhuWnhm0mLPV5R7AfRn4fbnLwjK7n10kPHf0mynqnfKsUWYs0Z7VIjYs0Z7VT1Ys0ZGY5H00UyPxuMFEUHYsg1Kxn0Kbmy4dmhNxTAk9Uh-bT1Ysg1Kxn0Ksmgwxuhk9u1Ys0AwWpyfqn0K-IA-b5iYk0A71TAPW5H00IgKGUhPW5H00Tydh5HDv0AuWIgfqn0KhXh6qn0Khmgfqn0KlTAkdT1Ys0A7buhk9u1Yk0Akhm1Ys0APzm1Y1nj6kPs&ck=5532.8.167.268.146.444.146.703&shh=www.baidu.com&sht=baiduhome_pg&us=1.0.1.0.1.302.0&wd=%E5%A5%BD%E8%AE%A2%E5%8D%95%E7%BD%91&issp=1&f=3&ie=utf-8&rqlang=cn&tn=baiduhome_pg&oq=%25E5%25A5%25BD%25E8%25AE%25A2%25E5%258D%2595%25E7%25BD%2591&prefixsug=%25E5%25A5%25BD%25E8%25AE%25A2%25E5%258D%2595%25E7%25BD%2591&rsp=0";
    $a = requests::get($url);

    echo date('Y-m-d H:i:s')." success\n";
    sleep(2);
}

exit;