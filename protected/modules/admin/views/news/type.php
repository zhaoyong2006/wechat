<div class="page-header">
  <h2>新闻类型</h2>
</div>
<a href="<?php echo $this->createUrl('news/addType');?>"><button type="button" class="btn btn-primary">添加类型</button></a><br/><br/>
<table class="table table-striped">
	<tr>
		<td>编号</td><td>类型名称</td><td>类型描述</td><td>操作</td>
	</tr>
	<?php foreach($type as $v){?>
	<tr>
		<td><?php echo $v['id'];?></td>
		<td><?php echo $v['name'];?></td>
		<td><?php echo $v['type_desc'];?></td>
		<td><a href="<?php echo $this->createUrl('news/editType',array('id'=>$v['id']))?>"><button type="button" class="btn btn-primary">修改</button></a>&nbsp;<a href="<?php echo $this->createUrl('news/delType',array('id'=>$v['id']))?>" onclick="return confirm('确定要删除吗？')"><button type="button" class="btn btn-danger">删除</button></a></td>
	</tr>
	<?php }?>
</table>
