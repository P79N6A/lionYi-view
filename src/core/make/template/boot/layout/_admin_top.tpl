<style type="text/css">
    i.closeico{
        /*display:block;
        float:right;margin-left:5px;
        font-size:9px;
        position: relative;
        right: -5px;
        top: -5px;*/
        font-size: 10px !important;
    }
    .block-opt-refresh {
        position: relative;
    }
    .block-opt-refresh > .block-header {
        opacity: .25;
    }
    .block-opt-refresh > .block-content {
        opacity: .15;
    }
    .block-opt-refresh:before {
        position: absolute;
        display: block;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        content: " ";
    }
    .block-opt-refresh:after {
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -20px 0 0 -20px;
        width: 40px;
        height: 40px;
        line-height: 40px;
        color: #646464;
        font-family: Simple-Line-Icons;
        font-size: 18px;
        text-align: center;
        z-index: 2;
        /*content: "\e09a";*/
        -webkit-animation: fa-spin 2s infinite linear;
        animation: fa-spin 2s infinite linear;
    }
    #loading {
        background: rgba(255, 255, 255, 0.16) none repeat scroll 0 0;
        height: 100%;
        position: fixed;
        width: 100%;
        z-index: 9990;
    }
    #loading .loading-box {
        background-color: rgba(0, 0, 0, 0.62);
        border-radius: 4px;
        color: #fff;
        left: 50%;
        margin-left: -50px;
        margin-top: -24px;
        padding: 10px;
        position: fixed;
        top: 50%;
        z-index: 999999;
    }
    #loading i {
        float: left;
        margin-right: 5px;
    }
    #loading .loding-text {
        display: inline-block;
        margin-top: 3px;
    }
    /*##删除所有菜单*/
    #delete-all{
        width: 50px;

    }
    #delete-all i.closeicoaal{
        display:block;
        float:right;
        /*margin-left:5px;*/
        font-size:9px;
        position: relative;
        left:-10px;
        top: 7px;
        font-size: 20px !important;
    }
    #menus{
        background: #fff;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,.1);
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
        background: #f6f6f6;
    }

    #menus .navbar-content{
        margin-left: 0;
    }
    #menus a.active,#menus li.active{
        background: #f2f2f2;
    }
    #topmenu{

    }
    #topmenu li{
        min-width: 70px;
        text-align: center;
    }
    #topmenu li a{
        width: 100%;
        text-align: center;
        display: block;
        line-height: 40px;
    }
</style>
<ul class="nav nav-tabs" id="menus">

    <div class="navbar-content clearfix">
        <ul class="nav navbar-top-links pull-left" id="topmenu">
            <li class="active" levelid='welcome'>
                <a class="" href="#" >首页</a>
            </li>


        </ul>
        <ul class="nav navbar-top-links pull-right">
            <li>
                <a href="#" class="aside-toggle navbar-aside-icon dropdown-toggle" data-toggle="dropdown">
                    <i class="dropdown-caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">功能面板</li>
                    <li><a href="javascript:;" class="closeicoaal" >关闭所有</a></li>
                    <li><a href="javascript:;" class="window-new" >新窗口打开</a></li>
                </ul>


            </li>
        </ul>

    </div>


</ul>
<div id="page-content" style="height:100%">
    <iframe class="J_iframe" id="J_iframe" levelid='welcome' name="iframe0" width="100%" height="100%" src="/superadmin/index/welcome" frameborder="0" data-id="welcome}" seamless>

    </iframe>
</div>
<script>
    $(function(){
//新窗口打开
        $("#menus").on('click', '.window-new', function(event) {
            openNowUrl();
        });
//欢迎页面高度处理
        autoIframeHeight("welcome");
//点击左侧
        $('.checkmenu').click(function(event) {
            leftmenu($(this),0)

        });
        /**
         * [openNowUrl 新窗口打开当前选中的IFRAME]
         * @Author   Jerry
         * @DateTime 2018-08-17T11:35:04+0800
         * @Example  eg:
         * @return   {[type]}                 [description]
         */
        function openNowUrl(){
            window.open($("iframe[levelid='"+$('#topmenu li.active').attr('levelid')+"']").attr('src'));
        }

        function leftmenu(element,do_level){
            var element = element;
            var do_level = do_level;
            var key               = element.attr('key');
            var parentkey         = element.attr('parentkey');
            var level             = element.attr('level');
            var title             = element.text();
            var levelid           = element.attr('levelid');
            var parentlevelid     = element.attr('parentlevelid');
            if(element.length>0&&level!=0){
                if(do_level<1){
                    //当前点击的标签
                    $('.checkmenu').removeClass('active-link')
                    $("li[levelid='"+levelid+"']").addClass('active-link')
                    //生成顶部的菜单
                    creatHtml(element);
                }else{
                    //递归处理的父级标签
                    $("li[levelid='"+levelid+"']").addClass('active-sub').siblings('li').removeClass('active-sub')
                }
                //开始递归
                leftmenu($("li[levelid='"+parentlevelid+"']"),(do_level+1))
            }
        }
        function creatHtml(element){
            var element = element;
            var title             = element.text();
            var levelid           = element.attr('levelid');
            var parentlevelid     = element.attr('parentlevelid');
            var url               = element.attr('url');
            //----样式处理---
            lis = '<li class="active" parentlevelid="'+parentlevelid+'" levelid="'+levelid+'"><a class="" href="#">'+title+' <i class="ti-close closeico" style=""></i></a></li>';
            iframe = ' <iframe class="J_iframe" levelid="'+levelid+'" name="iframe0" width="100%" height="100%" src="'+url+'" frameborder="0"  seamless></iframe>';
            //不存在时，顶部增加个标签
            if($("#menus li[levelid='"+levelid+"']").length<1){
                //加载Loading...
                $('body').prepend('<div id="loading" class="refresh-self-area"><div class="loading-box"><i class="fa fa-2x fa-cog fa-spin"></i> <span class="loding-text">加载中...</span></div></div>')
                $('#topmenu').append(lis).find("li[levelid='"+levelid+"']").addClass('active').siblings('li').removeClass('active');
                $('#page-content').find('iframe').hide().parent('#page-content').append(iframe).stop(autoIframeHeight(levelid));
            }else{
                //存在时，处理样式
                $("#menus li[levelid='"+levelid+"']").addClass('active').siblings('li').removeClass('active');
                $("iframe[levelid='"+levelid+"']").show().siblings('iframe').hide();
            }
        }
        //点击顶部
        $("#topmenu").on('click', 'li', function(event) {
            var levelid              = $(this).attr('levelid');
            var parentlevelid        = $(this).attr('parentlevelid');
            $("iframe[levelid='"+levelid+"']").show().siblings('iframe').hide();//IFRAME处理
            $(this).addClass('active').siblings('li').removeClass('active');
            leftmenu($("li.checkmenu[levelid='"+levelid+"']"),0) //左侧菜单处理

        });

//双击顶部重新加载IFARME
        $("#topmenu").on('dblclick', 'li', function(event) {
            var levelid              = $(this).attr('levelid');
            var parentlevelid        = $(this).attr('parentlevelid');
            $("iframe[levelid='"+levelid+"']").attr('src', $("iframe[levelid='"+levelid+"']").attr('src')).siblings('iframe').hide();//IFRAME处理
            leftmenu($("li.checkmenu[levelid='"+levelid+"']"),0) //左侧菜单处理
        });
//关闭所有
        $("#menus").on('click', '.closeicoaal', function(event) {
            $('.closeico').click();
            $("iframe[levelid='welcome']").show();//欢迎页显示

        });
//关闭
        $("#menus").on('click', '.closeico', function(event) {
            var levelid          = $(this).parents('li').attr('levelid');
            var parentlevelid    = $(this).parents('li').attr('parentlevelid');
            $("iframe[levelid='"+levelid+"']").remove()//删除当前节点对应的iframe
            $(this).parents('li').prev('li').click();//显示兄弟级上一个节点
            $(this).parents('li').remove()//删除当前节点
            //如果只有一个就显示欢迎页
            if($('#topmenu li').length==1){
                $('#topmenu li').eq(0).click();
            }
            return false;
        });
//窗体变化
        $(window).resize(function(event) {
            var levelid = $("#menus li.active").attr('levelid');
            $("iframe[levelid='"+levelid+"']").height(($(window).height()-180))
        });
//顶部的用户中心
        $('#dropdown-user').hover(function() {
            $(this).find('.dropdown-menu').show()
        }, function() {
            $('.dropdown-menu').hide()
        });
        /**
         * [autoIframeHeight iframe自动适应高度]
         * @Author   Jerry
         * @DateTime 2017-05-06
         * @Example  eg:
         * @param    {[type]}   id [description]
         * @return   {[type]}      [description]
         */
        function autoIframeHeight(levelid){
            var levelid = levelid;
            var iframes = $("iframe[levelid='"+levelid+"']");
            iframes.load(function () {
                var windwoheight = ($(window).height()-180)
                iframes.height(windwoheight);
                $('body #loading').remove();
            });


        }

    })



    // function autoIframeHeight(element){
    //         var ifm= document.getElementById(element);
    //         var ifh = document.documentElement.clientHeight;
    //         ifh = ifh>900?ifh:900;
    //         ifm.height=ifh
    // }
    // $("#J_iframe").load(function () {
    //     var mainheight = $(this).contents().find("body").height() + 30;
    //     var windwoheight = ($(window).height()-160)
    //     mainheight = mainheight> windwoheight? windwoheight:mainheight
    //     $(this).height(mainheight);
    //     $(this).height(mainheight);
    // });
</script>