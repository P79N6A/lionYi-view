{{<include file='../public/_meta.tpl'>}}
<style type="text/css">
    i.fa{
        font-size: 90px;
    }
    .icon{
        float: left;
    }
    .msg{
        float: left;
        margin-left: 20px;
        padding-top: 20px;
    }
    .fl{
        float: left;
        margin-right: 10px;
        text-align: left;
        margin-top: 20px

    }
    .btn-area{
        margin-top: 20px;

    }
</style>
<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
    <div class="msg-area">
        <div class="icon"><i class='fa fa-smile-o'></i></div>  
        <div class="msg">
            <h3 class="font-bold">操作成功！</h3>

            <div class="error-desc">
                {{<$msg>}}
            </div>  
        </div>
    </div>
        <!-- <h1>error</h1> -->
        
        <div class="form-group" >
             <div class="col-sm-12 fl" >
                    <a href="javascript:;" id="backurl">您的操作成功，页面会在3秒内进行跳转</a>
             </div>
     </div>
    </div>

{{<include file='../public/footer.tpl'>}}
<script type="text/javascript">
    $(function(){
        var backurl = "{{<$backurl>}}";
        if(!backurl){
            backurl = document.referrer;
        }
        
        $('#backurl').attr('backurl', backurl);
        window.location.href = backurl;

    })

// layer.alert('内容', {
//   icon: 1,
//   skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
// })
</script>