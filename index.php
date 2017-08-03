<?php
/**
 * Created by PhpStorm.
 * User: lifanko  lee
 * Date: 2017/8/3
 * Time: 14:29
 */

$url = 'https://www.hhh399.com/htm/girllist8/9.htm';

function curl($url)
{
    $ch = curl_init($url);//初始化会话

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
    $result = curl_exec($ch);//抓取的结果

    return $result;
}

function get_all_url($url, $length)
{
    $links = array();
    $html = file_get_contents($url);

    $dom = new DOMDocument();
    @$dom->loadHTML($html);

    $xpath = new DOMXPath($dom);
    $hrefAll = $xpath->evaluate("/html/body//a");

//    for ($i = 0; $i < $hrefAll->length; $i++) {
    for ($i = 0; $i < $length; $i++) {
        $href = $hrefAll->item($i);
        $url = $href->getAttribute('href');
        array_push($links, "https://www.hhh399.com" . $url);
    }
    return $links;
}

$allLinks = get_all_url($url, 12);

//print_r($allLinks);

function get_detail($url)
{
    $links = array();
    $html = file_get_contents($url);

    $dom = new DOMDocument();
    @$dom->loadHTML($html);

    $xpath = new DOMXPath($dom);
    $hrefAll = $xpath->evaluate("/html/body//img");

    for ($i = 0; $i < $hrefAll->length; $i++) {
        $href = $hrefAll->item($i);
        $url = $href->getAttribute('src');
        array_push($links, $url);
    }
    return $links;
}

function txtImg($str)
{
    $filePath = "D://Xampp//htdocs//pyPic//log.txt";
    if (file_exists($filePath)) {
        $fp = fopen($filePath, "a");
        flock($fp, LOCK_EX);
        fwrite($fp, $str);
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}

$num = 0;
foreach ($allLinks as $row) {
    $allImg = get_detail($row);
    $buff = "";
    foreach($allImg as $item){
        $buff .= $item."\n";
        $num++;
    }
    txtImg($buff);
}
echo "<p>完毕! $num 张</p>";
