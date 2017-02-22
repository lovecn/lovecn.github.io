#encoding=utf-8
import time
from selenium import webdriver
import requests,re
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
url = 'http://weibo.com/login.php'
def login(account, passwd, url):
    # 如果driver没加入环境变量中，那么就需要明确指定其路径
    # 验证于2017年2月20日
    # 直接登陆新浪微博
    driver = webdriver.PhantomJS()
    driver.maximize_window()
    # locator = (By.)
    driver.get(url)
    print(u'开始登陆')
    name_field = driver.find_element_by_id('loginname')
    name_field.clear()
    name_field.send_keys(account)
    password_field = driver.find_element_by_class_name('password').find_element_by_name('password')
    password_field.clear()
    password_field.send_keys(passwd)

    submit = driver.find_element_by_xpath('//*[@id="pl_login_form"]/div/div[3]/div[6]/a/span')
    submit.click()

    WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.CLASS_NAME, 'WB_miniblog')))

    source = driver.page_source

    if is_login(source):
        print(u'登录成功')
    else:
        print(u'登录失败')

    sina_cookies = driver.get_cookies()
    driver.quit()
    return sina_cookies


def is_login(source):
    rs = re.search("CONFIG\['islogin'\]='(\d)'", source)
    if rs:
        return int(rs.group(1)) == 1
    else:
        return False
sina_cookies = login('xx@sina.com', 'xx', url)
cookie = [item["name"] + "=" + item["value"] for item in sina_cookies]
cookiestr = '; '.join(item for item in cookie)
print cookiestr

# 验证cookie是否有效
redirect_url = 'http://www.weibo.com/aj/mblog/fsearch?ajwvr=6'
headers = {'cookie': cookiestr}
html = requests.get(redirect_url, headers=headers,verify=False).text
open('source2.txt','a+').write(html.encode('utf-8'))
#print(html.encode('utf-8'))