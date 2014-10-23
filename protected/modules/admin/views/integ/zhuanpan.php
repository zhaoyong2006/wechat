<div class="page-header">
  <h2>大转盘记录列表</h2>
</div>
<a href="<?php echo $this->createUrl("integ/shiwu");?>">
<button type="button" class="btn btn-primary">获取实物奖励列表</button>
</a><br/><br/>
<table class="table table-striped">
<tr>
	<th>ID</th><th>用户key</th><th>获得奖品</th><th>奖品类型</th><th>消耗积分</th><th>时间</th>
</tr>
<?php 
foreach($zhuanpan as $k=>$v){
	if($v['jiangpin_type'] == '4'){
		$type = "<span style='color:red;'>未获奖</span>";
	}elseif($v['jiangpin_type'] == '3'){
		$type = "<span style='color:yellow;'>cdkey</span>";
	}elseif($v['jiangpin_type'] == '2'){
		$type = "<span style='color:green;'>实物</span>";	
	}else{
		$type = "<span>未知</span>";	
	}
	echo "<tr>";
	echo "<td>".$v['id']."</td><td>".$v['fans_name']."</td><td>".$v['jiangpin']."</td><td>".$type."</td><td>".$v['cast_integ']."</td><td>".date("Y-m-d H:i:s",$v['time'])."</td>";
	echo "</tr>";
}
?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
