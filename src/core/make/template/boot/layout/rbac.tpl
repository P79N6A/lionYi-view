{{<include file='../public/_meta.tpl'>}}


<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <form action="" method="post" class="tForm">

                        {{<foreach $menus as $key=>$value>}}
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                            <thead>
                            <tr>
                                <th>
                                    <span class="label label-danger">{{<$value.name>}}</span>
                                    <a href="javascript:;" data-id="{{<$key>}}" class="select_all">全选</a>/
                                    <a href="javascript:;" data-id="{{<$key>}}" class="reverse_select">反选</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>
                                    {{<if $value['child']>}}
                                        {{<foreach $value['child'] as $k=>$v>}}
                                            <div class="pull-left" style="width:350px;">
                                                <div class="timeline-item">
                                                    <div class="">
                                                        <div class="col-xs-3 date">
                                                            <i class="fa"><input data-parentid="{{<$key>}}" type="checkbox" {{<if in_array(trim($v.url,'/'),$roles)>}}checked="checked" {{</if>}}   name="power[]" value="{{<$v.url>}}"></i>
                                                        </div>
                                                        <div class="col-xs-5 content no-top-border" style="min-height:10px;">
                                                            <p class="m-b-xs"><strong>{{<$v.name>}} </strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    {{</foreach>}}
                                    {{</if>}}

                                </td>
                            </tr>

                            </tbody>

                        </table>
                        {{</foreach>}}
                        <a class="btn btn-primary tPost bearBtn" bear-even='post' >授权</a>
                </div>
            </div>
        </div>
    </div>

</div>
{{<include file='../public/footer.tpl'>}}
<script src="/static/admin/bear/js/bearForm.js" charset="utf-8"></script>
<script type="text/javascript">
    //模块化全选  S
    $(".mkfMenu_all").click(function(event) {
        var dataid = $(this).attr('data-id');
        for (var i = 0; i < $(".mkfMenu"+dataid).length; i++) {
            $(".mkfMenu"+dataid).eq(i).prop("checked", true);
        };

    });
    $(".reverse_all").click(function(event) {
        var dataid = $(this).attr('data-id');
        for (var i = 0; i < $(".mkfMenu"+dataid).length; i++) {
            // alert($(".mkfMenu"+dataid).eq(i).prop("checked"))
            if($(".mkfMenu"+dataid).eq(i).prop("checked") == true){
                $(".mkfMenu"+dataid).eq(i).prop("checked", false);
                // console.log(1);
            }else{
                $(".mkfMenu"+dataid).eq(i).prop("checked", true);
                // console.log(2);
            }
        };
    });
    $(".mkfMenu_all_func").click(function(event) {
        var dataid = $(this).attr('data-id');
        var choose = $(".mkfMenu_area"+dataid).find("input");
        // alert(choose.length);
        for (var i = 0; i < $(".mkfMenu_area"+dataid).find("input").length; i++) {
            choose.eq(i).prop("checked", true);
        };

    });
    $(".reverse_all_func").click(function(event) {
        var dataid = $(this).attr('data-id');
        var choose = $(".mkfMenu_area"+dataid).find("input");
        for (var i = 0; i < choose.length; i++) {
            // alert($(".mkfMenu"+dataid).eq(i).prop("checked"))
            if(choose.eq(i).prop("checked") == true){
                choose.eq(i).prop("checked", false);
                // console.log(1);{
            }else{
                choose.eq(i).prop("checked", true);
                // console.log(2);
            }
        };
    });
    //模块化下面的操作按钮
    $('.re_sele_child').click(function(event) {
        var choose = $(this).parent('p').siblings('p').find('input');
        for (var i = 0; i < choose.length; i++) {
            if(choose.eq(i).prop("checked") == true){
                choose.eq(i).prop("checked", false);
            }else{
                choose.eq(i).prop("checked", true);
            }
        };
        //按钮选择了，当然列表也要选择，不然无法显示按钮的位置
        $(this).parents('div.content').siblings('.data').find("input").prop("checked", true);

    });

    //模块化全选  E
    $(".select_all").click(function(event) {
        var dataid = $(this).attr('data-id');
        var choose = $("input[data-parentid="+dataid+"]");
        for (var i = 0; i < choose.length; i++) {
            choose.eq(i).prop("checked", true);
        };
    });



    $('.reverse_select').click(function(event) {
        var dataid = $(this).attr('data-id');
        var choose = $("input[data-parentid="+dataid+"]");
        for (var i = 0; i < choose.length; i++) {
            // alert($(".mkfMenu"+dataid).eq(i).prop("checked"))
            if(choose.eq(i).prop("checked") == true){
                choose.eq(i).prop("checked", false);
                // console.log(1);{
            }else{
                choose.eq(i).prop("checked", true);
                // console.log(2);
            }
        };
    });


    // $('.mkf').click(function(event) {
    //     if($(this).parent().find('input').prop("checked")!=true){
    //         $(this).parent().find('input').prop("checked",true)
    //     }
    // });


</script>
</form>