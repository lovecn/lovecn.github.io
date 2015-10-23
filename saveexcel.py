#coding=utf-8
import tablib
import sys
reload(sys)
sys.setdefaultencoding('utf-8')
# http://www.tantengvip.com/2015/05/python-tablib-excel/  http://blog.csdn.net/hugleecool/article/details/17996993
headers = ('第一列', '第2列', '第3列', '第4列', '第5列')
mylist = [('混合','23','34','23','34'),('呵呵','23','sdf','23','fsad')]
mylist = tablib.Dataset(*mylist, headers=headers)

with open('excelzh.xlsx', 'wb') as f:
	# print mylist.xlsx
    f.write(mylist.xlsx)