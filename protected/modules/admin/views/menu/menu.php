<script type="text/javascript" src="/static/js/bootstrap-tagsinput.min.js"></script>
<style>
.bootstrap-tagsinput {
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  display: inline-block;
  padding: 4px 6px;
  margin-bottom: 10px;
  color: #555;
  vertical-align: middle;
  border-radius: 4px;
  max-width: 100%;
  width:500px;
  line-height: 22px;
}
.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0;
  margin: 0;
  width: 100% !important;
  max-width: inherit;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: white;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
</style>
<div>
<pre>
<?php print_r($wx_menu);?>
</pre>
</div>
<div class="form-group">
                    <label for="title" class="col-xs-2 control-label">标签：</label>
                    <div class="col-xs-8">
                        <input type="text" data-role="tagsinput"  class="form-control form-input input-xlarge" placeholder="请填写标签，按回车添加" id="tags"  name="tags" value="<?php //echo $knowledgeInfo['tags'];?>" check-type="required" required-message="请填写标签，按回车添加"/>
                    </div>
                </div>
