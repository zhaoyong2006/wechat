<div class="page-header">
  <h2>修改礼包</h2>
</div>
<form action="<?php echo $this->createUrl('integ/doEditCdkey')?>" method="post">
<table class="table table-bordered">
    <tr>
        <td class="col-sm-2">礼包名称</td>
        <td>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="name" value="<?php echo $cdkey['name'];?>"/>
        </div>
        </td>
    </tr>
    <tr>
        <td>礼包描述</td>
        <td>
            <div class="col-xs-8">
            <input class="form-control" type="text" name="cdkey_desc" value="<?php echo $cdkey['cdkey_desc'];?>"/>
            </div>
        </td>
    </tr>
    <tr>
        <td>task_id</td>
        <td>
            <div class="col-xs-8">
            <input class="form-control" type="text" name="task_id" value="<?php echo $cdkey['task_id'];?>"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>售价</td>
        <td>
            <div class="col-xs-3">
            <input class="form-control" type="text" name="cast_integ" value="<?php echo $cdkey['cast_integ'];?>"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>来源</td>
        <td>
            <div class="col-xs-3">
            <select class="form-control" name="mark">
				<option value="1" <?php if($cdkey['mark'] == 1){ echo "selected";}?>>接口获取</option>
				<option value="10" <?php if($cdkey['mark'] == 10){ echo "selected";}?>>后台导入</option>
			</select>
            </div>
        </td>
    </tr>
	<tr>
		<td>状态</td>
		<td>
			<div class="col-xs-2">
			<select class="form-control" name="status">
				<option value="0" <?php if($cdkey['status'] == 0){ echo "selected";}?>>显示</option>
				<option value="1" <?php if($cdkey['status'] == 1){ echo "selected";}?>>隐藏</option>
			</select>
			</div>
		</td>
	</tr>
    <tr>
        <td></td>
        <td>	
			<input type="hidden" name="id" value="<?php echo $cdkey['id'];?>"/>
            <input type="submit" class="btn btn-primary" value="修改"/>
        </td>
    </tr>
</table>
</form>
