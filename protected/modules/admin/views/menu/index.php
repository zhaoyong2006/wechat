<h1>自定义菜单<?php echo Yii::app()->user->getName();?></h1><hr/>
<div class="col-md-6">
<form action="<?php echo $this->createUrl("menu/create_menu");?>" method="post">
AppID:<input type="text" id="appid" class="form-control" name="appid" value="<?php echo empty($appId)?'1':$appId; ?>"/><br/>
AppSecret:<input type="text" id="appsecret" class="form-control" name="appsecret" value="<?php echo empty($appSecret)?'':$appSecret;?>"/><br/>
<button type="button" id="key_submit">提交更改</button>
</form>
</div>
<div class="col-md-6">
<p>
</p>
</div>
<script type="text/javascript">
$("#key_submit").click(function(ev){
	var appid = $("#appid").val();
	var appsecret = $("#appsecret").val();
	var data = {
		'appid':appid,
		'appsecret':appsecret,
	};
	$.post('<?php echo $this->createUrl('menu/ajax_save_key')?>',data,function(ret){
		if(ret.s == 0){
			show_message(200,ret.msg);
		}else{
			show_message(400,ret.msg);
		}
	},'json');
});
</script>
