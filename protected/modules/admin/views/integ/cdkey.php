<div class="page-header">
  <h2>cdkey设置</h2>
</div>
<a href="<?php echo $this->createUrl('integ/addCdkey');?>"><button type="button" class="btn btn-primary">添加礼包类别</button></a><br/><br/>
<table class="table table-striped">
    <tr>
        <td style="display:none;">ID号</td><td>礼包名称</td><td>礼包描述</td><td>task_id</td><td>售价</td><td>来源</td><td>状态</td><td>操作</td>
    </tr>
    <?php foreach($cdkey as $v){?>
    <tr>
        <td style="display:none;"><?php echo $v['id'];?></td>
		<td><?php echo $v['name'];?></td>
		<td><?php echo $v['cdkey_desc'];?></td>
		<td><?php echo $v['task_id'];?></td>
		<td><?php echo $v['cast_integ'];?></td>
		<td><?php if($v['mark'] == '1'){echo "接口获取";}else{echo "后台导入";}?></td>
		<td><?php if($v['status'] == 0){echo "显示";}else{echo "隐藏";}?></td>
		<td>
			<a href="<?php echo $this->createUrl('integ/editCdkey',array('id'=>$v['id']))?>"><button type="button" class="btn btn-primary">修改</button></a>&nbsp;<a href="<?php echo $this->createUrl('integ/delCdkey',array('id'=>$v['id']))?>" onclick="return confirm('确定要删除该礼包吗？')"><button type="button" class="btn btn-danger">删除</button></a>
			<?php if($v['mark'] == 10){?>
			<a href="<?php echo $this->createUrl('integ/libaoAdd',array('id'=>$v['id']));?>">
			<button type="button" class="btn btn-danger">导入</button>
			</a>
			<a href="<?php echo $this->createUrl('integ/libaoList',array('id'=>$v['id']));?>">
			<button type="button" class="btn btn-danger">查看</button>
			</a>	
			<?php }?>
		</td>
    </tr>
    <?php }?>
</table>
