<div class="page-header">
  <h2>平台设置</h2>
</div>
<a href="<?php echo $this->createUrl('integ/addPlatform');?>"><button type="button" class="btn btn-primary">添加平台</button></a><br/><br/>
<table class="table table-striped">
    <tr>
        <td style="display:none;">ID号</td><td>平台标识</td><td>平台名称</td><td>API接口</td><td>序号</td><td>操作</td>
    </tr>
    <?php foreach($platform as $v){?>
    <tr>
        <td style="display:none;"><?php echo $v['id'];?></td>
		<td><?php echo $v['pkey'];?></td>
		<td><?php echo $v['pname'];?></td>
		<td><?php echo $v['api_url'];?></td>
		<td><?php echo $v['mark'];?></td>
   		<td><a href="<?php echo $this->createUrl('integ/editPlatform',array('id'=>$v['id']))?>"><button type="button" class="btn btn-primary">修改</button></a>&nbsp;<a href="<?php echo $this->createUrl('integ/delPlatform',array('id'=>$v['id']))?>"><button type="button" class="btn btn-danger">删除</button></a></td>
	 </tr>
    <?php }?>
</table>
