'''
    Get all the answers of xxx from zhihu.com http://www.oschina.net/code/snippet_1027602_34233
'''
import urllib
import re
import threading
import sys
import os

import time
import random
headers=[
    "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0",
    "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36",
    "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36",
    "Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:10.0) Gecko/20100101 Firefox/10.0",
    "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36 SE 2.X MetaSr 1.0"
    ]
 
def random_header():
    random_header=random.choice(headers)
    return random_header
class zhihu_spider(threading.Thread):
    def __init__(self,url,path):
        threading.Thread.__init__(self)
        self.url = url
        self.path = path
 
    #get the pages,and answer ids
    def get_relmes(url,pattern):
        requests=urllib.request.Request(url)
        requests.add_header("User-Agent",exploreq.random_header())
        content=urllib.request.urlopen(requests).read()
        unicodecontent=content.decode('utf-8')
        res=pattern.findall(unicodecontent)
        return res
 
    def data_mana(self,data):
        pattern=re.compile('<div class=" zm-editable-content clearfix">(.*?)</div>',re.S)
        url_pre='http://www.zhihu.com'
        urls=[]
        questions=[]
        answers=[]
        for item in data:
            urls.append(url_pre+item[0])
            questions.append(item[1])
        for item in urls:
            answers.append(zhihu_spider.get_relmes(item,pattern))
        #create a dictionary to store the questions and answers
        result=zip(questions,answers)
        return result
 
    def run(self):
            pattern=re.compile('<a.class="question_link".href="(.*?)">(.*?)</a>',re.S)
            res=zhihu_spider.get_relmes(self.url,pattern)
            result=self.data_mana(res)
            try:
                file=open(self.path,'w')
                for (k,v) in result:
                    file.write(str(k)+'\n'+str(v)+'\n')
                file.close()
            except Exception as e:
                print('Error '+str(e)+'!')        
 
def content_Replace(content):
    BlankCharReplace=re.compile('(\t|\n)')
 
if(__name__=='__main__'):
    start_time=time.clock()
    spider_list=[]
    #store_path=input("Please type into the absolute path to store data\n")
    store_path='D:\\zhihutest'
    #name=input("Please type into the name what you want to get\n")
    answers_url='http://www.zhihu.com/people/'+'Fenng'+'/answers'
    #Get the answer page
    page_pattern=re.compile(r'<a href="\?page=(\d*)">')
    pages=zhihu_spider.get_relmes(answers_url,page_pattern)
    page=max(pages)
    #Get the questions and answers on each page
    end_url='/?page='
    for i in range(1,int(page)+1):
        if i==1:
            url=answers_url
        else:
            url=answers_url+end_url+str(i)
        spider_list.append(zhihu_spider(url,os.path.join(store_path+'\\'+str(i)+'.txt')))
    for spider in spider_list:
        try:
            spider.start()
        except:
            spider_list.append(spider)
        time.sleep(10)
     
    for spider in spider_list:
        spider.join()
             
    end_time=time.clock()
    print('Over!!!\n'+str(end_time-start_time)+'s')