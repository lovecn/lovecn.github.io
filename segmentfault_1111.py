#encoding=utf-8
import base64
 
f = open("segmentfault_1111.txt", 'rb').read()
str = f.replace("_", "1").replace("\r\n", " ")
s1 = str.split(" ")
s2 = ''
#http://www.atomsec.org/%E6%B8%B8%E6%88%8F/%E5%85%89%E6%A3%8D%E8%8A%82%E7%A8%8B%E5%BA%8F%E5%91%98%E9%97%AF%E5%85%B3%E7%A7%80%E6%94%BB%E7%95%A5/
#http://www.cnblogs.com/partoo/archive/2012/11/11/2765070.html
#https://1111.segmentfault.com/?k=4cf225fc4912510d845edd562c5390b8
#http://www.singlex.net/2319.html
#http://www.waitalone.cn/11-game.html
#替换所有的____为1111，然后再把2进制转换为10进制，然后把10进制转换为char编码，会得到一段Base64密文，再把此密文解密为一个tar.gz的文件即可
#https://post.zz173.com/detail/sf1111.html
for i in range(len(s1)):
    b = chr(int(s1[i], 2))
    s2 += b

print s2 
s3 = base64.b64decode(s2)
f1 = open("segmentfault_1111.rar.rar", "wb")
f1.write(s3)
f1.close()


#binTochar = [chr(int(x, 2)) for x in str.strip().split()]
#keyFile = open('key.tar.gz', 'wb')
#keyFile.write(base64.b64decode(''.join(binTochar)))
#keyFile.close()
