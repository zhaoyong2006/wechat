<DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link href="static/css/style.css" type="text/css" rel="stylesheet">
<title>兑换积分</title>
</head>

<body>

<div class="jftop">
	<div class="ina">
    	<div class="inal">
        	<img src="static/images/jftb01.png" width="30">此次兑换
        </div>
        <div class="inar"><img src="static/images/jbuta.png" width="30"></div>
    </div>
    <div class="inb">
        <img src="static/images/jttb.png">
    <?php
        if($s == 'ok'){
            echo "兑换码:".$msg;
        }else{
            echo $msg;
        }
    ?>
    </div>
    <div class="inb inbline">
    <img src="static/images/jttb.png">剩余积分：<?php echo $integral;?>
        <a href="<?php echo $this->createUrl('user/libao',array('fans'=>$fans))?>"><input name="" type="button" value="继续兑换" class="inbut"/></a>
    </div>
    <div class="inc">
        <span>登录乱世曲,在"设置-ukey"中输入兑换码可兑换</span>
    </div>
</div>

<div class="i_c"> 
<div class="b_05"></div><div class="b_04"></div> <div class="b_03"></div> <div class="b_02"></div> 
<div class="i_cont bj">
    <div class="jftit">
    	<div class="inal" style="margin:0;">
        	<img src="static/images/jftb02.png" width="30">兑换历史
        </div>        
    </div>
    <div class="jfls">
        <ul>
        <?php
            foreach($cdkey_log as $k=>$v){
            echo "<li>".date("Y-m-d H:i:s",$v->time)."<br/>兑换码:".$v->cdkey."</li>";
            }
        ?>
        </ul>
    </div>
</div>
</div>

</body>
</html>


