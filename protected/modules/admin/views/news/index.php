<div class="page-header">
  <h2>新闻列表</h2>
</div>
<table class="table table-striped">
    <tr>
		<td>序号</td><td>标题</td><td>所属分类</td><td>发布时间</td><td>排列顺序(数字大的靠前)</td><td>操作</td>
	</tr>
	<?php foreach($news as $v){?>
	<tr>
		<td><?php echo $v['id'];?></td>
		<td><?php echo $v['title'];?></td>
		<td><?php echo $v['name'];?></td>
		<td><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
		<td><?php echo $v['mark'];?></td>
		<td><a href="<?php echo $this->createUrl('news/editNews',array('id'=>$v['id']))?>"><button type="button" class="btn btn-primary">修改</button></a>&nbsp;<a href="<?php echo $this->createUrl('news/delNews',array('id'=>$v['id']))?>" onclick="return confirm('确定要删除吗？')"><button type="button" class="btn btn-danger">删除</button></a></td>
	</tr>
	<?php }?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
