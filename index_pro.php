<?php
/**
 * Created by PhpStorm.
 * User: lifanko lee
 * Date: 2017/8/3
 * Time: 14:29
 */
class Auto
{
    public function get_all_url($url, $length)
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

    public function get_all_img($url)
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

    public function txtImg($str)
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

    public function get($url, $length, $arr)
    {
        $num = 0;
        foreach ($arr as $value) {
            $allLinks = $this->get_all_url($url . $value, $length);
            foreach ($allLinks as $row) {
                $allImg = $this->get_all_img($row);
                $buff = "";
                foreach ($allImg as $item) {
                    $buff .= $item . "\n";
                    $num++;
                }
                $this->txtImg($buff);
            }
        }

        echo "完毕！共" . $num;
    }
}

$auto = new Auto();
$url = 'https://www.hhh399.com/htm/girllist2/';
//$auto->get($url, 20, ['1.htm','2.htm','3.htm','4.htm','5.htm','6.htm','7.htm','8.htm','9.htm','10.htm','11.htm']);
$auto->get($url, 14, ['12.htm']);