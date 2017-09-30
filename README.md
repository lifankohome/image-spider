# php-spider
开车了，抓稳看好，别把方向盘搞丢。

## FBI-WARNING：未满18岁请止步！！！
### 不过，未满18能看懂这个应该对那个也不会太感兴趣~

使用方法：找到自己喜欢的分类，复制链接，输入到url中

示例：

1　　$auto = new Auto();

2　　$url = 'https://www.hhh399.com/htm/girllist8/';

3　　$auto->get($url, 20, ['1.htm','2.htm','3.htm','4.htm','5.htm','6.htm','7.htm','8.htm','9.htm','10.htm','11.htm']);

4　　//$auto->get($url, 14, ['12.htm']);

get()参数：

　　[链接]   [人物数量（最多是20个，每个分类里的最后一页可能不到20个，第4行可以用来获取最后一页）]    [页面名称]


　　代码执行时间视图片数量不同，如果你的网络较差，可能执行时间会超过配置文件的最大执行时间，So you should edit [php.ini] to ensure that the program can work well if you have a bad Internet Connection，我这边网络较好，爬了大概30k链接都未出现异常。

　　By the way: The links of images would storage in [$filePath], which could be modified.

It's unbelievable, I just click the link, the domain should jump to hhh397.com, maybe the domain is different between day and night, I don't know. But nothing serious, you can make it!
