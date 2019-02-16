{{<include file='../public/header.tpl'>}}

<style type="text/css">
#nestable-area{

}
#nestable-area .dd-list{

}
#nestable-area .dd-list .dd-item{

}
#nestable-area .dd-list .dd-item i{
    margin-right: 10px;
}

</style>
 <div class="dd" id="nestable-area">
    <ol class="dd-list">
   {{<foreach $data as $ki=>$v>}}
        <li class="dd-item dd3-item" data-id="{{<$v.field>}}">
            <div class="dd-handle dd3-handle"><i class='glyphicon glyphicon-list'></i>{{<$v.title>}}</div>
        </li>
      {{</foreach>}}

    </ol>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <div class="col-sm-12">
        <a class="btn btn-primary sub bearBtn" bear-even='sort' >提交</a>
        <!-- <a class="btn btn-white" href="JavaScript:history.go(-1)" >返回</a> -->
    </div>
</div>
{{<include file='../public/footer.tpl'>}}
<script src="/static/admin/bear/plus/jquery.nestable.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
     $('#nestable-area').nestable({
        maxDepth:1,
    });
    var bear  = layui.bear;

    $('.sub').click(function(event) {
            var data        = $('#nestable-area').nestable('serialize');
            var postData    = {};
            for (var i = 0; i < data.length; i++) {
                postData[data[i].id] = i;
            };
            var btnStatus = bear._getAttr($(this),'btnStatus')?bear._getAttr($(this),'btnStatus'):"";
            var element   = $(this);  
            if(!btnStatus||btnStatus=="on"){
                  bear._chlickStart(element)
                  bear.tajax(bearConfig.changeSortUrl,postData,'true','json','true').done(function(re){
                    bear._chlickEnd(element)
                    bear._showInfo(re)
                  })
              }
            
        });

})


    
    // $('#nestable-area').on('change', function(event) {
    //    console.log($('#nestable-area').nestable('serialize'))
    // });
   
</script>
