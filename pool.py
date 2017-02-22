# coding:utf-8

from PIL import Image, ImageDraw, ImageFont
import requests
from bs4 import BeautifulSoup
from multiprocessing import Pool
import re,json
from multiprocessing.dummy import Pool as TheaderPool
def test4():
    for n in range(100000):
        def test5(i):
            n += i
    tpool = TheaderPool(processes=1)
    tpool.map_async(test5,range(100000))
    tpool.close()
    tpool.join()
def test2():
    for n in range(100000):
        def test3(i):
            n += i
    pool = Pool(processes=1)
    pool.map_async(test3,range(100000))
    pool.close()
    pool.join()
#%time test2()
def test1():
    for n in range(10000):
        for i in range(100000):
            n += i
#%time test1()
url = 'http://sou.zhaopin.com/jobs/searchresult.ashx?jl=全国&kw=python&p=1&kt=3'
wbdata = requests.get(url).content
soup = BeautifulSoup(wbdata, 'lxml')

items = soup.select("div#newlist_list_content_table > table")
count = len(items) - 1
# 每页职位信息数量
print(count)

job_count = re.findall(r"共<em>(.*?)</em>个职位满足条件", str(soup))[0]
# 搜索结果页数https://zhuanlan.zhihu.com/p/24930071
pages = (int(job_count) // count) + 1
print(pages)

def get_zhaopin(page):
    url = 'http://sou.zhaopin.com/jobs/searchresult.ashx?jl=全国&kw=python&p={0}&kt=3'.format(page)
    print("第{0}页".format(page))
    wbdata = requests.get(url).content
    soup = BeautifulSoup(wbdata,'lxml')

    job_name = soup.select("table.newlist > tr > td.zwmc > div > a")
    salarys = soup.select("table.newlist > tr > td.zwyx")
    locations = soup.select("table.newlist > tr > td.gzdd")
    times = soup.select("table.newlist > tr > td.gxsj > span")

    for name, salary, location, time in zip(job_name, salarys, locations, times):
        data = {
            'name': name.get_text(),
            'salary': salary.get_text(),
            'location': location.get_text(),
            'time': time.get_text(),
        }
        open('pool.txt','w').write(json.dumps(data))
        print(data)
cookie='ALF=1490154058; SCF=AoKwul5O00KEo2zrTzddH04g9eej2EYHs1aUptaY7lvARGq6QBRUrXR85ixPrIh_xstIQYXykINEpysYvXLSxa4.; SUB=_2A251rtWODeTxGeVM71ER8ijOyDuIHXVXUPvGrDV6PUJbktBeLWfXkW1fa6IgGCZX-BuTKZLR7NptXkfOvg..; SUBP=0033WrSXqPxfM725Ws9jqgMF55529P9D9WhjAFlhwpdsQI9H22aSUog.5JpX5o2p5NHD95Q0eoB0ehzceoeNWs4Dqc_zi--NiKyWi-z4i--fi-2ciKnEi--4i-20iKy8i--Xi-zRiKn7i--ci-27i-zNi--NiKLWiKnXi--NiK.Xi-zNi--fi-82iK.7; SUHB=0z1QNLkUHIoxCb; SSOLoginState=1487578590'
def fetch_weibo():
    api = "http://m.weibo.cn/index/my?format=cards&page=%s"
    for i in range(1, 102):
        response = requests.get(url=api % i, headers={'cookie':cookie})
        data = response.json()[0]
        groups = data.get("card_group") or []
        for group in groups:
            text = group.get("mblog").get("text")
            text = text.encode("utf-8")

            def cleanring(content):
                """
                去掉无用字符https://github.com/lzjun567/crawler_html2pdf/blob/master/heart/heart.py
                """
                pattern = u"<a .*?/a>|<i .*?/i>|转发微博|//:|Repost|，|？|。|、|分享图片"
                content = re.sub(pattern, "", content)
                return content

            text = cleanring(text).strip()
            if text:
                yield text
if __name__ == '__main__':
	weibo=fetch_weibo()
	#
	for i in weibo:
		#open('weibo.txt','a+').write(i.decode('utf-8').encode('gbk','ignore'))
		print i.decode('utf-8').encode('gbk','ignore')
	#print list(weibo)
    #pool = Pool(processes=2)
    #pool.map_async(get_zhaopin,range(1,pages+1))
    #pool.close()
    #pool.join()
#img = Image.open('sf.jpg')
#draw = ImageDraw.Draw(img)
#myfont = ImageFont.truetype('C:/windows/fonts/Arial.ttf', size=80)
#fillcolor = "#ff0000"
#width, height = img.size
#draw.text((40,40),'hello', font=myfont, fill=fillcolor)
#img.save('result2.jpg','jpeg')

#curl "http://www.weibo.com/aj/mblog/fsearch?ajwvr=6&pre_page=1&page=1&end_id=1487580499809985&min_id=4076981517157151&wvr=5&pagebar=0&unread_max_id=1487580499809985&unread_since_id=1487580499809985&__rnd=1487580528288" -H "Cookie: SINAGLOBAL=6541965722572.059.1420758490619; UOR=www.liebao.cn,widget.weibo.com,baike.baidu.com; SSOLoginState=1487562058; SCF=AoKwul5O00KEo2zrTzddH04g9eej2EYHs1aUptaY7lvArBiWBYj4lTlRHm-4N8CSbL1e2HNtMOWyqx7VD-Czck0.; SUB=_2A251rtWNDeTxGeVM71ER8ijOyDuIHXVW2kBFrDV8PUJbmtANLUKgkW-eBYXYYPPum6Stdc61Oe22OudUZQ..; SUBP=0033WrSXqPxfM725Ws9jqgMF55529P9D9WhjAFlhwpdsQI9H22aSUog.5JpX5o2p5NHD95Q0eoB0ehzceoeNWs4Dqc_zi--NiKyWi-z4i--fi-2ciKnEi--4i-20iKy8i--Xi-zRiKn7i--ci-27i-zNi--NiKLWiKnXi--NiK.Xi-zNi--fi-82iK.7; SUHB=0M2V9vwveCVAYB; ALF=1519098058; YF-Ugrow-G0=b02489d329584fca03ad6347fc915997; wvr=6; YF-V5-G0=e6f12d86f222067e0079d729f0a701bc; wb_g_upvideo_3243026237=1; YF-Page-G0=ee5462a7ca7a278058fd1807a910bc74; _s_tentry=-; Apache=1939166353391.4683.1487580413799; ULV=1487580413806:27:4:1:1939166353391.4683.1487580413799:1487216186848" -H "Accept-Encoding: gzip, deflate, sdch" -H "Accept-Language: zh-CN,zh;q=0.8" -H "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.75 Safari/537.36" -H "Content-Type: application/x-www-form-urlencoded" -H "Accept: */*" -H "Referer: http://www.weibo.com/u/3243026237/home?wvr=5" -H "X-Requested-With: XMLHttpRequest" -H "Connection: keep-alive" --compressed