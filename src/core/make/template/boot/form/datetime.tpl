<div class="input-group date  bear-input-date" data-date="" data-date-format="{{<$form.param.format|default:'yyyy-mm-dd hh:ii:ss'>}}"  data-link-field="dtp-{{<$form.field>}}" data-link-format="yyyy-mm-dd" {{<$form.attribute>}} {{<$form.param.id>}}>
	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	<input class="form-control" type="text" value="{{<$form.default>}}" readonly >
	<input type="hidden" id="dtp-{{<$form.field>}}" value="{{<$form.default>}}" name="{{<$form.field>}}" />
</div>

