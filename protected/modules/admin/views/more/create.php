<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
   	<base href="http://<?php echo $this->domain;?>/static/">
   	<title>我的名片</title>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<link href="./jquery.toastmessage.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./jquery.js" ></script>
	<script type="text/javascript" src="./jquery.toastmessage.js" ></script>
	<style type="text/css">
		li {
			margin-left: -40px;
			padding: 5px 0px 5px 0px;
			list-style-type: none;
			text-align: center;
		}
		
		.input_text {
			width: 94%;
			height: 35px;
			font-size: 14px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			border:1px solid 4782b2;
			color: #000000;
			padding: 0 3px;
		}
		
		.input_select {
			width: 94%;
			height: 35px;
			font-size: 14px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			font-size: 14px;
			-webkit-appearance: none;
			padding: 0 3px;
			border-radius: 4px;
			color: #4782b2;
			background: url(./r_dot.png) no-repeat 97% center #ebeff2;
		}
		
		.input_textarea {
			width: 94%;
			height: 60px;
			font-size: 14px;
			-webkit-border-radius: 4px;
			border-radius: 4px;
			overflow-y:visible;
			border:1px solid 4782b2;
			color: #000000;
			padding: 3px 3px;
		}
		
		.submit_div {
			margin-top: -10px;
			text-align: center;
			clear: both;
		}
		
		.submit_div input {
			background: #63A2E7;
			height: 45px;
			width: 94%;
			border-radius: 4px;
			line-height: 45px;
			text-align: center;
			color: #FFF;
			font-size: 15pt;
			-webkit-appearance: none;
			border: none;
			font-weight: bold;
		}
	</style>
	<script type="text/javascript">
		String.prototype.trim = function() {
			return this.replace(/^\s+/g,"").replace(/\s+$/g,"");      
        }
        
        function toast(message) {
        	$().toastmessage('showToast', {
				text     :  message,
				sticky   :  false,
				position :  'middle-center',
				type     :  'notice',
				stayTime : 	1500
			});
        }
        
		// 表单验证
		function validate(){
			var nicknameObject = document.getElementById("nickname");
			var sexObject = document.getElementById("sex");
			var favoriteObject = document.getElementById("favorite");
			var userLabelObject = document.getElementById("userLabel");
			var userProfileObject = document.getElementById("userProfile");
			
			if(''==nicknameObject.value || ''==nicknameObject.value.trim()) {
				toast("昵称不允许为空！");
				return false;
			}
			else if(nicknameObject.value.length >10) {
				toast("昵称长度不能超过10个字符！");
				return false;
			}
			else if(0 == sexObject.value) {
				toast("请选择性别！");
				return false;
			}
			else if(0 == favoriteObject.value) {
				toast("请选择您玩游戏的平台！");
				return false;
			}
			else if(''==userLabelObject.value || ''==userLabelObject.value.trim()) {
				toast("请设置至少一个用户标签！");
				return false;
			}
			else if(userLabelObject.value.length >150) {
				toast("用户标签长度不能超过150个字符！");
				return false;
			}
			else if(''==userProfileObject.value || ''==userProfileObject.value.trim()) {
				toast("个人简介不允许为空！");
				return false;
			}
			else if(userProfileObject.value.length >500) {
				toast("个人简介长度不能超过500个字符！");
				return false;
			}
			
			return true;
		}
	</script>
</head>

<body>
	<form action="<?php echo $this->createUrl('more/doCreate')?>" method="post" onsubmit="return validate();">
		<input type="hidden" id="cmd" name="cmd" value="updateUser">
		<input type="hidden" id="fans_id" name="fans_id" value="<?php echo $this->encrypt($this->token,$fans_info['id']);?>"/>
		<ul class="bd_list">
			<li>
				<input type="text" class="input_text" id="nickname" name="fans_neck" value="<?php echo $fans_info['fans_neck'];?>" placeHolder="姓名或昵称，如：段誉">
			</li>
			<li>
				<input type="file" class="input_file" name="fans_pic" />
			</li>
			<li>
				<select class="input_select" id="sex" name="fans_sex">
					<option value="0" <?php if($fans_info['fans_sex'] == ''){ echo 'selected'; }?>>请选择性别</option>
					<option value="1" <?php if($fans_info['fans_sex'] == '1'){ echo 'selected'; }?> >男</option>
					<option value="2" <?php if($fans_info['fans_sex'] == '2'){ echo 'selected'; }?>>女</option>
					<option value="3" <?php if($fans_info['fans_sex'] == '3'){ echo 'selected'; }?>>保密</option>
				</select>
			</li>
			<li>
				<select class="input_select" id="favorite" name="fans_platform" >
					<option value="appstore" selected>appstore</option>
				</select>
			</li>
			<li>
				<textarea id="userLabel" name="fans_tag" class="input_textarea" placeHolder="用户标签，如：80后 手机控 旅游 羽毛球(标签之间以空格分隔)" /><?php echo $fans_info['fans_tag'];?></textarea>
			</li>
			<li>
				<textarea id="userProfile" name="fans_desc" class="input_textarea" placeHolder="个人简介，可以写写所在的城市、从事的职业、兴趣爱好等，方便其他Q友了解认识你。" /><?php echo $fans_info['fans_desc'];?></textarea>
			</li>
		</ul>
		<div class="submit_div">
			<input type="submit" value="提交">
		</div>
	</form>
</body>
</html>

