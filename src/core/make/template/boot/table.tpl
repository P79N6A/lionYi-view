{{<include file='./public/header.tpl'>}}


   <div class="wrap"> 
    <div class=""> 
     <div class="bootstrap-table">
      <div class="fixed-table-toolbar">
       <div class="bars pull-left">
        <div class="btn-group hidden-xs" role="group"> 
         {{<if isset($_topBtn)&&$_topBtn>}}
            {{<foreach $_topBtn as $k=>$v >}}
                {{<include file='./table/btn.tpl'>}}
            {{</foreach>}}
         {{</if>}}
        </div>
       </div>
       <div class="columns columns-right btn-group pull-right">
        <a class="btn btn-default btn-outline" onclick="window.location.reload()" name="refresh" title="刷新"><i class="glyphicon glyphicon-repeat"></i></a>
        <a class="btn btn-default btn-outline" onclick="alert('开发中...')" name="toggle" title="切换"><i class="glyphicon glyphicon-cloud-download"></i></a>
        <div class="keep-open btn-group" title="列">
         <button type="button" class="btn btn-default btn-outline dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> <span class="caret"></span></button>
         <ul class="dropdown-menu" role="menu" id="bear-show-hide-table">
          <form action="" id="showField">
           {{<foreach $_thead as $k=>$v>}}
          
             <li><label><input type="checkbox" data-field="id" value="{{<$v['field']|default:''>}}" checked="checked" name="showField" /> {{<$v['title']|default:''>}}</label></li>
            
            {{</foreach>}}
          </form>
         </ul>
        </div>
       </div>
       {{<if isset($_search) and !empty($_search)>}}
       <div class="pull-right search">
         <form id="bear-table-search" action="" method="GET">
            <div class="input-group" id="bear-search-area">
              <input type="text" name="keyword" class="form-control" id="search-keyword" value="{{<$searchvalue|default:''>}}">
              <div class="input-group-btn">
              <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" ><span class='text' search-field='{{<$_search_all>}}'>全部</span><span class="caret mbl-5"></span>
                  <button tabindex="-1" class="btn btn-white" type="button" id="search-btn">搜索</button>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:;" search-field='{{<$_search_all>}}'>全部</a>
                        </li>
                        <li class="divider"></li>
                        {{<foreach $_search as  $k=>$v>}}
                        <li><a href="javascript:;" search-field='{{<$k>}}'>{{<$v>}}</a></li>
                       {{</foreach>}}
                    </ul>
              </div>
          </div>
         </form>
       </div>
        {{</if>}}
      </div>
      
     </div>
     <div class="clearfix"></div> 
     <table class="table table-bordered table-hover" id="bear-table">
        <thead>
        {{<* 表头 *>}}
            <tr>
            {{<if isset($checkbox)&&$checkbox>}}
                    <th width="30"><input type="checkbox"></th>
                {{</if>}}
            {{<foreach $_thead as $k=>$v>}}
                    <th field="{{<$v['field']|default:''>}}">{{<$v['title']|default:''>}}</th>
            {{</foreach>}}
              {{<if isset($_rightBtn)&&$_rightBtn>}}
                     <th align="center" field="rightbtn">操作</th>
              {{</if>}}
            </tr>
        </thead>
        <tbody>
        {{<* 表身 *>}}
       {{<if isset($_data)&&is_array($_data)>}}
             {{<foreach $_data as $kdata=>$vdata>}}
                <tr>
               
                
                 {{<if isset($checkbox)&&$checkbox>}}
                        <td><input type="checkbox"></td>
                  {{</if>}}
                  {{<foreach $_thead as $k=>$v>}}
                        <td field="{{<$v['field']|default:''>}}">{{<$vdata[$v['field']]|default:''>}}</td>
                  {{</foreach>}}
                  {{<* 按钮 BEGIN*>}}
                   {{<if isset($vdata['rightBtn'])&&$vdata['rightBtn']>}}
                   <td field="rightbtn">
                      <div class="btn-group">
                        {{<foreach $vdata['rightBtn'] as $k=>$v >}}
                             {{<include file='./table/btn.tpl'>}}
                        {{</foreach>}}
                      </div>
                     </td>
                   {{</if>}}  
                   {{<* 按钮 END*>}}
                </tr>
               {{</foreach>}}
          
           {{</if>}}
            {{<if empty($_data)>}}
              <tr>
                 <td align="center" colspan="{{<$_countThead>}}">没有找到匹配的记录</td>
              </tr>
            {{</if>}}
            
        </tbody>
    </table>
    {{<if isset($_pages)>}}
    <div class="fixed-table-pagination" style="display: block;">
      {{<$_pages>}}
     </div>
    {{</if>}}
    </div> 
   </div> 
  


   

{{<include file='./public/footer.tpl'>}}
<script type="text/javascript">
  var tableConfig = {
    'editable_url':''


  };

</script>
<link href="/static/admin/bear/plus/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
<script src="/static/admin/bear/plus/bootstrap3-editable/js/bootstrap-editable.min.js" charset="utf-8"></script>
<script src="/static/admin/bear/js/bearTable.js" charset="utf-8"></script>
</body>
</html>
