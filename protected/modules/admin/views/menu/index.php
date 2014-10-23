<h1>自定义菜单</h1><hr/>
<div class="col-md-6">
<form action="<?php echo $this->createUrl("menu/create_menu");?>" method="post">
AppID:<input type="text" class="form-control" name="appid" /><br/>
AppSecret:<input type="text" class="form-control" name="appsecret"/><br/>
<button type="submit">提交更改</button>
</form>
</div>
