<div class="page-header">
  <h2>观影券列表</h2>
</div>
<table class="table table-striped">
<tr>
	<th>ID</th><th>礼包key</th><th>对应cdkey</th><th>状态</th>
</tr>
<?php 
foreach($libao as $k=>$v){
	if($v['status'] == '0'){
		$status = "<span style='color:green;'>未使用</span>";
	}elseif($v['status'] == '1'){
		$status = "<span style='color:red;'>已使用</span>";
	}
	echo "<tr>";
	echo "<td>".$v['id']."</td><td>".$v['libao']."</td><td>".$v['cdkey_id']."</td><td>".$status."</td>";
	echo "</tr>";
}
?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
