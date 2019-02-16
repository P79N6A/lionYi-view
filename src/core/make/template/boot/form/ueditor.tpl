<script id="{{<$form.field>}}" type="text/plain" class="{{<$form.param.class>}}"  {{<$form.attribute>}} style='width:100%;height:500px;'>{{<$form.default>}}</script>
<textarea name="{{<$form.field>}}" class="{{<$form.field>}}" id='editor-textarea-{{<$form.field>}}'  style="display:none;">{{<$form.default>}}</textarea>

<script type="text/javascript">
	 $(function(){
	 	var {{<$form.field>}} = UE.getEditor('{{<$form.field>}}');
	 	    {{<$form.field>}}.addListener("selectionchange", function () {
	            $("#editor-textarea-{{<$form.field>}}").val({{<$form.field>}}.getContent())
	           
	        } );
	 })


</script>