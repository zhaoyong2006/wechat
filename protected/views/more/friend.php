<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
   	<base href="http://<?php echo $this->domain;?>/static/">
   	<title>掌门帮</title>
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,initial-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<link href="./friends.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./jquery.js" ></script>
	<link href="./easydialog.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./easydialog.min.js" ></script>
	
	<link href="./jquery.toastmessage.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./jquery.toastmessage.js" ></script>
	<script type="text/javascript">
		// 赞
		function praise() {
			// 当前访问者的open_id
			var visitorOpenId = 'olWDbjnVyr7axwiJNis7B5dwXHHk';
			// 被浏览用户的open_id
			var openId = 'olWDbjjDQmb2rSyEqBD9YIT3ZCzo';
			
			if(visitorOpenId != openId) {
				// 清除ajax缓存
				$.ajaxSetup({ 
					cache: false 
				}); 

				var url = '#';
		       	var params = {
		 			"openId" : openId,
		 			"visitorOpenId" : visitorOpenId,
		 			"timestamp" : new Date().getTime()
		       	};
		       	jQuery.post(url, params, callbackFun, 'text');
	       	}
	       	else {
	       		$().toastmessage('showToast', {
					text     : '不可以赞自己哦！',
					sticky   : false,
					position : 'middle-center',
					type     : 'notice',
					stayTime : 	1500
				});
	       		 
	       	}
		}
		
		function callbackFun(data) {
			if('repeat'==data) {
				$().toastmessage('showToast', {
					text     : '你已经赞过妮妮了！',
					sticky   : false,
					position : 'middle-center',
					type     : 'notice',
					stayTime : 	1500
				});
			}
			else {
				document.getElementById("praiseBtn").innerHTML = "赞 +" + data;
				$().toastmessage('showToast', {
					text     : '你狠狠地赞了妮妮一下！',
					sticky   : false,
					position : 'middle-center',
					type     : 'notice',
					stayTime : 	1500
				});
			}
		}
		
		// 浏览上一个
		function gotoPrevFriend(openId) {
			window.location.href = 'http://<?php echo $this->domain;?>/index.php?r=more/friend&cmd=gotoPrevFriend&u=<?php echo $u;?>';
		}
		
		// 浏览下一个
		function gotoNextFriend(openId) {
			window.location.href = 'http://<?php echo $this->domain;?>/index.php?r=more/friend&cmd=gotoNextFriend&u=<?php echo $u;?>';
		}
		
	</script>
</head>
<body>
	<div class="friendsTop">
		<input type="button" class="prevArrow" onclick="gotoPrevFriend('olWDbjjDQmb2rSyEqBD9YIT3ZCzo')">
		<div class="friendsPhoto">
	    	<center><img src="<?php if(!empty($fansinfo['fans_pic'])){ echo $fansinfo['fans_pic'];}else{ ?>./images/default_male.jpg<?php }?>" width="200px" height="200px"/></center>
	    </div>
	    <input type="button" class="nextArrow" onclick="gotoNextFriend('olWDbjjDQmb2rSyEqBD9YIT3ZCzo')">
	</div>
	<div class="friendsInfo">
		<div class="infoDiv">
			<span class="nickname"><?php echo $fansinfo['fans_neck'];?></span><?php if($fansinfo['fans_sex'] == '1'){ echo "♂";}elseif($fansinfo['fans_sex'] == '2'){ echo "♀";}else{ echo "保密";}?><span class="favorite"><?php echo $fansinfo['fans_platform'];?></span>
		</div>
		<dl>
			<dd>
	    		<span class="spanMulti"><img align="absmiddle" src="./images/location_10.png" >&nbsp;这家伙没有公开地址</span>
	        </dd>
	        <dd>
	    		<span class="spanMulti"><?php echo $fansinfo['fans_tag'];?></span>
	        </dd>
	    </dl>
	    <div class="tagBoxGroup">
			
					<span class="tagBox"><?php echo $fansinfo['fans_desc'];?></span>
			
		</div>
	</div>
</body>
</html>

