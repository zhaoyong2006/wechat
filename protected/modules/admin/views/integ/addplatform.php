<div class="page-header">
  <h2>添加平台</h2>
</div>
<form action="<?php echo $this->createUrl('integ/doAddPlatform')?>" method="post">
<table class="table table-bordered">
    <tr>
        <td class="col-sm-2">平台标识</td>
        <td>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="pkey"/>
        </div>
        </td>
    </tr>
    <tr>
        <td>平台名称</td>
        <td>
            <div class="col-xs-3">
            <input class="form-control" type="text" name="pname"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>平台api链接</td>
        <td>
            <div class="col-xs-8">
            <input class="form-control" type="text" name="api_url"/>
            </div>
        </td>
    </tr>
	<tr>
        <td>序号</td>
        <td>
            <div class="col-xs-3">
            <input class="form-control" type="text" name="mark"/>
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
