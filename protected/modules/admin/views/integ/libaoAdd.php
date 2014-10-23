<h1>导入礼包</h1>
请录入观影券，每行一个<br/>
<form action="<?php echo $this->createUrl("integ/libaoAddOk")?>" method="post">
<div class="col-md-8">
<textarea name="libao" class="form-control" rows="20"></textarea>
<input type="hidden" name="cdkey_id" value="<?php echo $id;?>"/>
</div>
<div class="col-md-10">
<br/>
<button>提交</button>
</form>
</div>
