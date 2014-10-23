<?php
	if($news['url'] != ""){
		header("Location:".$news['url']);exit;
	}
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<link href="static/css/style.css" type="text/css" rel="stylesheet">
<title><?php echo $news['title'];?></title>
</head>

<body>

<div class="article">
<div class="wztit"><span>乱世曲＞<?php echo $news['title'];?></span></div>

<div class="wzbt">
	<h1><?php echo $news['title'];?></h1>
    <h2><?php echo date("Y/m/d H:i:s",$news['time']); ?></h2>
    <div class="wnr"><?php echo $news['content'];?></div>
    <div class="wnrf">
<img alt="" data-cke-saved-src="<?php echo Yii::app()->request->baseUrl; ?>/static/images/115732ga98jambjzvt    kjh0.gif" src="<?php echo Yii::app()->request->baseUrl; ?>/static/images/115732ga98jambjzvtkjh0.gif" style="width: 300px; he    ight: 18px;"></p><p><span style="background-color: rgb(175, 238, 238);">关注乱世曲官方微信</span><br><span style="background    -color: rgb(175, 238, 238);">&gt;&gt;搜索微信号→</span><span style="color: rgb(255, 0, 0);"><span style="background-color: r    gb(175, 238, 238);">乱世曲</span></span></div>
</div>

</div>

</body>
</html>

