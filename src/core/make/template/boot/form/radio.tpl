
  {{<foreach $form['options'] as $ki=>$vi>}}
   {{<if is_array($vi)>}}

      <label class="bear-radio"><input type="radio"  class="{{<$vi.param.class>}}" value="{{<$ki>}}" title="{{<$vi.value>}}" {{<$vi.attribute>}} {{<if $form['default']===$ki>}} checked="true"{{</if>}}> <i></i> {{<$vi>}}</label>

 {{<else>}}


    <label class="bear-radio"><input type="radio"  class="{{<$form.param.class>}}" value="{{<$ki>}}" title="{{<$vi>}}" {{<$form.attribute>}} {{<if $form['default']===$ki>}} checked="true"{{</if>}} > <i></i> {{<$vi>}}</label>

 {{</if>}}
  
{{</foreach>}}

