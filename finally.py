#!/usr/bin/python
#-*- coding: utf-8 -*-
import numpy as np
import matplotlib.pyplot as plt
from xlrd import open_workbook
from pylab import *

x_data=[]
y_data=[]
x_data1=[]
y_data1=[]
x_data2=[]
y_data2=[]
x_data3=[]
y_data3=[]
x_volte=[]
temp=[]



plt.annotate('The favorite close loop point',size=16, xy=(1, 0.1), xycoords='data',
                xytext=(-180, 40), textcoords='offset points',
                arrowprops=dict(arrowstyle="->",connectionstyle="arc3,rad=.2")
                )
plt.annotate(' ', xy=(0.02, -0.2), xycoords='data',
                xytext=(200, -90), textcoords='offset points',
                arrowprops=dict(arrowstyle="->",connectionstyle="arc3,rad=-.2")
                )
plt.annotate('Zero point in non-monotonic region', size=16,xy=(1.97, -0.3), xycoords='data',
                xytext=(-290, -110), textcoords='offset points',
                arrowprops=dict(arrowstyle="->",connectionstyle="arc3,rad=.2")
                )






wb = open_workbook('phase_detector.xlsx')
for s in wb.sheets():
    print 'Sheet:',s.name
    for row in range(s.nrows):
        print 'the row is:',row
        values = []
        for col in range(s.ncols):
            values.append(s.cell(row,col).value)
        print values
        #x_data1.append(values[0])
        x_data1.append(values[0]/180.0)
        y_data1.append(values[1])
plt.plot(x_data1, y_data1, 'g--',label=u"Original",linewidth=2)        

wb = open_workbook('phase_detector2.xlsx')
for s in wb.sheets():
    print 'Sheet:',s.name
    for row in range(s.nrows):
        print 'the row is:',row
        values = []
        for col in range(s.ncols):
            values.append(s.cell(row,col).value)
        print values
        #x_data2.append(values[0])
        x_data2.append(values[0]/180.0)
        y_data2.append(values[1])
plt.plot(x_data2, y_data2, 'r-.',label=u"Move the pullup resistor",linewidth=2)




wb = open_workbook('my_data.xlsx')
for s in wb.sheets():
    print 'Sheet:',s.name
    for row in range(s.nrows):
        print 'the row is:',row
        values = []
        for col in range(s.ncols):
            values.append(s.cell(row,col).value)
        print values
        #x_data.append(values[0])
        x_data.append(values[0]/180.0)
        y_data.append(values[1])
plt.plot(x_data, y_data, 'bo--',label=u"Faster D latch and XOR",linewidth=2)

for i in range(360):
    #x_data3.append(i)
    x_data3.append(i/180.0)
    y_data3.append((i-180)*0.052-0.092)
plt.plot(x_data3, y_data3, 'c',label=u"The Ideal Curve",linewidth=2)


plt.title(u"$2\pi$ phase detector",size=20)
plt.legend(loc=0)#显示label
#移动坐标轴代码
ax = gca()
ax.spines['right'].set_color('none')
ax.spines['top'].set_color('none')
ax.xaxis.set_ticks_position('bottom')
ax.spines['bottom'].set_position(('data',0))
ax.yaxis.set_ticks_position('left')
ax.spines['left'].set_position(('data',0))



plt.xlabel(u"$\phi/rad$",size=20)#角度单位为pi
plt.ylabel(u"$DC/V$",size=20)

plt.xticks([0, 0.5, 1, 1.5, 2],[r'$0$', r'$\pi/2$', r'$\pi$', r'$1.5\pi$', r'$2\pi$'],size=16)

for label in ax.get_xticklabels() + ax.get_yticklabels():
    #label.set_fontsize(16)
    label.set_bbox(dict(facecolor='white', edgecolor='None', alpha=0.65 ))

plt.grid(True)

plt.show()
print 'over!'