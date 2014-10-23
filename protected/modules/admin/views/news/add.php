<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="page-header">
  <h2>添加文章</h2>
</div>
<form enctype="multipart/form-data" action="<?php echo $this->createUrl('news/doAdd')?>" method="post">
<table class="table table-bordered">
<tr>
<td colspan='2'>
<div class="form-group input-group-lg">
    <input type="text" class="form-control" id="title" name="title" placeholder="请输入文章标题"/>
</div>
</td>
</tr>
<tr>
<td width="270px">请选择新闻图片(微信推送新闻时显示):</td>
<td>
<div class="form-group">
    <input type="file" name="w_pic" />
</div>
</td>
</tr>
<tr>
<tr>
<td>排列顺序(数字越大越靠前):</td>
<td><div class="col-xs-3"><input type="number" class="form-control"  name="mark"/></div></td>
</tr>
<tr>
<td>自定义链接</td>
<td><div class="col-xs-9"><input type="text" class="form-control" id="url" name="url"/></div></td>
</tr>
<tr>
<td colspan='2'>
<div class="col-md-10">
<script id="editor" name="myContent" type="text/plain" style="width:924px;height:500px;"></script>
</div>
</td>
</tr>
<tr>
<td align='center'>选择文章分类</td>
<td>
<div class="col-md-10" style="margin-top:20px;">
<div class="form-group col-md-4">
	<select class="form-control" name="type"> 
  		<option value="0">选择文章分类</option>
  		<?php foreach($type as $v){?>
		<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
		<?php }?>
	</select> 
</div>
</div>
</td>
</tr>
<tr>
<td colspan='2'>
<div class="col-md-10">
<p>
<button type="submit" class="btn btn-primary btn-lg">添加</button>
</p>
</div>
</td>
</tr>
</table>
</form>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    UE.getEditor('editor');
</script>
