
    var flag;
    //验证规则
    var	rule = {
        //正则规则
        "eng" : /^[A-Za-z]+$/,
        "chn" :/^[\u0391-\uFFE5]+$/,
		"mix":/^(\w|[\u4E00-\u9FA5]){2,12}$/,
        "email" : /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/,
        "url" : /^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/,
        "currency" : /^\d+(\.\d+)?$/,
        "number" : /^\d+$/,
        "int" : /^[1-9]{1}[0-9]{1}[0-8]{1}$/,
        "double" : /^[-\+]?\d+(\.\d+)?$/,
        "username" : /^[a-zA-Z]{1}([a-zA-Z0-9]|[._]){4,19}$/,
        "password" : /^(\w){6,20}$/,
        "safe" : />|<|,|\[|\]|\{|\}|\?|\/|\+|=|\||\'|\\|\"|:|;|\~|\!|\@|\#|\*|\$|\%|\^|\&|\(|\)|`/i,
        "dbc" : /[ａ-ｚＡ-Ｚ０-９！＠＃￥％＾＆＊（）＿＋｛｝［］｜：＂＇；．，／？＜＞｀～　]/,
        "qq" : /[1-9][0-9]{4,}/,
        "date" : /^((((1[6-9]|[2-9]\d)\d{2})-(0?[13578]|1[02])-(0?[1-9]|[12]\d|3[01]))|(((1[6-9]|[2-9]\d)\d{2})-(0?[13456789]|1[012])-(0?[1-9]|[12]\d|30))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(0?[1-9]|1\d|2[0-8]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))$/,
        "year" : /^(19|20)[0-9]{2}$/,
        "month" : /^(0?[1-9]|1[0-2])$/,
        "day" : /^((0?[1-9])|((1|2)[0-9])|30|31)$/,
        "hour" : /^((0?[1-9])|((1|2)[0-3]))$/,
        "minute" : /^((0?[1-9])|((1|5)[0-9]))$/,
        "second" : /^((0?[1-9])|((1|5)[0-9]))$/,
        "mobile" : /^0?(13[0-9]|15[0-9]|18[0-9])\d{8}$/,
        "phone" : /^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/,
        "zipcode" : /^[1-9]\d{5}$/,
        "idcard" : /^((1[1-5])|(2[1-3])|(3[1-7])|(4[1-6])|(5[0-4])|(6[1-5])|71|(8[12])|91)\d{4}((19\d{2}(0[13-9]|1[012])(0[1-9]|[12]\d|30))|(19\d{2}(0[13578]|1[02])31)|(19\d{2}02(0[1-9]|1\d|2[0-8]))|(19([13579][26]|[2468][048]|0[48])0229))\d{3}(\d|X|x)?$/,
        "ip" : /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/,
        "file": /^[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/,
        "image" : /.+\.(jpg|gif|png|bmp)$/i,
        "word" : /.+\.(doc|rtf|pdf)$/i

    }

    function ckform(item1 , item2) {
        $.each(item2 , function() {
            var field = $("[name = '"+this.name+"']");
            if(field.is(":hidden")) return;
            var obj = this;
            var tocheck = function() { return ck_from(obj , field);};

            if(field.is(':file') || field.is('select') || field.is(':radio') || field.is(':checkbox') ) {
                //field.after('<div class="msgs"><div class="msg1"></div><div class="msg2"></div><div class="msg3"></div></div>');
                field.after('<font></font>');
                field.bind('change', tocheck);
            } else {
            	field.bind('blur', tocheck);
            }

            //submit    绑定提交
            $('#'+item1).submit(tocheck);
        });
    }

    function ck_from(obj , jobj) {
        var w = obj.msg;
        var min = obj.min;
        var max = obj.max;
        var types = obj.type;
        var match = obj.to;
        var isajax = obj.isajax;
        var sp = obj.sp;
        var val = encodeURI($.trim(jobj.val()));
		if(types=='mix'){
			var val = $.trim(jobj.val());
		}
        //修改加入全角
        //var len = ck_from_len(jobj.val());
		var len = jobj.val().length;
        if (val == '') {
            if (jobj.is(':file') || jobj.is('select') || jobj.is(':radio') || jobj.is(':checkbox')) {
                return message(jobj , w+'没有选择！' , false , sp);
            } else {
                return message(jobj , w+'不能为空！' , false, sp);
            }

        } else if (typeof(min) != 'undefined' && typeof(max) != 'undefined' && len<min || len>max) {
            if (min == max) {
                return message(jobj , w+'的长度应该等于'+min , false , sp);
            } else {
                return message(jobj , w+'长度应在'+min+'-'+max+'位之间' , false , sp);
            }

        } else if (typeof(match) != "undefined" && match) {
            if (encodeURI($.trim($("[name = '"+match+"']").val())) != val) {
                return message(jobj , '密码输入不一致！' , false , sp);
            } else {
                return message(jobj , '完成' , true , sp);
            }

        } else if (typeof(types) != 'undefined' && types) {
            if (rule[types].test(val)) {
                flag = message(jobj , '完成' , true , sp);
            } else {
                return message(jobj , w+'格式不正确' , false , sp);
            }

        } else if (typeof(isajax) == 'undefined' && !isajax) {
            return message(jobj , '完成' , true , sp);
        }

        //ajax验证
         if (typeof(isajax) != 'undefined' && isajax) {

            $.get('add.php',{},function(msg) {
                    if (msg == 0) {
                        flag = message(jobj , w+'已经被注册！' , false , sp);
						//flag=false;
                    } else {
                        flag = message(jobj , '完成' , true , sp);
                    }
                }
            );
        }
        return flag;
    }

    function ck_from_len(val) {
    	var len = 0;
		for (var i = 0; i < val.length; i++) {
		if (val.charAt(i).match(/[^\x00-\xff]/ig) != null) //全角
		len += 2;
		else
		len += 1;
		}

		return len;
    }

    //提示信息
    function message(obj , msg , rs , sp) {
		var pattern =/year|month|day/i;
        if (typeof(sp)!='undefined' && sp) {
            var sp = $('#'+sp);
            //sp.parent().show();
            //sp.show();
            return colors(sp.html(msg) , rs);

        } else if (pattern.test(obj.attr('name'))) { 			//判断是否是出生日期
			//var obj = obj.next('div').show().children('.msg2').html(msg);
			var na = obj.attr('name');
			var obj = obj.siblings('#msg'+na).show().html(msg);
            return colors(obj , rs);
		} else {
            //var obj = obj.next('div').show().children('.msg2').html(msg);
            var obj = obj.next('font').html(msg);
            return colors(obj , rs);
        }
    }
    //改变字体颜色
    function colors(obj , rs) {
        if (rs) {
            obj.css('color','gray');
            return rs;
        } else {
            obj.css('color','#f935b6');
            return rs;
        }
    }