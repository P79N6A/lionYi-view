<div class="layui-upload">
	  <button type="button" class="btn btn-w-m btn-success btn-sm bear-upload" id="btn-{{<$form.field>}}" lay-data="" data-field='{{<$form.field>}}'>{{<$form.title>}}</button>
	  <div class="layui-upload-list">
	    <img class="layui-upload-img bear-up-img" id="upimg-img-{{<$form.field>}}" src="{{<$form.default.file|default:'http://bear.jerryblog.cn/bear/images/notfind.png'>}}">
	    <input type="hidden" name="{{<$form.field>}}" id="upimg-input-{{<$form.field>}}" value="{{<$form.default.input|default:'0'>}}" style='display:none'>
	    <p id="upimg-text-{{<$form.field>}}"></p>
	  </div>
	</div>