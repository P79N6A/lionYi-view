<div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">{{<$form.title>}}</label>
      <div class="layui-input-inline">
        <select name="quiz">
        <option value="">请选择问题</option>
          {{<foreach $form['options'] as $ki=>$vi>}}
            <optgroup label="{{<$ki>}}">
                {{<foreach $vi as $kii=>$vii>}}
                    {{<if is_array($vii)>}}
                    <option value="{{<$kii>}}" {{<if $form['default']===$kii>}} selected="" {{</if>}} class="{{<$vii.class>}}" id="{{<$vii.id>}}" {{<$vii.attr>}}>{{<$vii.value>}}</option>
                    {{<else>}}
                    <option value="{{<$kii>}}" {{<if $form['default']===$kii>}} selected="" {{</if>}}>{{<$vii>}}</option>
                    {{</if>}}

                {{</foreach>}}
            </optgroup>
            {{</foreach>}}
        
        </select>
      
        <span class='bear-tips'>{{<$form.param.tips>}}</span>
      
      </div>
    </div>