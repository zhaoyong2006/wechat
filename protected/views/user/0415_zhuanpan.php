<!doctype html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>乱世曲转盘抽奖</title>
	<meta content='width = device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0' name='viewport'>
	<meta content='yes' name ='apple-mobile-web-app-capable'>
	<meta content='black' name='apple-mobile-web-app-status-bar-style'>
	<meta content='telephone=no' name='format-detection'>
    <!--[if lt IE 9]>
      <script src=”http://html5shiv.googlecode.com/svn/trunk/html5.js”></script>
    <![endif]-->
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
	<div class="wrap">
		<img src="http://<?php echo $this->cdn;?>/static/images/bg.jpg" alt="" class="bgimg">
		<div class="main">
			<div class="tit">
				<img src="http://<?php echo $this->cdn;?>/static/images/tit.png" alt="">
			</div>
			<div class="ly-plate">
				<div class="rotate-bg">
					<img src="http://<?php echo $this->cdn;?>/static/images/pan.png" alt="">
					<div class="lottery-star">
						<a href="#">
							<img src="http://<?php echo $this->cdn;?>/static/images/rotate-static.png" id="lotteryBtn">
						</a>
					</div>
				</div>
			</div>
			<div class="record">
				<img src="http://<?php echo $this->cdn;?>/static/images/record.png" alt="">
			</div>
		</div>
		<!-- 弹出框部分 -->
		<div class="tip1 tips">
			<p class="awardsText">恭喜你获得电影券</p>
			<p class="awardPWD"></p>
			<div class="tipClose">
				
			</div>
		</div>

		<div class="tip2 tips">
			<p class="atitle">恭喜你获得京东卡！</p>
			<p>请留下你的联系方式</p>
			<form action="<?php echo $this->createUrl('user/getshiwu');?>" method="post">
			<input type="hidden" name="fans_name" value="<?php echo $fans_name;?>"/>
				<div>
					<label for="username">姓名：</label>
					<input type="text" id="consignee" name="consignee">
				</div>
				<div>
					<label for="address">地址：</label>
					<input type="text" id="address" name="address">
				</div>
				<div>
					<label for="phone">电话：</label>
					<input type="text" id="phone" name="phone">
				</div>
				<div>
					<label for="sarea">游戏区服：</label>
					<input type="text" id="sarea" name="sarea">
				</div>
				<div>
					<label for="rolename">角色名：</label>
					<input type="text" id="rolename" name="rolename">
				</div>	
				<input type="submit" class="asubmit" id="asubmit" value="">			
			</form>
			<div class="tipClose"></div>
		</div>

		<div class="tip3 tips">
			<p class="awardsText">你没有抽奖机会了！</p>
			<p>消耗30微信积分,获得1次抽奖机会</p>
			<div class="OK"></div>
			<div class="tipClose">
				
			</div>
		</div>

		<div class="tip4 tips">
			<p>获奖记录如下：</p>
			<div class="as">	
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
				<p>jeason获得XXXXX</p>
			</div>
			<div class="tipClose">
				
			</div>
		</div>		

	</div>

<script type="text/javascript" src="http://<?php echo $this->cdn;?>/static/js/jquery.min.js"></script>
<script type="text/javascript" src="http://<?php echo $this->cdn;?>/static/js/jQueryRotate.2.2.js"></script>
<script type="text/javascript" src="http://<?php echo $this->cdn;?>/static/js/jquery.easing.min.js"></script>
<script type="text/javascript">
$(function(){
	var bl= false;
	var tryNum = 0;
	var timeOut = function(){  //超时函数
		$("#lotteryBtn").rotate({
			angle:0, 
			duration: 10000, 
			animateTo: 2160, //这里是设置请求超时后返回的角度，所以应该还是回到最原始的位置，2160是因为我要让它转6圈，就是360*6得来的
			callback:function(){
				bl=false;
				resultFn(0,'恭喜您抽中公测大礼包');
			}
		}); 
	}; 
	var rotateFunc = function(awards,angle,text){  //awards:奖项，angle:奖项对应的角度
		$('#lotteryBtn').stopRotate();
		$("#lotteryBtn").rotate({
			angle:0, 
			duration: 5000, 
			animateTo: angle+1440, //angle是图片上各奖项对应的角度，1440是我要让指针旋转4圈。所以最后的结束的角度就是这样子^^
			callback:function(){
				bl=false;
				resultFn(awards,text);
			}
		}); 
	};
	
	$("#lotteryBtn").rotate({ 
	   bind: 
		 { 
			click: function(){
				var fans_name = '<?php echo $fans_name;?>';
				$.ajax({
					type:'post',
					url:'<?php echo $this->createUrl('user/ajaxzhuanpan');?>',
					data:{fans_name:fans_name},
					dataType:'json'
				}).done(function(data){
					if(data.s == 'ok'){
						if(data.data.id=='nointeg'){
                    		alert("积分不足");
							return 0;
						}
						if(data.data.id==1){
                        	rotateFunc(1,60,'再接再厉哦！')
                    	}
                    	if(data.data.id==2){
                        	rotateFunc(2,120,'恭喜您抽中100元京东购物卡一张')
                    	}
                    	if(data.data.id==3){
                        	rotateFunc(3,240,'恭喜您抽中30元移动充值卡一张')
                    	}
                    	if(data.data.id==4){
                        	rotateFunc(4,300,'恭喜您抽中电影卷一份')
                    	}
                    	if(data.data.id==5){
                        	rotateFunc(5,360,'恭喜您抽中公测大礼包')
                    	}	
                    	if(data.data.id==6){
                        	rotateFunc(6,420,'恭喜获得ipad mini')
                    	}	
					}
				});
				return 0;
				if(bl){return;}
				if(tryNum>0){
					// alert('你没有抽奖机会了');
					$('.tip3').css({'display':'block'}); 
					return;
				}
				bl = true;
				tryNum++;
				var time = [0,1];
					time = time[Math.floor(Math.random()*time.length)];
				if(time==0){
					timeOut(); //网络超时
				}
				if(time==1){
					var data = [
								1,5,5,4,5,1,4,5,3,3,
								4,4,3,4,4,4,4,4,5,5,
								5,5,5,3,5,5,5,5,5,5,
								5,5,5,5,2,5,5,3,5,5,
								5,5,5,5,5,5,5,5,5,5
								]; //返回的数组
						data = data[Math.floor(Math.random()*data.length)];
					if(data==1){
						rotateFunc(1,60,'再接再厉哦！')
					}
					if(data==2){
						rotateFunc(2,120,'恭喜您抽中300元京东购物卡一张')
					}
					if(data==3){
						rotateFunc(3,240,'恭喜您抽中30元移动充值卡一张')
					}
					if(data==4){
						rotateFunc(4,300,'恭喜您抽中电影卷一份')
					}
					if(data==5){
						rotateFunc(5,360,'恭喜您抽中公测大礼包')
					}
					/*if(data==0){
						var angle = [30,60,90,120,150];
							angle = angle[Math.floor(Math.random()*angle.length)]
						rotateFunc(0,angle,'很遗憾，这次您未抽中奖')
					}*/
				}
			}
		 } 
	   
	});

	// 最终传输的数字结果
	function resultFn(num,text){
		/*	
		0:公测大礼包
		1：再接再厉
		2:300元京东卡
		3:30元移动卡
		4：电影券
		5：公测大礼包
		*/
		// alert(num);
		// tipsFn1(text);
		// alert(num);
		switch(num){
			case 1:
				$('.tip1').css({'display':'block'}); 
				$('.tip1').find('.awardsText').html(text);
				break;
			case 2:
				$('.tip2').find('.atitle').html(text);
				$('.tip2').css({'display':'block'}); 
				break;
			case 3:
				$('.tip2').find('.atitle').html(text);
				$('.tip2').css({'display':'block'}); 			
				break;
			case 4:	
				$('.tip1').css({'display':'block'});
				$('.tip1').find('.awardsText').html(text);
				$('.tip1').find('.awardPWD').html('密码是：');
				break;
			case 5:	
				$('.tip1').css({'display':'block'});
				$('.tip1').find('.awardsText').html(text);
				$('.tip1').find('.awardPWD').html('领取CDK是：');
				break;
			default:
				$('.tip1').css({'display':'block'});
				$('.tip1').find('.awardsText').html(text);
				$('.tip1').find('.awardPWD').html('领取CDK是：');										
				break;
		}

	}


	$('.tipClose').click(function(){
		$('.tips').css({'display':'none'});
	});

	$('.tip3').find('.OK').click(function(){
		$('.tips').css({'display':'none'});
		tryNum=0;
	});




	// 查看获奖记录
	$('.record').click(function(){
		$('.tip4').css({'display':'block'});
	});
})
</script>
</body>
</html>
