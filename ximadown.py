#!/usr/bin/env python
# coding=utf-8
# -*- coding: utf_8 -*-
import os, sys
import urllib2

try:
    from lxml import html
except ImportError:
    raise SystemExit('lxml库导入错误,请安装lxml库!')


# 类定义
class ximalaya:
    def __init__(self, url):
        self.url = url  # 传入的专辑URL,类似http://www.ximalaya.com/16960840/album/294567
        self.num = 10  # 定义默认下载的mp3总数,若不想限制,修改download里面相关代码

    def getpage(self):
        '获取分页数方法'
        pagelen = ''  # 保存分页数
        try:
            request = urllib2.urlopen(self.url, timeout=30).read()
        except Exception, msg:
            print '网页打开出错,请检查!', msg
        else:
            page = html.fromstring(request)
            plen = page.xpath('//div[@class="pagingBar_wrapper"]/a/@href')
            if len(plen) > 1:  # 判断分页是否多于1页
                pagelen = len(plen) - 1  # 排除分页链接中的javascript:;
            else:
                pagelen = 1  # 如果没有分页,则分页数为1
            print '正在获取分页数据,共有分页：%d\n' % pagelen
        return pagelen

    def analyze(self):
        '解析真实地址方法'
        mp3list = []  # 存储解析后的真实地址
        if 'sound' in self.url:
            playurl = self.url.replace('www.', 'm.')
            try:
                page = html.fromstring(urllib2.urlopen(playurl, timeout=30).read())
            except Exception, msg:
                print '请求播放地址出错', msg, playurl
            else:
                mp3 = page.xpath('//div[@class="pl-info-panel"]/a/@sound_url')[0]  # 获取真实的mp3地址
                title = page.xpath('//h1[@class="pl-name"]/text()')[0]
                mp3list.append((title, mp3))
                print '指定mp3地址解析成功: %s\n' % mp3
        else:
            for ids in range(1, self.getpage() + 1):
                purl = self.url + '?page=' + str(ids)  # 生成真实的分页地址
                try:
                    request = urllib2.urlopen(purl, timeout=30).read()
                except Exception, msg:
                    print '请求分页地址出错', msg
                else:
                    page = html.fromstring(request)
                    plist = page.xpath('//div[@class="miniPlayer3"]/a[@class="title"]')
                    for i in range(len(plist)):
                        title = plist[i].attrib['title']  # 获取每条mp3标题
                        link = plist[i].attrib['href']  # 获取每条mp3地址
                        id = link[link.rfind('/') + 1:]  # 获取专辑下所有的id
                        playurl = self.url.replace('www.', 'm.').replace('album', 'sound')  # 替换为移动端访问地址
                        playurl = playurl.replace(playurl[playurl.rfind('/') + 1:], id)  # 替换原始url中最后一段id
                        print playurl
                        try:
                            page = html.fromstring(urllib2.urlopen(playurl, timeout=30).read())
                        except Exception, msg:
                            print u'请求播放地址出错', msg, playurl
                        else:
                            mp3 = page.xpath('//div[@class="pl-info-panel"]/a/@sound_url')[0]  # 获取真实的mp3地址
                            mp3list.append((title, mp3))
            print u'批量mp3地址解析成功,共有mp3: [%d] 条!\n' % len(mp3list)
        return mp3list

    def download(self):
        '下载mp3方法'
        count = 0  # 下载计数器
        for title, mp3 in self.analyze():
            count += 1
            title = title.replace('?', '').replace('"', '').replace(':', '').replace('/', '')  # 替换标题中特殊字符
            title = title.encode('utf8', 'ignore')  # 编码转换,避免报错
            mp3_name = title + '.mp3'
            try:
                if os.path.isfile(mp3_name) and os.path.getsize(mp3_name) > 0: continue
                print '正在下载 %s\n' % title
                with open(mp3_name, 'wb') as mp3_file:  # 保存mp3到本地
                    mp3_file.write(urllib2.urlopen(mp3).read())
                    print mp3_name + ' 下载成功!\n'
            except Exception, msg:
                print '\n爷,有部分下载失败了:', title, msg
            if count == self.num: break  # 如果不想限制,请在此行前面加入注释。


if __name__ == '__main__':
    print '+' + '-' * 50 + '+'
    print '\t   Python 喜马拉雅mp3批量下载工具'
    print '\t   Blog：http://www.waitalone.cn/'
    print '\t\t Code BY： 独自等待'
    print '\t\t Time：2016-02-16'
    print '+' + '-' * 50 + '+'
    if len(sys.argv) != 2:
        print '用法: ' + os.path.basename(sys.argv[0]) + ' 你要下载的专辑mp3主页地址,地址如下：'
        print '实例: ' + os.path.basename(sys.argv[0]) + ' http://www.ximalaya.com/12495477/album/269179'
        sys.exit()
    ximalaya = ximalaya(sys.argv[1])  # 实例化类
    ximalaya.download() # 下载mp3