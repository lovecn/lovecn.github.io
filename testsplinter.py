#coding=utf-8
import time
from splinter import Browser
from selenium import webdriver
import urllib2
import random
import requests
import re
import random
import time
#driver = webdriver.Chrome()
#driver.get('http://t.vhall.com')

#print driver.title
#获取当前所有窗口handle列表，这个文档里面有

#列表里面的窗口按打开顺序排列
#browser = Browser(driver_name='chrome')
#allwindows = browser.windows

                  

#切换到刚开的窗口

#browser.driver.switch_to_window(allwindows[-1])

#关闭当前窗口

#browser.driver.close()
#driver.quit()
#http://blog.csdn.net/lanbing510/article/details/8489715
#driver = webdriver.Chrome("C:/Users/michael/Downloads/chromedriver_win32/chromedriver.exe")
def splinter(url):
    browser = Browser(driver_name='chrome')
    #url = "https://kyfw.12306.cn/otn/leftTicket/init"#https://zhuanlan.zhihu.com/p/20559891
    #login 126 email websize
    browser.visit(url)
    #wait web element loading
    time.sleep(5)
    #fill in account and password
    browser.find_by_id('username').fill('lsp')
    browser.find_by_id('pwd').fill('123456789')
    #click the button of login
    browser.find_by_id('to-login').click()
    time.sleep(8)
    #close the window of brower
    #browser.quit()
def login12306():
    b = Browser(driver_name="chrome")
    url = "https://kyfw.12306.cn/otn/leftTicket/init"
    b.visit(url)
    raw_input("请直接在页面输入目的地信息和出发时间，点击查询后，按任意键继续: ")
    b.cookies.add({"_jc_save_fromDate":"2016-02-09"})
    b.cookies.add({"_jc_save_fromStation":"%u5317%u4EAC%2CBJP"})
    b.cookies.add({"_jc_save_toStation":"%u4E0A%u6D77%2CSHH"})
    b.reload()
    while(b.is_element_not_present_by_text(u"预订")):
        b.find_by_text(u"查询").click()
        time.sleep(3)
    b.find_by_text(u"预订")[0].click()
    exit();
def getLrc():
    
    print(u"獲取歌詞中。。。")
    ranNumA = str(random.randrange(9,100))
    ranNumB = str(random.randrange(1000))
    url = "http://music.qq.com/miniportal/static/lyric/"+ ranNumA +"/"+ranNumB+ranNumA+".xml"#這個是歌詞api
    print(url)
   
    res = requests.get(url)
 
    if res.status_code != 200:
        getLrc()
    html = res.content
    # print(type(html))
    try:
        html = html.decode('gbk')
    except:
        pass
   
 
    return html
def login (browser,url,q,p):
    browser.visit(url)
    #打开url
    browser.find_by_id("guideSkip").click()
    #找到id是guideSkip的按钮，并单击
    time.sleep(1)
    browser.find_by_id("u").fill(q)
    #找到id是u的输入框，并输入账号
    browser.find_by_id("p").fill(p)
    #找到id是u的输入框，并输入账号
    browser.find_by_id("go").click()
    #找到id是go的按钮，并单击
    print("完成登陆")
    time.sleep(1)

def find(browser):
    html=browser.html
    #导出当前页面的源代码http://www.jianshu.com/p/5160207221f4
    print html
    content=re.findall('<p>(.*?)</p>',html,re.S)
    for each in content:
        print each
def login_qq():
    url='http://ui.ptlogin2.qzone.com/cgi-bin/login?style=9&appid=549000929&daid=147&pt_no_auth=1&s_url=http%3A%2F%2Fm.qzone.com%2Finfocenter%3Fg_f%3D'
    qq='账号'
    possword='密码'
    browser=Browser()
    login(browser,url,qq,possword)
    find(browser)

def publish():
    browser = Browser('chrome')
    browser.visit("http://www.douban.com")
    a = raw_input("waiting 4 logining...")
    del(a)
    print("start working!let`s do this!")
    while 1:

        browser.visit("http://www.douban.com/group/topic/47136089/?start=10000")#這裏換上自己帖子的地址
        # content = getLrc()
        content = getLrc()
        while "document.write" in content or len(content) < 150:
            content = getLrc()
 
        content = content[56:-11]
    
        browser.find_by_id("last").fill(content)
        browser.find_by_name("submit_btn").click()
        time.sleep(random.randrange(60,300))#適當調大一些 可以免去驗證碼煩惱
def douban():
    browser = Browser('chrome')
    browser.visit('http://www.douban.com/')
    word = raw_input("need a word to begin:")

    browser.visit("http://www.douban.com/group/all?start=0")
    # urlNum = range(0, 1000, 15)
    # cssNum = range(2, 45, 3)
    joinCssWord = '.bn-join-group > span:nth-child(1)'

    for urlNum in range(120, 1000, 15):
    #這裏將1000改爲更大則加入的小組更多
        url = "http://www.douban.com/group/all?start=" + str(urlNum)
        browser.visit(url)
        for cssNum in range(2, 50):#由於有些小組不能顯示（傳說中的私密組麼？）故不能以步長3去跳，也因此效率好低…

            cssWord = "div.clist2:nth-child(" + str(cssNum) + ") > span:nth-child(3) > a:nth-child(1)"
            if browser.find_by_css(cssWord):
                try:
                    browser.find_by_css(cssWord).click()
                except:
                    pass#這裏以及下一個pass都可以print些提示 我自己用就沒寫

            if browser.find_by_css(joinCssWord):
                try:
                    browser.find_by_css(joinCssWord).click()
                except:
                    pass
            if browser.url != url:
                browser.back()#這裏其實可以用browser.visit(url),但是可能會出現驗證碼
def loginweibo():
    web_firefox = Browser('chrome')
    web_firefox.visit('http://weibo.com/login.php')
    # button = browser.find_by_xpath("//input[@value='Sign In']")
    if web_firefox.find_by_name('username'):
        print 'uname'
        # web_firefox.find_by_name('username').click()
        # 这个地方用by_name能找到，但是模拟点击时有问题，改成by_csshttp://www.djhull.com/python/training-python-5.html
        web_firefox.find_by_css(
            "input[node-type=\"username\"]").fill('xxx')
    time.sleep(random.randint(3, 10))

    if web_firefox.find_by_name('password'):
        print 'passwd'
        web_firefox.find_by_css("input[node-type=\"password\"]").fill('xxx')

    time.sleep(random.randint(3, 15))
    # print web_firefox.find_by_css(".loginbox .W_login_form .login_btn a ")[0].click()
    print web_firefox.find_by_css("span[node-type=\"submitStates\"]").click()

    time.sleep(random.randint(3, 10))
    print web_firefox.find_by_css(".input .W_input").fill(u'我说不让你用微博测试，你非用，得了吧。。。。 封ip了吧')

    time.sleep(random.randint(3, 10))
    print web_firefox.find_by_css("a[node-type=\"submit\"]").click()


if __name__ == '__main__':
    websize3 ='http://t.vhall.com/auth/login'
    splinter(websize3)
    # publish()
    #douban()
    #login12306()
    #loginweibo()
