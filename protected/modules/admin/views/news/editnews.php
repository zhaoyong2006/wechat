<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/dist/ueditor/lang/zh-cn/zh-cn.js"></script>
<div class="page-header">
  <h2>添加文章</h2>
</div>
<form enctype="multipart/form-data" action="<?php echo $this->createUrl('news/doEditNews')?>" method="post">
<table class="table table-bordered">
<tr>
<td colspan='2'>
<div class="form-group input-group-lg">
    <input type="text" class="form-control" id="title" name="title" placeholder="请输入文章标题" value="<?php echo $news['title'];?>"/>
</div>
</td>
</tr>
<tr>
<td width="270px">请选择新闻图片(微信推送新闻时显示):</td>
<td>
<div class="form-group">
	<input type="file" name="w_pic" value=""/>
	<img src="<?php echo $news['extra'];?>" />
</div>
</td>
</tr>
<tr>
<td>排列顺序(数字越大越靠前):</td>
<td><div class="col-xs-3"><input type="number" class="form-control"  name="mark" value="<?php echo $news['mark'];?>"/></div></td>
</tr>
<tr>
<td>自定义链接</td>
<td><div class="col-xs-9"><input type="text" class="form-control" id="url" name="url" value="<?php echo $news['url'];?>"></div></td>
</tr>
<tr>
<td colspan="2">
<div class="col-md-10">
<script id="editor" name="myContent" type="text/plain" style="width:924px;height:500px;">
<?php echo $news['content'];?>
</script>
</div>
</td>
</tr>
<tr>
<td align="center">选择文章分类</td>
<td>
<div class="col-md-10" style="margin-top:20px;">
<div class="form-group col-md-4">
	<select class="form-control" name="type"> 
  		<option value="0">选择文章分类</option>
  		<?php foreach($type as $v){?>
		<option value="<?php echo $v['id'];?>" <?php if($v['id'] == $news['type']){ echo "selected";}?>><?php echo $v['name'];?></option>
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
<input type="hidden" name="id" value="<?php echo $news['id'];?>"/>
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
