<DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link href="static/css/style.css" type="text/css" rel="stylesheet">
<title>了解更多</title>
</head>

<body>

<div class="more">

<div class="i_c"> 
<div class="b_05"></div><div class="b_04"></div> <div class="b_03"></div> <div class="b_02"></div> 
<div class="i_cont bj">
    <div class="jftit">
    	<div class="inal" style="margin:0;">
        	<img src="static/images/wxtb.png" width="30">微信会员
        </div>        
    </div>
    <div class="mwz">
会员文字说明，包含积分兑换，如何获得，微信会员
福利等最详尽的说明
会员文字说明，包含积分兑换，如何获得，微信会员
福利等最详尽的说明
    </div>
</div>
</div>	

<div class="i_c"> 
<div class="b_05"></div><div class="b_04"></div> <div class="b_03"></div> <div class="b_02"></div> 
<div class="i_cont bj">
    <div class="jftit">
    	<div class="inal" style="margin:0;">
        	<img src="static/images/wxtb.png" width="30">会员等级
        </div>        
    </div>
    <div class="mwz">
		<ul style="margin-left:10%;">
        	<li><span>等级</span></li>
<?php
	foreach($vip as $k=>$v){
		echo "<li>".$v['grade']."</li>";
	}			
?>
        </ul>
        <ul>
        	<li><span>积分</span></li>
<?php
	foreach($vip as $k=>$v){
		echo "<li>".$v['integ']."</li>";
	}
?>
        </ul>
    </div>
</div>
</div>	

</div>

</body>
</html>


