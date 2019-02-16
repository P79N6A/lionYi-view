{{<include file='../public/header.tpl'>}}
<style type="text/css">
    .bear-baseset:hover{
      background: #ddd;
    }
</style>

<div class="bars " style="margin-bottom:20px;">
  <div class="btn-group hidden-xs" role="group"> 
     <a href="javascript:;" class="btn btn-outline bear-btn btn-default  bearAlert" url="{{<$sorUrl>}}"> <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>设置字段排序 </a> 
 </div>
 </div>
 <div class="hr-line-dashed"></div> 
  <form class=" tForm" action="" method="post"> 
   <!-- ##表单开始 --> 

{{<foreach $field as $k=>$v>}}
  <div class="bear-baseset bear-module-{{<$v['field']>}}-area">
  	<div class="baseset-set-title">
  		<p>字段:{{<$v['field']>}}</p>
  	</div>
  	<input type="hidden" name="field[]" value="{{<$v['field']>}}">
  	 <div class="form-group"> 
        <label class="font-noraml bear-label label-isshow">属性管理:</label> 

        {{<foreach $attributes as $kattr=>$vattr>}}
          <label class="bear-checkbox">
            <input type="checkbox" class=" bear-form-checkbox bear-make-isshow checked-{{<$kattr>}}" value="{{<$kattr>}}"    name="{{<$v['field']>}}attribute" {{<if '1'==$settingsDefault[$v['field']][$kattr]>}} checked='checked'{{</if>}}
             /> <i></i> {{<$vattr>}}
          </label> 
        {{</foreach>}}

     </div> 


   <div class="siblings" style="{{<if $settingsDefault[$v['field']]['form_edit']!='1'>}}display:none;{{</if>}}">
       <div class="form-group  " > 
        <label class="font-noraml bear-label label-title">表单标题:</label> 
        <input type="text" class="form-control  bear-form-text bear-make-title" tips="表单页填写时的标题" id="bear-make-title" name="{{<$v['field']>}}title" placeholder="" verify="" value="{{<$settingsDefault[$v['field']]['title']>}}"/> 
        
       </div> 
       <div class="form-group  " > 
        <label class="font-noraml bear-label label-title">提示信息Tips:</label> 
        <input type="text" class="form-control  bear-form-text bear-make-title" tips="表单页填写时的标题" id="bear-make-title" name="{{<$v['field']>}}tips" placeholder="" verify="" value="{{<$settingsDefault[$v['field']]['tips']>}}"/> 
        
       </div> 
       <div class="form-group  " > 
        <label class="font-noraml bear-label label-options">参数值:</label> 
        <input type="text"  class="form-control  bear-form-text bear-make-options" tips="表单页填写时的标题" id="bear-make-options" name="{{<$v['field']>}}options" placeholder="" verify=""value="{{<$settingsDefault[$v['field']]['options']>}}"/> 
        <span class="bear-tips tips-options"></span> 
       </div> 
       <div class="form-group "> 
        <label class="font-noraml bear-label label-id">表单类型:</label> 
        <select class="form-control m-b  bear-form-select bear-make-id" name="{{<$v['field']>}}formtype" id="bear-make-id" placeholder="" verify="" > 
        {{<foreach $formType as $vi>}}
       		<option value="{{<$vi>}}" {{<if $vi==$settingsDefault[$v['field']]['formtype']>}} selected='selected'{{</if>}} >{{<$vi>}}</option>  
        {{</foreach>}}
        </select> 
        <span class="bear-tips tips-id"></span> 
       </div> 
   </div>
  </div>
  <input type="hidden" name="{{<$v['field']>}}list_sort" value="{{<$settingsDefault[$v['field']]['list_sort']|default:'0'>}}">
  <input type="hidden" name="{{<$v['field']>}}form_sort" value="{{<$settingsDefault[$v['field']]['form_sort']|default:'0'>}}">
{{</foreach>}}
   <div class="hr-line-dashed"></div> 
   <input type="hidden" name="table" value="{{<$table>}}">
   <input type="hidden" name="gourl" value="JavaScript:history.go(-1)" /> 
   <div class="form-group"> 
    <div class="col-sm-12"> 
     <a class="btn btn-primary tPost bearBtn" bear-even="post">保存内容</a> 
     <a class="btn btn-white" href="JavaScript:history.go(-1)">返回</a> 
    </div> 
   </div> 
  </form>
{{<include file='../public/footer.tpl'>}}
<script src="/static/admin/bear/js/bearForm.js" charset="utf-8"></script>
<script type="text/javascript">
	$('.checked-form_edit').on('click',  function(event) {
    if($(this).prop('checked')){
      $(this).parents('.form-group').siblings('.siblings').show();
    }else{
      $(this).parents('.form-group').siblings('.siblings').hide();
    }
  });
</script>