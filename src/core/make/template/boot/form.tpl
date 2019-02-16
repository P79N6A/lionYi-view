{{<include file='./public/header.tpl'>}}

 <div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
         {{<if isset($_topBtn)&&$_topBtn>}}
        <div class="bars">
            <div class="btn-group hidden-xs" role="group"> 
                {{<foreach $_topBtn as $k=>$v >}}
                    {{<include file='./table/btn.tpl'>}}
                {{</foreach>}}
            </div>
           </div>
           <div class="hr-line-dashed"></div>
           {{</if>}}

              <div class="col-sm-12"> 
                <form class=" tForm" action="{{<$action>}}" method="{{<$method|default:post>}}">
                    {{<if isset($_alert)>}}{{<include file='./form/alert.tpl'>}}{{</if>}}
                    <!-- ##表单开始 -->
                    {{<if isset($_form)&&count($_form)>0>}}
                        {{<foreach $_form as $k => $v>}}
                        {{<$form = $v>}}
                            {{<if $v.type=='hidden'>}}
                                 {{<*隐藏域*>}}
                                 {{<include file='./form/hidden.tpl'>}}
                            {{<elseif $v.type=='hr'>}}
                                {{<*hr标签*>}}
                                   {{<include file='./form/hr.tpl'>}} 
                            {{<elseif $v.type=='static'>}}
                                {{<*静态文件*>}}
                                    {{<include file='./form/hr.tpl'>}} 
                            {{<else>}}
                                {{<*其它表单*>}}
                             <div class="form-group {{<$form['triggerHide']|default:''>}} {{<$form['triggerShow']|default:''>}}" style=''>
                                <label class="font-noraml bear-label label-{{<$form.field>}}">{{<$form.title>}}</label>
                                 {{<if $v.type=='text'>}}{{<include file='./form/text.tpl'>}}{{</if>}}
                                 {{<if $v.type=='textarea'>}}{{<include file='./form/textarea.tpl'>}}{{</if>}}
                                 {{<if $v.type=='password'>}}{{<include file='./form/password.tpl'>}}{{</if>}}
                                 {{<if $v.type=='radio'>}}{{<include file='./form/radio.tpl'>}}{{</if>}}
                                 {{<if $v.type=='checkbox'>}}{{<include file='./form/checkbox.tpl'>}}{{</if>}}
                                 {{<if $v.type=='switch'>}}{{<include file='./form/switch.tpl'>}}{{</if>}}
                                 {{<if $v.type=='select'>}}{{<include file='./form/select.tpl'>}}{{</if>}}
                                 {{<if $v.type=='selectgroup'>}}{{<include file='./form/selectgroup.tpl'>}}{{</if>}}
                                 {{<if $v.type=='selectsearch'>}}{{<include file='./form/selectsearch.tpl'>}}{{</if>}}
                                 {{<if $v.type=='date'>}}{{<include file='./form/date.tpl'>}}{{</if>}}
                                 {{<if $v.type=='datetime'>}}{{<include file='./form/datetime.tpl'>}}{{</if>}}
                                 {{<if $v.type=='img'>}}{{<include file='./form/img.tpl'>}}{{</if>}}
                                 {{<if $v.type=='ueditor'>}}{{<include file='./form/ueditor.tpl'>}}{{</if>}}
                                 <span class='bear-tips tips-{{<$form.field>}}'>{{<$form.param.tips>}}</span>
                              </div>
                        {{</if>}}
                        {{</foreach>}}
                    {{</if>}}
                    <input type="hidden" name="token" value="{{<$token>}}">
                    <input type="hidden" name="validate" value="{{<$validate>}}">
                    <input type="hidden" name="gourl" value="{{<$goUrl>}}">
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <a class="btn btn-primary tPost bearBtn" bear-even='post' >保存内容</a>
                            <a class="btn btn-white" href="JavaScript:history.go(-1)" >返回</a>

                        </div>
                    </div>
                </form>
               

              </div>
        </div>
    </div>
   
</div>


{{<include file='./public/footer.tpl'>}}
{{<*日期选择器*>}}
{{<if isset($_form_types['date'])||isset($_form_types['datetime'])>}}
 <script type="text/javascript" charset="utf-8" src="/static/admin/bear/plus/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
 <script type="text/javascript" charset="utf-8" src="/static/admin/bear/plus/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
 <script type="text/javascript">
 $('.bear-input-date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,//显示‘今日’按钮
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
 </script>
{{</if>}}
{{<*百度编辑器*>}}
{{<if isset($_form_types['ueditor'])>}}
     <script type="text/javascript" charset="utf-8" src="/static/admin/bear/plus/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/admin/bear/plus/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/static/admin/bear/plus/ueditor/lang/zh-cn/zh-cn.js"></script>

{{</if>}}

 {{<*开关*>}}
{{<if isset($_form_types['switch'])>}}
    <script src="/static/admin/bear/plus/bootstrap-switch/js/bootstrap-switch.min.js" charset="utf-8"></script>
    <script type="text/javascript">
     $(window).on('load', function () {  
        $('.bear-switch input').bootstrapSwitch();
    })
//     $(".bear-switch").on('switch-change', function (e, data) {
//     var $el = $(data.el)
//       , value = data.value;
//     console.log(e, $el, value);
// });
    </script>
{{</if>}}
 {{<*下拉*>}}
{{<if isset($_form_types['select'])>}}
    <script src="/static/admin/bear/plus/chosen/chosen.jquery.js" charset="utf-8"></script>
    <script type="text/javascript">
          $(window).on('load', function () {  
  
            $('select').chosen();  
  
            // $('.selectpicker').selectpicker('hide');  
        });  
    </script>
{{</if>}}


    <script src="/static/admin/bear/js/bearForm.js" charset="utf-8"></script>
</body>
</html>
