# !/usr/bin/python
# coding: utf-8

import os
import sys
import glob
import json
import math
import Queue
import base64
import struct
import socket
import string
import shutil
import thread
import random
import smtplib
import httplib
import logging
import tempfile
import argparse
import datetime
import unittest
import importlib
import threading
import traceback
import subprocess
import ConfigParser
from ftplib import FTP
from email.header import Header
from email.mime.text import MIMEText
from logging.handlers import TimedRotatingFileHandler


import requests,re,urllib,time
from urlparse import urlparse
#from sys import argv
#播放地址
url='http://xxx.com/vhalllive/363200352/fulllist.m3u8'

#url=argv[1]
print url
res=requests.get(url)
r=res.content
hosturl=urlparse(url).scheme+'://'+urlparse(url).hostname
print hosturl
arr=filter(lambda i: '' '.ts'in i,r.split('\n'))
print arr
urllist=map(lambda i :hosturl+i,arr)
print urllist
m3u8file = "movie.m3u8"
with open(m3u8file,'w') as f:
    f.write(r.replace('/','-'))
#下载ts文件到本地
for i in urllist:
    urllib.urlretrieve(i,urlparse(i).path.replace('/','-'))
    time.sleep(1)
#select date_format(created_at,'%Y-%m-%d') as date,count(*) from demands where date_format(created_at,'%Y-%m-%d') in ('2016-04-18','2016-04-08') group by date order by id desc limit 5;
def transcode(m3u8file):
    # 打开m3u8文件
    
    try:
        with open(m3u8file) as file_:
            m3u8lines = file_.readlines()
    except Exception as e:
        return

    # 拼接所有ts切片文件成为一个ts文件。
    tsfile = "one.ts"
    destfp = open(tsfile, 'wb+')
    for m3u8line in m3u8lines:
        m3u8line = m3u8line.strip("\n")
        if m3u8line.endswith(".ts"):
            srcfp = open(m3u8line, 'rb')
            buf = srcfp.read()
            srcfp.close()
            destfp.write(buf)
    if destfp:
        destfp.close()

    # ts transcode mp4 需要下载ffmpeg软件
    mp4file = tsfile.replace(".ts", ".mp4")
    # ffmpeg -i in.m3u8 -acodec copy -bsf:a aac_adtstoasc -vcodec copy out.mp4
    # # you should download the files in m3u8 file first
    #ffmpeg -i the.file.m3u8 -acodec copy -vcodec copy  -y -loglevel info -bsf:a aac_adtstoasc -f mp4 your-mp4-file.mp4


    # First 10 Minutes
    #ffmpeg -i VIDEO_SOURCE.mp4 -vcodec copy -acodec copy -ss 0 -t 00:10:00  VIDEO_PART_1.mpg
    # Second 10 Minutes
    #ffmpeg -i VIDEO_SOURCE.mp4 -vcodec copy -acodec copy -ss 00:10:00 -t 00:20:00  VIDEO_PART_2.mpg
    # Rest after the first 20 Minutes
    #ffmpeg -i VIDEO_SOURCE.mp4 -vcodec copy -acodec copy -ss 00:20:00  VIDEO_PART_3.mpg
    #ffmpeg -i "http://host/folder/file.m3u8" -bsf:a aac_adtstoasc -vcodec copy -c copy -crf 50 file.mp4
    #mp4转m3u8 http://blog.csdn.net/jookers/article/details/21694957
    #ffmpeg -i input.mp4 -c:v libx264 -c:a aac -strict -2 -f hls output.m3u8
    #fmpeg -i input0.mp4 -vn input0.mp3 -c:v libx264 -c:a aac -strict -2 -f hls -hls_list_size 0 output.m3u8
    ffts2mp4 = "ffmpeg -v error -y -analyzeduration 10000000 -i %s -vcodec copy -bsf:a aac_adtstoasc %s" % (tsfile, mp4file)
    proc = subprocess.Popen(ffts2mp4, stdin=None, stdout=subprocess.PIPE, stderr=subprocess.STDOUT, bufsize=0, shell=True)
    return proc.communicate()

transcode(m3u8file)