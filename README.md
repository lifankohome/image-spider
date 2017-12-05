## Image-Spider
##### FBI-WARNING：坐稳扶好，别把方向盘搞丢

### Demo

The two spider get images from different website, and they don't have a equal performance.

#### Php-spider:

```
$auto = new Auto();
$url = 'https://www.hhh399.com/htm/girllist8/';
$auto->get($url, 20, ['1.htm','2.htm','3.htm','4.htm','5.htm','6.htm','7.htm','8.htm','9.htm','10.htm','11.htm']);
```

You can get about 30,000 images of pretty girl in one minute.（o-o）

##### parameter:

```
get(
    $url: website
    $num: how many pics in one webpage
    array: which web page do you want to spide
)
```

Image links would save in **$filePath**, which could be modified:

```
...
public function txtImg($str)
    {
        $filePath = "D://Xampp//htdocs//pyPic//log.txt";
...
```

Hope you enjoy this!

#### Python-spider：

```
$ python app.py
```
Images would storage in 'E://spiderBuff', and all urls of images would be written in 'imgLink.txt'.

You can get about 1139 image links in about 32.88s, if you want to save them at the same time, program will slow down severe according to image's size.

##### Disable image save:

Comment code below:

```
            filename = img_address_multi.split('/')[-1]
            save_path = 'E://spiderBuff//' + filename

            urllib.request.urlretrieve(img_address_multi, save_path)
            print(n, total, 'Saved')

            if len(filename) < 10:
                new_dir_name = "E://" + filename.split('.')[0]
                os.rename('E://spiderBuff', new_dir_name)
                print('重命名文件夹：', new_dir_name)
                os.mkdir('E://spiderBuff')
```

##### Feature:

Image could be sorted and save in different folder.

Hope you enjoy this!