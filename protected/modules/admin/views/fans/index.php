<?php
	/*foreach($fans as $k=>$v){
		echo $k."--".$v['fans_name']."<br/>";
	}*/
?>
<div class="page-header">
  <h2>会员列表</h2>
</div>
<table class="table table-striped">
    <tr>
		<td>序号</td><td>微信key</td><td>积分</td><td>最后签到时间</td><td>操作</td>
	</tr>
	<?php foreach($fans as $v){?>
	<tr>
		<td><?php echo $v['id'];?></td>
		<td><?php echo $v['fans_name'];?></td>
		<td><?php echo $v['integral'];?></td>
		<td><?php echo date("Y-m-d H:i:s",$v['integ_time']);?></td>
		<td style="width:230px;">
			<a href="javascript:jifen(<?php echo $v['id'];?>);"><button type="button" class="btn btn-primary">修改积分</button></a>&nbsp;
			<a href="<?php echo $this->createUrl('fans/edit',array('id'=>$v['id']))?>"><button type="button" class="btn btn-primary">修改</button></a>&nbsp;
			<a href="<?php echo $this->createUrl('fans/delete',array('id'=>$v['id']))?>"><button type="button" class="btn btn-danger">删除</button></a></td>
	</tr>
	<?php }?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
     <form action="<?php echo $this->createUrl("fans/updateInteg");?>" method="post"> 
	 <div class="modal-body">
	    <table class="table table-bordered">
    		<tr>
        		<td class="col-sm-2">用户标识</td>
       			<td id="fans_name">
        		</td>
    		</tr>
    		<tr>
        		<td>积分</td>
        		<td>
            		<div class="col-xs-8">
					<input type="hidden" id="fans_id" name="fans_id" value="" />
            		<input class="form-control" type="text" name="integ" id="integ"/>
            		</div>
        		</td>
    		</tr>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	 </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	function jifen(id){
		$.ajax({
			type:'get',
			url:'<?php echo $this->createUrl('fans/integ');?>',
			data:{id:id},
			dataType:'json'
		}).done(function(data){
			if(data.s == 'ok'){
				$('#fans_name').html(data.name);
				$('#fans_id').val(id);
				$('#integ').val(data.integ);
				$('#myModal').modal();
			}	
			}
		);
	}
</script>

