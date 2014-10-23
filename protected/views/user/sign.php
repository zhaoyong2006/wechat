<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link href="static/css/style.css" type="text/css" rel="stylesheet">
<title>每日签到</title>
</head>

<body>

<div class="daily">
<?php foreach($news as $k=>$v){?>
<div class="dcon">
	<div class="dpic"><a href="<?php echo $this->createUrl('show/article',array('id'=>$v['id']));?>"><img src="<?php echo $v['extra'];?>"></a></div>
    <div class="dtit"><?php echo $v['title'];?><span class="dtb"><a href="<?php echo $this->createUrl('show/article',array('id'=>$v['id']));?>"><img src="static/images/jbut.png" width="20"></a></span></div>   
</div>
<?php }?>
<div class="dbut">
    <a href="<?php echo $this->createUrl('user/signok',array('fans'=>$fans));?>"><input name="" type="button" value="签到领取10积分" class="dbin"/></a>
</div>

</div>

</body>
</html>

