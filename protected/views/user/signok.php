<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link href="static/css/style.css" type="text/css" rel="stylesheet">
<title>每日签到详情</title>
</head>

<body>
<div class="qdtop">
	<div class="qdtx"><img src="static/images/tx01.png" width="70"></div>
    <div class="qdwz"><h1><?php echo $mess;?></h1><h2><a href="<?php echo $this->createUrl('user/more');?>">了解更多 >></a></h2></div>
</div>

<div class="jftop">
	<div class="ina qd">
    	<div class="inal">
        	<img src="static/images/wxtb.png" width="30">会员信息
        </div>
        <div class="inar"><img src="static/images/jbuta.png" width="30"></div>
    </div>
    <div class="inb">
    	<img src="static/images/jttb.png">会员等级：<?php echo $grade;?>
    </div>
    <div class="inb inbline">
    	<img src="static/images/jttb.png">当前积分：<?php echo $integ;?>
<a href="<?php echo $this->createUrl('user/libao',array('fans'=>$fans));?>"><input name="" type="button" value="继续兑换" class="inbut"/></a>
    </div>
</div>


</body>
</html>

