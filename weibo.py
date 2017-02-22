#encoding=utf-8
import time
from selenium import webdriver
import requests,re
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
# 该段代码在ubuntu上能成功运行，并没有在windows上面运行过 三毛荷西 欧阳修 战争动员 白求恩 
# 直接登陆新浪微博https://github.com/ResolveWang/smart_login/blob/master/sina_login/sina_login_by_selenium.py
url = 'http://weibo.com/login.php'
driver = webdriver.PhantomJS()
driver.set_window_size(1920, 1080)
s=driver.get(url)
driver.implicitly_wait(3)
print(u'开始登陆')
#open('weibo.php','w').write(s.page_source())
# 定位到账号密码表单
login_tpye = driver.find_element_by_class_name('info_header').find_element_by_xpath('//a[2]')
login_tpye.click()
time.sleep(3)

name_field = driver.find_element_by_id('loginname')
print name_field
name_field.clear()
name_field.send_keys('xx@sina.com')

password_field = driver.find_element_by_class_name('password').find_element_by_name('password')
password_field.clear()
password_field.send_keys('xx')

submit = driver.find_element_by_link_text(u'登录')
submit.click()
#https://github.com/fraserxu/electron-pdf  npm install electron-pdf -g
#$ electron-pdf index.html ~/Desktop/index.pdf
#$ electron-pdf index.md ~/Desktop/index.pdf
#$ electron-pdf https://fraserxu.me ~/Desktop/fraserxu.pdf
# 等待页面刷新，完成登陆https://zhuanlan.zhihu.com/p/25006226
# pip uninstall PIL - and - pip install pillow
time.sleep(5)
print(u'登陆完成')
sina_cookies = driver.get_cookies()
cookie_dict = []
for c in sina_cookies:
    ck = "{0}={1};".format(c['name'],c['value'])
    cookie_dict.append(ck)
i = ''
for c in cookie_dict:
    i += c
print i
print sina_cookies


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

#pip install pyinstaller
#pyinstaller -F baiduimg.py
#目录下，dist文件下就有baiduimg.exe文件了，双击即可
#pages = driver.page_source
#soup = BeautifulSoup(pages,'lxml')
#driver.execute_script("JS代码")
#driver.save_screenshot('保存的文件路径及文件名')
# 验证cookie是否有效
redirect_url = 'http://weibo.com/p/1005051921017243/info?mod=pedit_more'
headers = {'cookie': cookiestr}
html = requests.get(redirect_url, headers=headers,verify=False).text
open('source2.txt','a+').write(html.encode('utf-8'))
#print(html.encode('utf-8'))
