<select name="modules" lay-verify="required" lay-search="">
  <option value="">直接选择或搜索选择</option>
   {{<foreach $form['options'] as $ki=>$vi>}}
      {{<if is_array($vi)>}}
          <option value="{{<$ki>}}" {{<if $form['default']===$ki>}} selected="" {{</if>}} class="{{<$vi.class>}}" id="{{<$vi.id>}}" {{<$vi.attr>}}>{{<$vi.value>}}</option>
      {{<else>}}
          <option value="{{<$ki>}}" {{<if $form['default']===$ki>}} selected="" {{</if>}}>{{<$vi>}}</option>
      {{</if>}}
  {{</foreach>}}
</select>