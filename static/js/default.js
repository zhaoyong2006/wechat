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
				$.ajax({
					type:'post',
					url:'<?php $this->createUrl('user/ajaxzhuanpan')?>',
					data:{fans_name:<?php echo $fans_name;?>},
					dataType:'json'
				}).done(function(data){

				});
	
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

