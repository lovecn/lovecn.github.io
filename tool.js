var Tool = (function() {
    var type = {
        version: 'v1.2',
        getType: function(ele) {
            if (window == document && document != window) {
                return 'window';
            } else if (ele.nodeType === 9) {
                return 'document';
            } else if (ele.callee) {
                return 'arguments';
            } else if (isFinite(ele.length) && ele.item) {
                return 'NodeList';
            } else {
                var type = Object.prototype.toString.call(ele),
                    reg = /\[object (.*)\]/,
                    arr = reg.exec(type);
                return arr[1];
            }
        },
        isArray : function(ele){
            return (this.getType(ele) === 'Array') ? true : false;
        },
        isFunction : function(ele){
            return (this.getType(ele) === 'Function') ? true : false;
        },
        isObject : function(ele){
            return (this.getType(ele) === 'Object') ? true : false;
        },
        isString : function(ele){
            return (this.getType(ele) === 'String') ? true : false;
        },
        isNumber : function(ele){
            return (this.getType(ele) === 'Number') ? true : false;
        },
        isBoolen : function(ele){
            return (this.getType(ele) === 'Boolean') ? true : false;
        },
        isUndefined : function(ele){
            return (this.getType(ele) === 'Undefined') ? true : false;
        },
        isNull : function(ele){
            return (this.getType(ele) === 'Null') ? true : false;
        }
    }
    Array.prototype.indexOf = function(item){
        var len = this.length;
        for(var i=0;i<len;i++){
            this[i] === item;
            return i;
        }
        return -1;
    };
    //工具函数
    var Tool = function() {
        if (!(this instanceof Tool)) {
            return new Tool;
        }
    };
    //字符串方法
    Tool.str = {
        //判定一个字符串是否包含另一个字符串
        contains: function(target, item) {
            return target.indexOf(item) != -1;
            //return target.indexOf(item) > -1;
        },
        //一般使用在对于类名的判断；
        containsClass: function(target, item, separator) {
            return separator ? (separator + target + separator).indexOf(separator + item + separator) > -1 : this.contains(target, item);
        },
        //参数2是参数1的开头么？
        startsWith: function(target, item, ignorecase) {
            var str = target.slice(0, item.length);
            return ignorecase ? str.toLowerCase() === item.toLowerCase() : str === item;
        },
        //参2是参1的结尾么？
        endsWith: function(target, item, ignorecase) {
            var str = target.slice(-(item.length));
            // console.log(str)
            return ignorecase ? str.toLowerCase() === item.toLowerCase() : str === item;
        },
        //重复item,times次
        repeat: function(item, times) {
            var s = item,
                target = '';
            while (times > 0) {
                if (times % 2 == 1) {
                    target += s;
                }
                if (times == 1) {
                    break;
                }
                s += s;
                times = times >> 1;
            }
            return target;
            //retrun new Array(times).join(item)

        },
        //获得字符串字节长度
        byteLen: function(str, charset) {
            var target = 0,
                charCode,
                i,
                len;
            charset = charset ? charset.toLowerCase() : '';
            if (charset === 'utf-16' || charset === 'utf16') {
                for (i = 0, len = str.length; i < len; i++) {
                    charCode = str.charCodeAt(i);
                    if (charCode <= 0xffff) {
                        target += 2;
                    } else {
                        target += 4;
                    }
                }
            } else {
                for (i = 0, len = str.length; i < len; i++) {
                    charCode = str.charCodeAt(i);
                    if (charCode <= 0x007f) {
                        target += 1;
                    } else if (charCode <= 0x07ff) {
                        target += 2;
                    } else if (charCode <= 0xffff) {
                        target += 3;
                    } else {
                        target += 4;
                    }
                }
            }
            return target;
        },
        //字符串截断方法
        truncate: function(target, len, truncation) {
            len = len || 30;
            truncation = truncation ? truncation : '...';
            return (target.length > len) ? target.slice(0, (len - truncation.length)) + truncation : target.toString();
        },
        //_ - 转驼峰命名
        camelize: function(target) {
            if (target.indexOf('-') < 0 && target.indexOf('_') < 0) {
                return target;
            }
            return target.replace(/[-_][^-_]/g, function(match) {
                console.log(match)
                return match.charAt(1).toUpperCase();
            })

        },
        //转成下划线方法
        underscored : function(target){
            return target.replace(/([a-z0-9])([A-Z])/g,'$1_$2').toLowerCase();
        },
        //转换成连字符模式
        dasherize : function(target){
            return this.underscored(target).replace(/_/g,'-');
        },
        //首字母大写
        capitalize : function(target){
            return target.charAt(0).toUpperCase() + target.slice(1).toLowerCase();
        },
        //去掉script中的内容和Html标签
        stripTags : function(target){
            if(type.getType(target) === 'String'){
                return target.replace(/<script[^>]*>(\S\s*?)<\/script>/img,'').replace(/<[^>]+>/g,'');
            }
        },
        //填补0
        fillZero :function(target,n){
            var z = new Array(n).join('0'),
                str = z + target,
                result = str.slice(-n);
            return result;
            //return (Math.pow(10,n) + '' + target).slice(-n);
        },
        // print
        print : function(str,object){
            var arr = [].slice.call(arguments,1),
                index;
            return str.replace(/#{([^{}]+)}/gm,function(match,name){
                index = Number(name);
                if(index >= 0){
                    return arr[index];
                }
                if(object && object[name] !== ''){
                    return object[name];
                }
                return '';
            })
        },
        //去空格
        trim : function(str){
            str = str.replace(/^\s+/,'');
            for(var i =str.length - 1;i >=0;i--){
                if(/\S/.test(str.charAt(i))){
                    str = str.slice(0,i + 1);
                    break;
                }
            }
            return str;
        }
    };
    // 数组方法
    Tool.arr = {
        //是否包含指定元素
        contains : function(target,item){
            return target.indexOf(item) > -1;
        },
        //在参数1中删除参数2指定的元素返回布尔
        removeAt : function(target,index){
            return !!target.splice(index,1).length;
        },
        //在参数1中删除参数2返回布尔
        remove : function(target,item){
            var index = target.indexOf(item);
            return index > -1 ? this.removeAt(target,index) : false;
        },
        //打乱数组返回新数组
        shuffle : function(target){
            var temp = target,
                j,
                x,
                i = target.length;
            for(;i>0;j = parseInt(Math.random()*i),x = target[--i],target[i] = target[j],target[j] = x){

            }
            return temp;
            //target.sort(function(){return 0.5 - Math.random()});
        },
        //在数组中随机取一个
        random : function(target){
            return target[Math.floor(Math.random() * target.length)];
        },
        //把多维数组变成一维数组
        flatten : function(target){//有问题
            var result = [];
            target.forEach(function(item){
                if(type.getType(item) !== 'Array'){
                    result.push(item);

                }else{
                    result = result.concat(arguments.callee(item));
                }
            });
            return result;
        }

    };
    // 类型判断





    return Tool;

})()
