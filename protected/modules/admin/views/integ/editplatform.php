<div class="page-header">
  <h2>修改平台信息</h2>
</div>
<form action="<?php echo $this->createUrl('integ/doEditPlatform')?>" method="post">
<table class="table table-bordered">
    <tr>
        <td class="col-sm-2">平台标识</td>
        <td>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="pkey" value="<?php echo $platform['pkey'];?>"/>
        </div>
        </td>
    </tr>
    <tr>
        <td>平台名称</td>
        <td>
            <div class="col-xs-3">
            <input class="form-control" type="text" name="pname" value="<?php echo $platform['pname'];?>"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>平台api链接</td>
        <td>
            <div class="col-xs-8">
            <input class="form-control" type="text" name="api_url" value="<?php echo $platform['api_url'];?>"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>序号</td>
        <td>
            <div class="col-xs-3">
            <input class="form-control" type="text" name="mark" value="<?php echo $platform['mark'];?>"/>
            </div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
			<input type="hidden" name="id" value="<?php echo $platform["id"];?>">
            <input type="submit" class="btn btn-primary" value="创建"/>
        </td>
    </tr>
</table>
</form>
