<div class="page-header">
  <h2>修改新闻类型</h2>
</div>
<form action="<?php echo $this->createUrl('news/doEditType')?>" method="post">
<table class="table table-bordered">
	<tr>
		<td class="col-sm-2">新闻类型名称</td>
		<td>
		<div class="col-xs-3">
			<input type="hidden" name="id" value="<?php echo $type['id'];?>" />
			<input type="text" class="form-control" name="name" value="<?php echo $type['name'];?>"/>
		</div>
		</td>
	</tr>
	<tr>
		<td>新闻类型描述</td>
		<td>
			<div class="col-xs-8">
			<input class="form-control" type="text" name="type_desc" value="<?php echo $type['type_desc'];?>"/>
			</div>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" class="btn btn-primary" value="修改"/>
		</td>
	</tr>
</table>
</form>
