<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link href="static/css/style.css" type="text/css" rel="stylesheet">
<title>积分兑换</title>
</head>

<body>

<div class="more">

<?php
foreach($cdkey as $v){
?>

<div class="i_c"> 
<div class="b_05"></div><div class="b_04"></div> <div class="b_03"></div> <div class="b_02"></div> 
<div class="i_cont bj">
    <div class="lpic"><img src="static/images/dj01.jpg" width="120"></div>
    <div class="rcon">
    	<h1><?php echo $v->attributes['cdkey_desc'];?></h1>
        <h2><?php echo $v->attributes['cast_integ'];?>积分</h2>
        <a href="<?php echo $this->createUrl('user/libao_re',array('id'=>$v->attributes['id'],'fans' => $fans));?>"><input name="" type="button" value="兑换" class="dhbut"/></a>
    </div>
</div>
</div>	

<?php
}
?>


</div>

</body>
</html>

