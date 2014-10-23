<div class="page-header">
  <h2>礼包兑换记录</h2>
</div>
<table class="table table-striped">
    <tr>
        <td>ID<td>兑换人</td><td>礼包名称</td><td>cdkey</td><td>发送时间</td><td>发送状态</td>
    </tr>
    <?php foreach($log as $v){?>
    <tr>
        <td><?php echo $v['id'];?></td>
        <td><?php echo $v['fans_name'];?></td>
        <td><?php echo $v['cdkey_type'];?></td>
		<td><?php echo $v['cdkey'];?></td>
		<td><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
        <td><?php if($v['status'] == 1){ echo "<span style='color:green;'>成功</span>";}else{ echo "<span style='color:red;'>失败</span>";}?></td>
     </tr>
    <?php }?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
