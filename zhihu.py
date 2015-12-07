import requests
import re
import time
from subprocess import Popen
 
  
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
							      
							      with open('code.gif','wb') as f:
							          f.write(r.content)
								  Popen('code.gif',shell =True)
								  captcha =input('captcha: ')
								  login_data = {
								      '_xsrf':_xsrf,
								          'email':'xxxxx@xxx.com',
									      'password': 'xxxxx',
									          'remember_me':'true',
										      'captcha':captcha
										      }
										       
										       r = s.post('http://www.zhihu.com/login/email',data=login_data,headers=headers)
										       print(r.text)
										       r = s.get('http://www.zhihu.com/settings/profile')
										       print(r.text)

