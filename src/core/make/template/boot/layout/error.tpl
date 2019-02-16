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

    }
    .btn-area{
        margin-top: 20px;
    }
</style>
<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
    <div class="msg-area">
        <div class="icon"><i class='fa fa-exclamation-triangle'></i></div>  
        <div class="msg">
            <h3 class="font-bold">页面出现问题！</h3>

            <div class="error-desc">
                {{<$msg>}}
            </div>  
        </div>
    </div>
        <!-- <h1>error</h1> -->
        
        <div class="form-group" >
            <div class="col-sm-12 btn-area" >
                <a class="btn btn-primary fl" onclick ="window.location.reload()" >刷新</a>
                <a class="btn btn-white fl" href="JavaScript:history.go(-1)" >返回</a>
            </div>
     </div>
    </div>

{{<include file='../public/footer.tpl'>}}
<script type="text/javascript">


// layer.alert('内容', {
//   icon: 1,
//   skin: 'layer-ext-moon' //该皮肤由layer.seaning.com友情扩展。关于皮肤的扩展规则，去这里查阅
// })
</script>