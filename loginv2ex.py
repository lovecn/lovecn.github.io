# encoding:utf-8
import urllib, urllib2, cookielib, re
 
# 账号相关参数http://iwww.me/395.html要使用登录页面的cookie进行登录
username = 'xx'
password = 'xx'
 
# cookie设置
cj = cookielib.CookieJar()
cookie_hanler = urllib2.HTTPCookieProcessor(cj)
 
# 获取once的值
lgurl = 'http://v2ex.com/signin'
req = urllib2.Request(url = lgurl)
opener = urllib2.build_opener(cookie_hanler)
urllib2.install_opener(opener)
contents = opener.open(req)
contents = contents.read()
 
# 根据正则表达式匹配once值
reg = r'value="(.*)" name="once"'
pattern = re.compile(reg)
result = pattern.findall(contents)
print result
# 登录参数设置
lgurl = 'http://v2ex.com/signin'
once = result[0]
data = {'u':username, 'p':password, 'once':once, 'next':'/'}
data = urllib.urlencode(data)
hdr = {'User-Agent':'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.94 Safari/537.36', 'Referer':'http://v2ex.com/signin', 'Host':'v2ex.com'}
req = urllib2.Request(url = lgurl, data = data, headers = hdr)
opener = urllib2.build_opener(cookie_hanler)
 
# 进行登录操作
response = opener.open(req)
page = response.read()
# print(page)
 
# 可以随便访问其他的链接
contents = urllib2.urlopen('http://v2ex.com/member/'+username)
contents = contents.read()
print(contents)