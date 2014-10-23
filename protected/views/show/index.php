<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="viewport" content="width=device-width, minimumscale=1.0, maximum-scale=1.0,user-scalable=no">
<meta name="description" content="玩蟹游戏">
<meta name="keywords" content="玩蟹游戏">
<script type="text/javascript" src="static/js/jquery1.71.js"></script>
<script type="text/javascript" src="static/js/public.js"></script>
<script type="text/javascript" src="static/js/intelligent-1.0.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="static/js/html5.js"></script>
<![endif]--> 
<link id="pc_css" rel="stylesheet" type="text/css" href="static/css/common.css" mobile="static/css/mobile.css">
<title>玩蟹游戏</title>
<style>#haloword-pron { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -34px; }#haloword-pron:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -34px; }#haloword-open { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -17px; }#haloword-open:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -17px; }#haloword-close { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px 0; }#haloword-close:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px 0; }#haloword-add { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -51px; }#haloword-add:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -51px; }#haloword-remove { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -68px; }#haloword-remove:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -68px; }</style></head>
<body tw="640">
<div class="loading"></div>

<section class="web_head_top_wrap autoPadding">
    <h2 class="web_headline_img"><img src="static/images/web_head_title_img02.png"></h2>
    <hgroup class="web_head_title_wrap autoPadding">
        <h3 class="head_headline autoFontSize">《乱世曲》攻略站</h3>
        <h4 class="head_subtitle autoFontSize">打造最权威的官方资料站</h4>
    </hgroup>
</section>
<?php
    $i = 1;
    foreach($type as $k=>$v){
?>
     <div class="public_border_style autoMargin">
        <div class="public_sort_title_box public_sort_title_boxList" style="cursor: pointer; background-image:url(static/images/tou<?php echo $i;?>.png);" imgsrc=url(static/images/tou<?php echo $i;?>.png)>
        <strong class="sort_title_font autoHeight autoLineHeight autoFontSize"><?php echo $v['name'];?></strong>
        </div>
    <div class="raiders_sort_box" style="display: none;">
    <?php foreach($news[$v['id']] as $new){?>
          <div class="sort_next_menu">
          <a class="sort_title_font" href="index.php?r=show/article&id=<?php echo $new['id'];?>" title="<?php echo $new['title'];?>"><?php echo $new['title'];?></a>
          </div>
    <?php }?>
        <div class="sort_next_menu">
        <a class="sort_title_font" href="index.php?r=show/list&id=<?php echo $v['id'];?>" title="查看更多">查看更多</a>
        </div>
    </div>
</div>
<?php $i++; }?>


<script type="text/javascript" src="static/js/include.js"></script>

</body></html>
