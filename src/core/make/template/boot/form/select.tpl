

 <select class="form-control m-b {{<$form.param.class>}}"  name="{{<$form.field>}}" {{<$form.attribute>}}>
 	{{<if !isset($form['param']['multiple'])>}}
    <option value="">请选择</option>
    {{</if>}}
    {{<foreach $form['options'] as $ki=>$vi>}}
      {{<if is_array($vi)>}}
      <option value="{{<$ki>}}" {{<if $form['default']==$ki>}} selected="" {{</if>}}>{{<$vi.value>}}</option>
      {{<else>}}
      <option value="{{<$ki>}}" {{<if $form['default']==$ki>}} selected="" {{</if>}}>{{<$vi>}}</option>
      {{</if>}}
    
    {{</foreach>}}

  </select>