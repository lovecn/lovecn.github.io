#coding=utf-8
import requests,re
                       
# s = requests.session()
# login_data = {'email': 'xx@sina.com', 'password': 'xx', }

# # post 数据 http://www.zhihu.com/question/22640566
# s.post('http://www.zhihu.com/login', login_data)
                       
# # 验证是否登陆成功，抓取'知乎'首页看看内容
# # r = s.get('http://www.zhihu.com')
# r = s.get('http://www.zhihu.com/people/zihaolucky/followers')

# url = 'http://www.zhihu.com/node/ProfileFollowersListV2'

# # 请求的header部分.按照chrome的监控情况填写
# global header_info
# header_info = {
#     'User-Agent':'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1581.2 Safari/537.36',
#     'Host':'www.zhihu.com',
#     'Origin':'http://www.zhihu.com',
#     'Connection':'keep-alive',
#     'Referer':'http://www.zhihu.com/people/zihaolucky/followers',
#     'Content-Type':'application/x-www-form-urlencoded',
#     }
# # form data.
# data = r.text
# raw_hash_id = re.findall('hash_id(.*)',data)
# hash_id = raw_hash_id[0][14:46]
# raw_xsrf = re.findall('xsrf(.*)',r.text)
# _xsrf = raw_xsrf[0][9:-3]


# payload = {"method":"next","params":{"hash_id":hash_id,"order_by":"created","offset":20,},"_xsrf":_xsrf,}

# r = requests.post(url,data=payload,headers=header_info)
# print r.ok
# print r.text


# http://segmentfault.com/q/1010000003855057/a-1020000003855190

import time
from subprocess import Popen
import urllib, urllib2, random, time, cookielib, json
def zan(x):
    data = {'to_userid':'12:1479172953', 'mid':'734', 'from_id':str(int(time.time()))+str(random.randint(100,999))}
    hdr = {'Connection':'keep-alive', 'Content-Type':'application/x-www-form-urlencoded', 'Host':'xuanyan.xxx.com:8081', 'Origin':'http://xuanyan.xxx.com:8081', 'Referer':'http://xuanyan.xxx.com:8081/end.php?userid=12:1479172953&mid=734&from=timeline&isappinstalled=1', 'User-Agent':'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 'X-Requested-With':'XMLHttpRequest'}
    f = urllib2.Request(
            url     = 'http://xuanyan.xxx.com:8081/praise.php',
            data    = urllib.urlencode(data),
            headers = hdr, 
            )
    response = urllib2.urlopen(f)
    # print(response.read())
    sta = response.read()
    # print(sta)
    if sta[11] == '1':
        print('第'+str(x)+'次点赞')
    else:
        print('出现未知错误')
 
x = 0
while x < 300:
    x+=1
    # zan(x)
    # time.sleep(1)

headers ={
     'Accept':'*/*' ,
     'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8',
     'X-Requested-With':'XMLHttpRequest',
     'Referer':'http://www.zhihu.com',
     'Accept-Language':'zh-CN',
     'Accept-Encoding':'gzip, deflate',
     'User-Agent':'Mozilla/5.0(Windows NT 6.1;WOW64;Trident/7.0;rv:11.0)like Gecko',
     'Host':'www.zhihu.com'
     }

s =requests.session()
r = s.get('http://www.zhihu.com',headers =headers)
def getXSRF(r):
    cer = re.compile('name=\"_xsrf\" value=\"(.*)\"', flags = 0)
    strlist = cer.findall(r.text)
    return strlist[0]
_xsrf =getXSRF(r)

print(r.request.headers)
print(str(int(time.time()*1000)))
Captcha_URL= 'http://www.zhihu.com/captcha.gif?r='+ str(int(time.time()*1000))
r = s.get(Captcha_URL,headers =headers)
# print r.content
with open('code.gif','wb') as f:
    f.write(r.content)
Popen('code.gif',shell =True)
captcha =input('captcha: ')
login_data = {
    '_xsrf':_xsrf,
    'email':'xx@sina.com',
    'password': 'xx',
    'remember_me':'true',
    'captcha':captcha
}

r = s.post('http://www.zhihu.com/login/email',data=login_data,headers=headers)
print(r.text)
r = s.get('http://www.zhihu.com/settings/profile')
print(r.text)