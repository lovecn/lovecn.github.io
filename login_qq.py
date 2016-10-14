#!/usr/bin/env python
# coding=utf-8
#http://www.djhull.com/python/training-python-5.html
import time,random
from splinter import Browser


def login(url, q, p):
    browser=Browser('chrome')
    #browser = Browser('webdriver.chrome')
    # browser = Browser('firefox')
    browser.visit(url)
    #time.sleep(5)
    browser.cookies.add({'whatever': 'and ever'})#https://splinter.readthedocs.io/en/latest/elements-in-the-page.html
    cookie = browser.cookies.all()
    print browser.is_element_present_by_xpath('//h1')
    print cookie
    #browser.cookies.delete('whatever', 'wherever')  # deletes two cookies
    #browser.cookies.delete()  # deletes all cookies
    #browser.execute_script("$('body').empty()")
    print browser.evaluate_script("4+4") == 8
    #fill in account and password
    if browser.find_by_id('login_frame'):
        with browser.get_iframe('login_frame') as frame:
            frame.find_by_id('switcher_plogin').click()
            print u'输入账号...'
            frame.find_by_id('u').fill(q)
            print u'输入密码...'
            frame.find_by_id('p').fill(p)
            print u'尝试登录...'
            frame.find_by_id('login_button').click()
            print u'完成登录动作...'

    #browser.find_by_id('aMyFriends').click()
    #time.sleep(3)
def weibo():
    web_firefox = Browser('chrome')
    web_firefox.visit('http://weibo.com/login.php')

    if web_firefox.find_by_name('username'):
        print 'uname'
        # web_firefox.find_by_name('username').click()
        # 这个地方用by_name能找到，但是模拟点击时有问题，改成by_css
        web_firefox.find_by_css(
            "input[node-type=\"username\"]").fill('xxxx@sina.com')
    time.sleep(random.randint(3, 10))

    if web_firefox.find_by_name('password'):
        print 'passwd'
        web_firefox.find_by_css("input[node-type=\"password\"]").fill('******')

    time.sleep(random.randint(3, 15))
    print web_firefox.find_by_css(".loginbox .W_login_form .login_btn div a ")[0].click()

    time.sleep(random.randint(3, 10))
    print web_firefox.find_by_css(".input .W_input").fill(u'我说不让你用微博测试，你非用，得了吧。。。。 封ip了吧')

    time.sleep(random.randint(3, 10))
    print web_firefox.find_by_css("a[node-type=\"submit\"]").click()

if __name__ == '__main__':
    website = 'http://qzone.qq.com'
    qq = ''
    pwd = ''
    login(website, qq, pwd)