
##第二章：语法 
1.标识符   
   
>标识符由一个字母开头，其后可加一个或多个字母、数字或下划线。不允许使用保留字。 `undefined,NaN`和`Infinity`却不是保留字。JS不允许使用保留字来命名参数或者变量，也不允许在对象字面量中，或者在一个属性存取表达式的点号之后，使用保留字作为对象的属性名.
> ps:可以 `undefined = 'test';`不可`var if = 'test';` 

2.数字       

 >    数字类型在内部表示为64位的浮点数。1和1.0是相同的。如果一个数字字面量有指数构成，则其值为由e之前的部分乘以10的e之后的部分的次方计算出来的值，所以100和10e2是相同的。NaN是一个不等于任何值，甚至包括其自身的值。用isNaN(number)检测NaN  

 >    ps:`0.1+0.2!=0.3` 转换下`(0.1*10+0.2*10)/10==0.3`就可以了。`    isNaN(NaN);//true`但它并不靠谱因为`isNaN('NaN');//true`   
3. 字符串   

 >   字符串字面量可以被包围在双引号或单引号之中，包含0个或多个字符。js中的所有字符都为16位的字符集。\为转移字符，\u约定数字字符编码。如`'A'==='\u0041'`
 >     ps:==（相等运算法）vs ===（严格相等运算符） JS对象和其本身相等，和其他任何对象不相等。`({})==({})//false` ===首先计算其操作数的值，然后比较，比较过程无任何类型转换。 ==如果两个操作数不是同一类型的，则相等运算符进行一些类型转换进行比较。 ==这里截取JS相等表格上的的两张图片让大家更为直观的感受下。![](http://htmljs.b0.upaiyun.com/uploads/1396464279990-1.png)
![](http://htmljs.b0.upaiyun.com/uploads/1396464279990-1.png)

>    字符串一旦创建无法改变，同python的不可变类型字符串和元组`var age=22;age[0]=18;console.log(age);//22`想回到18是不可能的,通过+可以连接字符串形成一个新的字符串。`'c'+'a'+'t'==='cat'`就很好理解了,也可以用concat方法`'c'.concat('a').concat('t')`

4.语句 
>   当var语句被用在函数的内部时，他定义了这个函数的私有变量。 switch、while、for、和do语句允许一个可选的前置label配合break一起使用, 语句的执行顺序：从上到下。JS可用过条件语句（if,switch），循环语句（fo,while,do），强制跳转语句（return,break,throw）和函数调用来改变执行顺序。 
false,null,undefined,空字符串”,数字0,数字NaN都为假，其余皆为真。
for循环有两种形式，for(var i=0; i < arr.length,i++){}和for(i in arr){},后者枚举一个对象的所有属性名（或键名）但不包括，object.hasOwnProperty(variable)来检测是否为该对象的成员，还是从原型链里找到的。
异常处理：throw{name:'test',message:'error'}
JS不允许在return关键字和表示式之间换行,同样不允许break关键字和标签之间换行
+=可以用来加法运算或字符串连接         
```javascript
if([]){
alert(true);//output true
} else{
alert(false);
}
return {
name:'test'
}
for(myvar in obj){
      if(object.hasOwnProperty(myvar)){
             ###.....
      }
     }

```


5.表达式

>    最简单的表达式是字面量值（比如字符串或数字）、变量、内置的值（true、false、null、undefined、NaN和Infinity）、以new开头的调用表达式、以delete开头的属性存取表达式、在圆括号中的表达式、以一个前缀运算符作为开头的表达式，或者表达式后面跟着：
* 一个运算符与另一个表达式；
* 三元运算符?后面跟着另一个表达式，然后接一个:，再然后接第3个表达式；
* 一个函数调用；
* 一个属性提取表达式。
type of 运算符产生的值有‘number’ ‘string’ ‘boolean’ ‘undefined’ ‘function’和’object’如果运算数是一个数组或null,那么结果是‘object’  
`typeof null;//object`  检测null可通过`variable===null`
区分对象和null`if(variable&&typeof variable==='object'){//variable是一个对象或数组。}`

6.字面量
> 对象字面量是一种方便指定新对象的表示法。属性名可是标识符或者字符串。`var oabj={name:'js'}`

##第3章
1.对象字变量
> JavaScript中简单类型包括数字、字符串、布尔值、null值和undefined，其他所有的值都为对象（数组是对象，函数是对象，正则表达式是对象，对象当然也是对象）
`var empty_object={};
var stooge={
"first-name":"xxx",
 "last-name:"xxx"
 }`
在对象字面量中，如果属性名是一个合法的JavaScript标识符且不是保留字，并不强制要求用引号括住属性名。所以用引号括住“fisrt-name”是必须的,是否括住first_name才是可选的了  

2.检索
>  要检索对象中包含的值，可以采用在[]后缀中括住一个字符串表达式的方式。若字符串是一个常数且他是一个合法的JavaScript标识符而非保留字,那么也可以用.表示法代替，优先使用.表示法，因为更紧凑可读性更好。
` stooge["first-name"] //xxx
 flight.departure.city //xxx
若检索一个并不存在的成员元素的值，则返回undefined。
||运算符可以用来填充默认值
var status=flight.status||"unkown";         
尝试检索一个undefined值将会导致TypeError异常。可通过&&避免错误。
flight.equipment//undefined
flight.equipment.model//throw "TypeError"
 flight.equipment&&flight.equipment.model//undefined

3.更新
> 对象中的值可以通过复制语句来更新，若属性名已经存在于对象中，那么该属性的值被替换，如果对象之前并未拥有这个属性名，则该属性会被扩充到该对象中。
stooge["first-name"]='bbbbb'
stooge["second-name"]='ccccc'
4.引用
> 对象通过引用来传递。它们永远不会被拷贝。
 var x=chouchou;
x.nickname='huang';
                var nick=chouchou.nickname;
                //因为x和chouchou是指向同一个对象的引用，所以nick也为'huang'
                var a={},b={},c={};
                //a,b,c每个都引用不同的空对象。
                a=b=c={};
                //a,b,c都引用同一个空对象。

5.原型（prototype）
> 每一个对象都连接到一个原型对象，并且它可以从中继承属性，所有通过对象字面量创建的对象都连接到Object.prototype这个JavaScript的标准对象。
 if(typeof Object.create !== 'function') {
                    Object.create =function (o) {
                       var F=function () {};
                       F.prototype=o;
                       return new F(); 
                    }
                }
                var another_chouchou=Object.create(chouchou);

6.反射
>  检查对象并确定有什么属性很容易，只要试着去检索该属性并验证所取得的值。可用typeof
 typeof flight.toString //'function'
typeof flight.constructor //'function'

7.枚举
> for in 语句可用来遍历一个对象中所有的属性名。该枚举过程将会列出所有的属性，包括函数和你可能不关心原型链中的属性。所以我们需要过滤，常用的过滤器是hasOwnProperty以及typeof来排除函数。 属性名出现顺序不确定，要以确定的顺序应创建一个数组，在其中以正确的顺序包含属性名。 var i;
                    var properties=[
                    'fistr-name',
                    'middle-name',
                    'last-name'
                    'profession'
                    ];
                    for(i = 0; i < properties.length;i +=1 ){
                    document.writeln(properties[i]+':'+
                    another[propertites[i]]);
                }

8.删除
> delete运算符可以用来删除对象的属性。它不会触及原型链中的任何对象。删除对象的属性可能让来自原型链中的属性浮现出来。 
                
9.减少全局变量污染 
> JavaScript可以很随意的定义全局变量。但全局变量减弱了程序的灵活性，应予以避免。最小化使用全局变量的方法是在你的应用中只创建一个全局变量。

var MYAPP={};
MYAPP.name={
                    "first-name":"xxx",
                    "last-name":"xxxx"
                };


##第4章函数

1. 函数对象
 >函数就是对象，对象字面量产生的对象连接到Object.prototype,函数对象连接到Function.prototype，函数对象有prototype属性，它的值就是一个拥有constructor属性且为改函数的对象(尼玛，还能再绕点吗),看代码理解
function get(){}
get.prototype.constructor===get

2.函数字面量    

 >      var add =function(a,b){
     return a+b;
     }

3.调用
> 除了声明的参数，还有2个附加的参数this和arguments，javascript有4种调用模式：方法调用，函数调用，构造函数调用，apply/call调用














