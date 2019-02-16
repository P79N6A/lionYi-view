
  {{<foreach $form['options'] as $ki=>$vi>}}
   {{<if is_array($vi)>}}
    <label class="bear-checkbox"><input class="{{<$vi.param.class>}}" type="checkbox"  value="{{<$ki>}}" title="{{<$vi.value>}}" {{<$vi.attribute>}} {{<if $form['default']===$ki>}} checked="true"{{</if>}}> <i></i> {{<$vi>}}</label>
 {{<else>}}

    <label class="bear-checkbox"><input class="{{<$form.param.class>}}" type="checkbox" value="{{<$ki>}}" title="{{<$vi>}}" {{<$form.attribute>}} {{<if $form['default']===$ki>}} checked="true"{{</if>}} > <i></i>{{<$vi>}} </label>

 {{</if>}}
  
{{</foreach>}}

