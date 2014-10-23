<div class="page-header">
  <h2>实物获奖列表</h2>
</div>
<table class="table table-striped">
<tr>
	<th>ID</th><th>记录id</th><th>用户key</th><th>收货人</th><th>收货地址</th><th>电话</th><th>时间</th><th>状态</th>
</tr>
<?php 
foreach($shiwu as $k=>$v){
	echo "<tr>";
	echo "<td>".$v['id']."</td><td>".$v['log_id']."</td><td>".$v['fans_name']."</td><td>".$v['consignee']."</td><td>".$v['address']."</td><td>".$v['phone']."</td><td>".date("Y-m-d H:i:s",$v['time'])."</td><td>".$v['status']."</td>";
	echo "</tr>";
}
?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
