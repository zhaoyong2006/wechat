<div class="page-header">
  <h2>添加礼包</h2>
</div>
<form action="<?php echo $this->createUrl('integ/doAddCdkey')?>" method="post">
<table class="table table-bordered">
    <tr>
        <td class="col-sm-2">礼包名称</td>
        <td>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="name"/>
        </div>
        </td>
    </tr>
    <tr>
        <td>礼包描述</td>
        <td>
            <div class="col-xs-8">
            <input class="form-control" type="text" name="cdkey_desc"/>
            </div>
        </td>
    </tr>
    <tr>
        <td>task_id</td>
        <td>
            <div class="col-xs-8">
            <input class="form-control" type="text" name="task_id"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>售价</td>
        <td>
            <div class="col-xs-3">
            <input class="form-control" type="text" name="cast_integ"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>来源</td>
        <td>
            <div class="col-xs-3">
            <select class="form-control" name="mark">
				<option value="1">接口获取</option>
				<option value="10">后台导入</option>
			</select>
            </div>
        </td>
    </tr>
	<tr>
		<td>状态</td>
		<td>
			<div class="col-xs-2">
			<select class="form-control" name="status">
				<option value="0">显示</option>
				<option value="1">隐藏</option>
			</select>
			</div>
		</td>
	</tr>
    <tr>
        <td></td>
        <td>
            <input type="submit" class="btn btn-primary" value="创建"/>
        </td>
    </tr>
</table>
</form>
