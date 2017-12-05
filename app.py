import os
import requests
import random
import time
import socket
import http.client
from lxml import etree
import urllib.request


def getContent(url):
    global res
    header = {}
    timeout = random.choice(range(80, 180))
    while True:
        try:
            res = requests.get(url, headers=header, timeout=timeout)
            res.encoding = 'utf-8'
            break
        except socket.timeout as e:
            print('3:', e)
            time.sleep(random.choice(range(8, 15)))

        except socket.error as e:
            print('4:', e)
            time.sleep(random.choice(range(20, 60)))

        except http.client.BadStatusLine as e:
            print('5:', e)
            time.sleep(random.choice(range(30, 80)))

        except http.client.IncompleteRead as e:
            print('6:', e)
            time.sleep(random.choice(range(5, 15)))

    return res.text
    # return html_text


def getKind(dom):
    elements = etree.HTML(dom)

    result = elements.xpath('//*[@class="post-home"]')

    file = open('hhh.txt', 'w')

    n = 0
    total = 0
    for val in result:
        img_page = val.xpath('div[1]/a/@href')[0]

        n += 1
        print(n, ": " + img_page)

        img_dom = getContent(img_page)
        img_elements = etree.HTML(img_dom)
        img_address = img_elements.xpath('//*[@id="gallery-1"]/dl')

        if n < 6:
            print('跳过页面，序号：', n)
            continue

        for dls in img_address:
            img_address_multi = dls.xpath('dt/a/@href')[0]
            # 写入文件
            file.write(img_address_multi + '\n')
            total += 1

            filename = img_address_multi.split('/')[-1]
            save_path = 'E://spiderBuff//' + filename

            urllib.request.urlretrieve(img_address_multi, save_path)
            print(n, total, 'Saved')

            if len(filename) < 10:
                new_dir_name = "E://" + filename.split('.')[0]
                os.rename('E://spiderBuff', new_dir_name)
                print('重命名文件夹：', new_dir_name)
                os.mkdir('E://spiderBuff')

    print('完成，共爬取', total, '张图片')


if __name__ == '__main__':
    start = time.clock()

    url = 'http://www.mmxyz.net/category/rosi/'
    html = getContent(url)

    if os.path.isdir('E://spiderBuff'):
        print('buffer文件夹已存在')
    else:
        os.mkdir('E://spiderBuff')
        print('创建buffer文件夹')

    getKind(html)

    elapsed = (time.clock() - start)
    print('用时：', round(elapsed, 2), 's')
