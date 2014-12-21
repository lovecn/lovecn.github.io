(function(w) {
// 原型
var Time = function() {
    if (!(this instanceof Time)) {
        return new Time();
    }
    this.time = new Date();
};

// getFullTime 对象
var fullTime = {
    getFullTime: function() {
        var _time = this.time;
        return {
            day: _time.getDate(),
            week: _time.getDay(),
            month: _time.getMonth() + 1,
            year: _time.getFullYear(),
            hours: _time.getHours(),
            minute: _time.getMinutes(),
            seconds: _time.getSeconds(),
            mseconds: _time.getMilliseconds(),
            hab: _time.getFullYear() + '年' + (_time.getMonth() + 1) + '月' + _time.getDate() + '日 星期' + toCweek(_time.getDay()) + ' ' + _time.getHours() + '时' + _time.getMinutes() + '分' + _time.getSeconds() + '秒'
        }
    },
    isLeapYear: function(ele) { //是否是润年
        var ele = ele || this.time.getFullYear(),
            // temp = new Date(ele + '/' + 3 + '/0').getDate();
            temp = new Date(ele,2,0).getDate();
            // console.log(temp+'..')
        return (temp === 29) ? true : false;
    },
    quantityInMonth: function(year, month) { //查询月内有多少天
        var year = year || this.time.getFullYear(),
            month = month || (this.time.getMonth() + 1);

        // return new Date(year + '/' + (month + 1) + '/0').getDate();
        return new Date(year,(month + 1),0).getDate();
    },
    //2010-10-12 01:00:00 这是时间格式
    timeDiff: function(startTime, endTime, diffType) { //相距时间
        startTime = startTime.replace(/\-/g, "/");
        endTime = endTime.replace(/\-/g, "/");
        diffType = diffType.toLowerCase();
        var sTime = new Date(startTime), //开始时间
            eTime = new Date(endTime), //结束时间
            divNum = 1;
        switch (diffType) {
            case "second":
                divNum = 1000;
                break;
            case "minute":
                divNum = 1000 * 60;
                break;
            case "hour":
                divNum = 1000 * 3600;
                break;
            case "day":
                divNum = 1000 * 3600 * 24;
                break;
            default:
                break;
        }
        return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
    }
}


// 深度复制工具
function extendDeep() {
    var i,
        target = arguments[0] || {},
        astr = '[object Array]',
        toStr = Object.prototype.toString,
        yArr = Array.prototype.slice.call(arguments, 1);
    for (i = 0, len = yArr.length; i < len; i++) {
        var temp = yArr[i];
        for (var j in temp) {
            if (target.hasOwnProperty(j) && (target[i] === temp[i])) {
                continue;
            }
            if (temp.hasOwnProperty(j)) {
                if (typeof temp[j] === 'object') {
                    target[j] = (toStr.call(temp[j] === astr)) ? [] : {};
                    extendDeep(target[j], temp[j]);
                } else {
                    if (typeof temp[j] !== 'undefined') {
                        target[j] = temp[j];
                    }
                }
            }
        }
    }
    return target;
}


// 工具函数区

/**
 * [getType 获取任意元素类型]
 * @param  {[none]} ele [要判断类型的元素]
 * @return {[string]}     [返回字符串型类型描述]
 */
function getType(ele) {
    var oStr = Object.prototype.toString.call(ele),
        reg = /\[object (.*)\]/,
        arr = reg.exec(oStr);
    return arr[1];
}

/**
 * [isArray 判断是不是数组]
 * @param  {[元素]}  ele [要判断类型的变量]
 * @return {Boolean}     [如果是数组就返回true，反之false]
 */
function isArray(ele) {
    return (getType(ele) === 'Array') ? true : false;
}

/**
 * [isObject 判断是不是对象]
 * @param  {[元素]}  ele [要判断类型的变量]
 * @return {Boolean}     [如果是对象就返回true，反之false]
 */
function isObject(ele) {
        return (getType(ele) === 'Object') ? true : false;
}
/**
 * [toCweek 把数字转换成汉字的周几]
 * @param  {[number]} ele [数字的周几]
 * @return {[string]}     [汉字的周几]
 */
function toCweek(ele) {
        if (getType(ele) !== 'Number') {
            ele = Number(ele)
            if (isNaN(ele)) {
                return undefined;
            }
        }
        switch (ele) {
            case 0:
                return '日';
                break;
            case 1:
                return '一';
                break;
            case 2:
                return '二';
                break;
            case 3:
                return '三';
                break;
            case 4:
                return '四';
                break;
            case 5:
                return '五';
                break;
            case 6:
                return '六';
                break;
        }
    }
    // 扩展方法getFullTime
extendDeep(Time.prototype, fullTime);
extendDeep(Time.prototype, {
    version: '1.0'
})
if (typeof w.Time === 'undefined') {
    w.Time = Time;
}
})(window)
