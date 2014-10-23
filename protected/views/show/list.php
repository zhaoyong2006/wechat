<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0,user-scalable=no">
<meta name="description" content="玩蟹游戏">
<meta name="keywords" content="玩蟹游戏">
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>static/js/jquery1.71.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>static/js/public.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>static/js/intelligent-1.0.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>static/js/html5.js"></script>
<![endif]--> 
<link id="pc_css" rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>static/css/common.css" mobile="<?php echo Yii::app()->request->baseUrl; ?>static/css/mobile.css">
<title>玩蟹游戏</title>
<style>#haloword-pron { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -34px; }#haloword-pron:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -34px; }#haloword-open { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -17px; }#haloword-open:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -17px; }#haloword-close { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px 0; }#haloword-close:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px 0; }#haloword-add { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -51px; }#haloword-add:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -51px; }#haloword-remove { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -68px; }#haloword-remove:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -68px; }</style></head>
<body tw="640">
<div class="loading"></div>

<header class="guide_title_box autoHeight autoLineHeight">玩蟹游戏官网微信</header>
<div class="guide_position_box autoFontSize autoList (guide_position_box*a+ah+alh)">
	 <a class="home" href="#" title="最新资讯">最新资讯</a>
	<a class="guide_pic">&gt;</a>
	<a title="更多">更多</a>
</div>

<div class="guide_list_box">
	<ul id="morelist" class="autoFontSize autoLineHeight">
		<?php foreach($list as $v){?>
        <li>
            <a href="index.php?r=show/article&id=<?php echo $v['id'];?>" title="<?php echo $v['title'];?>">
        	    <span class="link_a"><?php echo $v['title'];?></span>
                <span class="data_time"><?php echo date("Y-m-d",$v['time']);?></span>
            </a>
        </li>
		<?php }?>
    </ul>
    <div class="ajax_loadings" style="display: none;"><img src="./list_files/loading.gif"></div>
</div>


<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>static/js/include.js"></script>

</body></html>
