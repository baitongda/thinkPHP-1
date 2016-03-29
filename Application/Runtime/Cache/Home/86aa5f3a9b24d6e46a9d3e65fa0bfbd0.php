<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>中农在线</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="/Public/mall/css/vipdate.css" type="text/css">
	<script type="text/javascript" src="/Public/mall/js/jquery.1.11.3.min.js"></script>

	<!--[if IE]> 
	<script> 
	(function(){if(!/*@cc_on!@*/0)return;var e = "header,footer,nav,article,section".split(','),i=e.length;while(i--){document.createElement(e[i])}})() 
	</script> 
	<![endif]-->
	<!--[if lt IE 8]>
	<script type="text/javascript" src="/Public/mall/js/IE8.js"></script>
	<![endif]-->
	<script type="text/javascript">
	//身份证验证
		 function IdentityCodeValid(code) { 
            var city={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "};
            var tip = "";
            var pass= true;
            
            if(!code || !/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[012])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i.test(code)){
                tip = "身份证号格式错误";
                pass = false;
            }
            
           else if(!city[code.substr(0,2)]){
                tip = "地址编码错误";
                pass = false;
            }
            else{
                //18位身份证需要验证最后一位校验位
                if(code.length == 18){
                    code = code.split('');
                    //∑(ai×Wi)(mod 11)
                    //加权因子
                    var factor = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ];
                    //校验位
                    var parity = [ 1, 0, 'X', 9, 8, 7, 6, 5, 4, 3, 2 ];
                    var sum = 0;
                    var ai = 0;
                    var wi = 0;
                    for (var i = 0; i < 17; i++)
                    {
                        ai = code[i];
                        wi = factor[i];
                        sum += ai * wi;
                    }
                    var last = parity[sum % 11];
                    if(parity[sum % 11] != code[17].toUpperCase()){
                        tip = "校验位错误";
                        pass =false;
                    }
                }
            }
            if(!pass);
            return pass;
        }

	</script>
	<script type="text/javascript">
		$(function(){

			// 生日和地区
			$(".selectWrap").blur(function(){	            	
                $(".selectWrap select").each(function(){
                    if($(this).val()=="0"){
                    	$(this).parent().css("border","1px solid #ff6600");
                    	$(this).addClass("onError");
                    }else{
                    	$(this).parent().removeAttr("style");
                    	$(this).removeClass("onError");
                    }

                });
                   
	        }).click(function(){
	        	$(this).triggerHandler("blur");
	        }).keyup(function(){
	        	$(this).triggerHandler("blur");
	        });
	        
			
        	$('form :input').blur(function(){
	             var $parent = $(this).parent();
	             $parent.find(".formtips").remove();
	             $(this).removeAttr("style");
	             //真实姓名验证
	             if($(this).is('#realName')){
	             	var realNameReg= /^[\u4e00-\u9fa5 ]{2,20}$/; //中文验证
	             	if (this.value=="" || (!realNameReg.test(this.value))) {
	             		var errorMsg = '请您填写您的真实信息';
	             		$parent.append('<p class="formtips onError">'+ errorMsg+'</p>');
	             		$(this).css("border","1px solid #ff6600");
	             	}
	             }

	         
	             //身份证号验证
	             if($(this).is('#IDnumber')){
	             
	             	if (this.value=="") {
	             		var errorMsg = '请输入身份证号';
	             		$parent.append('<p class="formtips onError">'+ errorMsg+'</p>');
	             		$(this).css("border","1px solid #ff6600");
	             	} else if ((IdentityCodeValid(this.value) == false)) {
	             		var errorMsg = '请输入正确的身份证号';
	             		$parent.append('<p class="formtips onError">'+ errorMsg+'</p>');
	             		$(this).css("border","1px solid #ff6600");

	             	}
	             }

	           
	             //密码验证
	             if( $(this).is('#userPwd') ){
	             	var pwdCode = /^(?![\d]+$)(?![a-zA-Z]+$)(?![^\da-zA-Z]+$).{6,20}$/;
	             	//alert(this.tagName);
	                if( this.value=="" ){
	                      var errorMsg = '请输入密码';
	                      $parent.append('<p class="formtips onError">'+ errorMsg+'</p>');
	                      $(this).css("border","1px solid #ff6600");
	                } else if (!pwdCode.test(this.value)) {
	                      var errorMsg = '密码由6-20位字母、数字、特殊符号的任意二种以上组合';
	                      $parent.append('<p class="formtips onError">'+ errorMsg+'</p>');
	                      $(this).css("border","1px solid #ff6600");
	                }
	             }
        
	        }).keyup(function(){
	           $(this).triggerHandler("blur");
	        });//end blur


	        

	        //提交，最终验证。
	         $('.form-btn').click(function(){
	                $("form :input.require , .selectWrap.require").trigger("blur");//点击btn之后再次检测一遍form的内容
	                var numError = $('form .onError').length;
	                if(numError){
	                    return false;
	                }

	         });

		});
	</script>
</head>
<body>
	<header>
	<div class="main-header">
		<section>
			<div class="logo fl"></div>
			<div class="li-link fr">
				<a href="###">农资商城</a>&emsp;|&emsp;
				<a href="###">网上庄稼医院</a>&emsp;|&emsp;
				<a href="###">中农在线</a>
			</div>
		</section>
	</div>	
</header>


	<section class="main-wrap">
		<h3>申诉</h3>
		<img src="/Public/mall/images/appeal-pwd2.png" class="pwd-path">
		<div class="main-form">
			<form action="" method="">
				<p class="appealTwoTit">申诉基本资料 <em>请填写一些您的个人信息，我们会严格保密</em></p>
				<div class="item">
					<span>您的真实姓名：</span>
					<input type="text" name="realName" id="realName" value="" class="input250 require" placeholder="请您填写您的真实信息" />
				</div>
				<div class="item">
					<span>身份证号码：</span>
					<input type="text" name="IDnumber" id="IDnumber" value="" class="input250 require" placeholder="" />
				</div>
				<div class="item">
					<span>出生日期：</span>
					<div class="selectWrap require">
						<select name="selYear" id="selYear" class="input78 "> <!-- 生日年 -->
				        </select>
				        <select name="selMonth" id="selMonth" class="input78 ">  <!-- 生日月 -->
				        </select>
				        <select name="selDay" id="selDay" class="input78 ">  <!-- 生日日 -->
				        </select>
					</div>
					
				</div>

<script type="text/javascript" src="/Public/mall/js/birthday.js"></script>
<script>  
$(function () {
	$.ms_DatePicker({
            YearSelector: "#selYear",
            MonthSelector: "#selMonth",
            DaySelector: "#selDay"
    });
	$.ms_DatePicker();
}); 
</script> 

				<p class="appealTwoTit">账号注册信息 <em>填写您注册时选择的信息</em></p>
				<div class="item">
					<span>注册地点：</span>
					<div class="selectWrap require">
						<select name="" id="" class="input120 ">
				            <option value="0">请选择</option>
				            <option value="1">11</option>
				            <option value="2">22</option>
				            <option value="3">33</option>
				            <option value="4">44</option>
				            <option value="5">55</option>
				        </select>
				        <select name="" id="" class="input120 ">
				            <option value="0">请选择</option>
				            <option value="1">11</option>
				        </select>
			        </div>
				</div>

				<p class="appealTwoTit">账号使用信息   <em>填写您使用过的信息</em></p>
				<div class="item">
					<span>您曾经使用过的密码：</span>
					<input type="password" name="userPwd" id="userPwd" value="" class="input250 require" placeholder="不确定的也可以写哦" />
				</div>
				<div class="item">
					<span>您曾经使用过的密码：</span>
					<input type="password" name="userPwd" id="userPwd" value="" class="input250 require" placeholder="不确定的也可以写哦" />
				</div>

				<div class="item">
					<span> </span>
					<a href="###" class="form-btn">下一步</a>
				</div>


			</form>
		</div>
	</section>

	<footer>
	<div class="footerImg">
		<ul>
			<li>政府护航  购物无忧</li>
			<li style="background-position:-22px -141px;">随时随地  想问就问</li>
			<li style="background-position:-22px -214px;">全程跟踪  放心农资</li>
			<li style="background-position:-22px -289px;">省内热线 <em>96318</em></li>
		</ul>
	</div>
	<p>© &nbsp;2015 &nbsp;中农在线&nbsp; 版权所有，&nbsp;并保留所有权利</p>
	<p>增值电信业务经营许可证:浙B2-20150086</p>
</footer>
</html>