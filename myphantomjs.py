#encoding=utf-8
from selenium import webdriver
#from envelopes import Envelope  
# import envelopes
import smtplib
from email.header import Header
from email.mime.text import MIMEText
import time
from bs4 import BeautifulSoup
from splinter import Browser
from threading import Thread
from Queue import Queue
from time import sleep
#Selenium+PhantomJS+Xpath抓取网页JS内容
#browser = webdriver.PhantomJS('phantomjs.exe')
url = 'http://www.aizhan.com/siteall/tuniu.com/'
#browser.get(url)
#table = browser.find_elements_by_xpath('//*[@id="history1"]/table/tbody/tr')  # 用Xpath获取table元素
#http://www.zhidaow.com/post/selenium-phantomjs-xpath

#for t in table:
    #print t.text

# q是任务队列http://python.jobbole.com/84622/
#NUM是并发线程总数
#JOBS是有多少任务
q = Queue()
NUM = 2
JOBS = 10
#具体的处理函数，负责处理单个任务
def do_somthing_using(arguments):
    print arguments
#这个是工作进程，负责不断从队列取数据并处理
def working():
    while True:
        arguments = q.get()
        do_somthing_using(arguments)
        sleep(1)
        q.task_done()
#fork NUM个线程等待队列
for i in range(NUM):
    t = Thread(target=working)
    t.setDaemon(True)
    t.start()
#把JOBS排入队列
for i in range(JOBS):
    q.put(i)
#等待所有JOBS完成
q.join()
#browser.quit()
#https://segmentfault.com/q/1010000007687981 
#driver = Browser(driver_name='chrome')
driver = webdriver.Chrome()
driver.maximize_window()
driver.set_page_load_timeout(10)

try:
    driver.get("http://music.163.com/#/song?id=31877470")
except selenium.common.exceptions.TimeoutException:
    print("time out of 10 s")
    driver.execute_script('window.stop()')

print(u"休眠结束")
driver.switch_to.frame("contentFrame")
time.sleep(5)
#s.decode(‘gbk’, ‘ignore’).encode(‘utf-8′) 
#Win7中的cmd，默认codepage是CP936，即GBK的编码，所以需要先将上述的Unicode的titleUni先编码为GBK，
#然后再在cmd中显示出来，然后由于titleUni中包含一些GBK中无法显示的字符，
#导致此时提示“’gbk’ codec can’t encode”的错误的
"""
对于此（类）问题：UnicodeEncodeError: 'gbk' codec can't encode character
www.crifan.com/unicodeencodeerror_gbk_codec_can_not_encode_character_in_position_illegal_multibyte_sequence/+&cd=1&hl=zh-CN&ct=clnk&gl=jp
(1)出现UnicodeEncodeError –> 说明是Unicode编码时候的问题；

(2) ‘gbk’ codec can’t encode character –> 说明是将Unicode字符编码为GBK时候出现的问题；

此时，往往最大的可能就是，本身Unicode类型的字符中，包含了一些无法转换为GBK编码的一些字符。

解决办法是：

方案1：
在对unicode字符编码时，添加ignore参数，忽略无法无法编码的字符，这样就可以正常编码为GBK了。

对应代码为：

gbkTypeStr = unicodeTypeStr.encode('gbk', 'ignore');
方案2：
或者，将其转换为GBK编码的超集GB18030 （即，GBK是GB18030的子集）：

gb18030TypeStr = unicodeTypeStr.encode(“GB18030“);
对应的得到的字符是GB18030的编码。

【题外话】

对于上述中，将原先的utf-8的字符转换为Unicode的时候，其实更加安全的做法，也可以将：

titleUni = titleHtml.decode(“UTF-8”);

替换为：

titleUni = titleHtml.decode(“UTF-8”, ‘ignore’);

这样可以实现，即使对于那些，相对来说是无关紧要的一些特殊字符，也可以成功编码，避免编码出错，提高程序的健壮性
https://segmentfault.com/q/1010000000386165
>>> '组图：震前汶川风光\ue40c震前汶川风光\u3000ＱＱ群４９１４６６７．作者肚螂皮'.encode('gbk')
Traceback (most recent call last):
  File "<stdin>", line 1, in <module>
UnicodeEncodeError: 'gbk' codec can't encode character '\ue40c' in position 9: illegal multibyte sequence
>>> '组图：震前汶川风光\ue40c震前汶川风光\u3000ＱＱ群４９１４６６７．作者肚螂皮'.encode('gb18030')
b'\xd7\xe9\xcd\xbc\xa3\xba\xd5\xf0\xc7\xb0\xe3\xeb\xb4\xa8\xb7\xe7\xb9\xe2\xfd\xa3\xd5\xf0\xc7\xb0\xe3\xeb\xb4\xa8\xb7\xe7\xb9\xe2\xa1\xa1\xa3\xd1\xa3\xd1\xc8\xba\xa3\xb4\xa3\xb9\xa3\xb1\xa3\xb4\xa3\xb6\xa3\xb6\xa3\xb7\xa3\xae\xd7\xf7\xd5\xdf\xb6\xc7\xf2\xeb\xc6\xa4'


>>> '组图：震前汶川风光\ue40c震前汶川风光\u3000ＱＱ群４９１４６６７．作者肚螂皮'.encode('gbk', errors='replace').decode('gbk')
'组图：震前汶川风光?震前汶川风光\u3000ＱＱ群４９１４６６７．作者肚螂皮'
这年代了还用urllib2呀。 用requests吧，结果自动解码成unicode 
>>> import requests 
>>> r = requests.get('http://www.baidu.com') 
>>> r.text 
.... 
>>> type(r.text) 
<type 'unicode'>

BF也过时了，用pyquery吧。 

>>> from pyquery import PyQuery as pq 
>>> html = pq(r.text) 
>>> print html('title').text() 
百度一下，你就知道
这个和控制台的编码(默认是GBK)有关吧, 在IDLE中运行没有问题

http://www.jianshu.com/p/e1f8b690b951
"""

print(driver.find_element_by_id('comment-box').text.encode('GBK', 'ignore'))
bsObj = BeautifulSoup(driver.page_source)
source = driver.page_source.encode('GBK', 'ignore')
#open('wangyi.txt','w').write(source)
#print(driver.page_source.encode('GBK', 'ignore'))
#设置好客户端密码，再用客户端密码登录https://my.oschina.net/jhao104/blog/613774

#server = smtplib.SMTP('smtp.163.com', 25)
#server.login('j_hao104@163.com', 'clientPassword')
#msg = MIMEText('hello, send by Python...', 'plain', 'utf-8')
#msg['From'] = 'j_hao104@163.com <j_hao104@163.com>'
#msg['Subject'] = Header(u'text', 'utf8').encode()
#msg['To'] = u'飞轮海 <jinghao5849312@qq.com>'
#server.sendmail('j_hao104@163.com', ['946150454@qq.com'], msg.as_string())
"""
envelope = Envelope(  # 实例化Envelope
    from_addr=(u'from@example.com', u'From Example'),  # 必选参数，发件人信息。前面是发送邮箱，后面是发送人；只有发送邮箱也可以
    to_addr=(u'to@example.com', u'To Example'),  # 必选参数，发送多人可以直接(u'user1@example.com'， u'user2@example.com')
    subject=u'Envelopes demo',  # 必选参数，邮件标题
    html_body=u'<h1>活着之上</h1><h2>作者：阎真</h2>',  # 可选参数，带HTML的邮件正文
    text_body=u"I'm a helicopter!",    # 可选参数，文本格式的邮件正文
    cc_addr=u'boss1@example.com',  # 可选参数，抄送人，也可以是列表形式
    bcc_addr=u'boss2@example.com',  # 可选参数，隐藏抄送人，也可以是列表
    headers=u'',  # 可选参数，邮件头部内容，字典形式
    charset=u'',  # 可选参数，邮件字符集
)"""
# envelope.add_attachment('/Users/bilbo/Pictures/helicopter.jpg')  # 增加附件，注意文件是完整路径，也可以加入多个附件
#测试代码回滚https://www.w3ctrain.com/2016/06/26/learn-git-in-30-minutes/
# Send the envelope using an ad-hoc connection...
#envelope.send('smtp.163.com', login='from@example.com',password='password', tls=True)  # 发送邮件，分别是smtp服务器，登陆邮箱，登陆密码，tls设置
# http://hlsvod01.t.vhall.com/api/hls_record?record_id=59549&webinarID=117385303&StartTime=2017-02-09+15%3A50%3A13&StopTime=2017-02-09+15%3A50%3A46


