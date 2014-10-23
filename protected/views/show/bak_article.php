<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0,user-scalable=no">
<meta name="description" content="玩蟹科技">
<meta name="keywords" content="玩蟹科技">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/jquery1.71.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/public.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/intelligent-1.0.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>static/js/html5.js"></script>
<![endif]-->
<link id="pc_css" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/static/css/common.css?v=2" mobile="<?php echo Yii::app()->request->baseUrl; ?>/static/css/mobile.css?v=1">
<title>玩蟹科技</title>
<style>#haloword-pron { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -34px; }#haloword-pron:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -34px; }#haloword-open { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -17px; }#haloword-open:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -17px; }#haloword-close { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px 0; }#haloword-close:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px 0; }#haloword-add { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -51px; }#haloword-add:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -51px; }#haloword-remove { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -68px; }#haloword-remove:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -68px; }</style></head>
<body tw="640">
<div class="loading"></div>


<div class="guide_position_box autoFontSize autoList (guide_position_box*a+ah+alh)">

    <a class="home" href="index.php?r=show/list&id=1" title="最新资讯">最新资讯</a>
    <a class="guide_pic">&gt;</a>
    <a title="<?php echo $news['title'];?>"><?php echo $news['title'];?></a>

	
</div>

<div class="content_wrap">
	<div class="content_box">
    	<h1 class="content_title autoFontSize autoPadding"><?php echo $news['title'];?></h1>
        <h2 class="content_subtitle autoFontSize autoPadding"><time><?php echo date("Y-m-d H:i:s",$news['time']);?></time>乱世曲</h2>
        <div class="content_contain_box autoFontSize autoLineHeight">
        	
             <p>
				<?php echo $news['content'];?>
             <p><img alt="" data-cke-saved-src="<?php echo Yii::app()->request->baseUrl; ?>/static/images/115732ga98jambjzvtkjh0.gif" src="<?php echo Yii::app()->request->baseUrl; ?>/static/images/115732ga98jambjzvtkjh0.gif" style="width: 360px; height: 18px;"></p><p><span style="background-color: rgb(175, 238, 238);">关注乱世曲官方微信</span><br><span style="background-color: rgb(175, 238, 238);">&gt;&gt;搜索微信号→</span><span style="color: rgb(255, 0, 0);"><span style="background-color: rgb(175, 238, 238);">乱世曲</span></span></p><p><br></p><p><br></p>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/include.js"></script>


</body></html>
