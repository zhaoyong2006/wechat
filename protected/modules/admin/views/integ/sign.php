<link href="dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="dist/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<div class="page-header">
  <h2>每日签到</h2>
</div>
<div class="container">
<form action="<?php echo $this->createUrl('integ/sign');?>" method="post" class="form-horizontal"  role="form">
        <fieldset>
            <legend>签到查询</legend>
			<div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">开始时间</label>
                <div class="input-group date form_date col-md-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				<input class="form-control" size="16" type="text" value="<?php echo $start_date;?>" name="start_time" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
			</div>
			<div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">结束时间</label>
                <div class="input-group date form_date col-md-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				<input class="form-control" size="16" type="text" value="<?php echo $end_date;?>" name="end_time" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
			<div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label">签到人</label>
				<div class="input-group col-md-3">
				<input class="form-control" type="text" name="fans_name" value="<?php echo $fans_name;?>"/>
				</div>			
			</div>
			<div class="form-group">
                <label for="dtp_input2" class="col-md-2 control-label"> </label>
				<div class="input-group col-md-3">
					<input type="submit" class="btn btn-primary" value="提交"/>
				</div>
			</div>
        </fieldset>
    </form>
</div>
<?php 
echo "<pre>总数:";
echo $pages->getItemCount();
echo "</pre>";
?>
<table class="table table-striped">
    <tr>
        <td>ID</td><td>签到人</td><td>获得积分</td><td>签到时间</td>
    </tr>
    <?php foreach($log as $v){?>
    <tr>
        <td><?php echo $v['id'];?></td>
        <td><?php echo $v['fans_name'];?></td>
        <td><?php echo $v['integral'];?></td>
        <td><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
     </tr>
    <?php }?>
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages));?>
<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="dist/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>

<script type="text/javascript">
	$('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
