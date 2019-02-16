<?php
/* Smarty version 3.1.32, created on 2018-09-07 14:21:14
  from 'D:\Users\Administrator\Desktop\web\bear\bear\src\bear\make\template\boot\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9218daa46786_24754419',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2fced11ea5868855bb2dbba09f732ae54413cd25' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\form.tpl',
      1 => 1536137223,
      2 => 'file',
    ),
    '2b9eb1568c4058aece6b192ed83c7843dafccef0' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\public\\header.tpl',
      1 => 1536288739,
      2 => 'file',
    ),
    '69cb406f201fcd4aedeb0916fd35e2876f9d3dfd' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\public\\_meta.tpl',
      1 => 1535956291,
      2 => 'file',
    ),
    'db22710b9b942ddaa6fc0210b2af53d0cbf58cf8' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\public\\footer.tpl',
      1 => 1535684038,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_5b9218daa46786_24754419 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="JerryChen">
    <title>Bear小熊表单-后台管理-powerby-bear小熊</title>
    <meta name="keywords" content="Bear小熊表单-后台管理-powerby-bear小熊">
    <meta name="description" content="Bear小熊表单-后台管理-powerby-bear小熊">

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="/static/admin/bear/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="http://bear.jerryblog.cn/bear/fontico/css/font-awesome.min.css"  media="all">
    <link href="/static/admin/bear/css/animate.min.css" rel="stylesheet">
    <!-- <link href="/static/admin/bear/css/font-awesome.min.css?v=4.4.0" rel="stylesheet"> -->
    <link href="/static/admin/bear/plus/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/admin/bear/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/bear/css/bear.css"  media="all">
    <!-- <base target="_blank"> -->
    
</head>




<script type="text/javascript">
  var bearConfig = {
    changeSortUrl        : ''//排序处理的URL
    ,upload_url          : '/sys/post/upload'//附件上传URL
    ,header_url          : "/superadmin/setting/site.html"//当前URL地址
    ,header_url_param    : ""//当前GET参数
  };
</script>

 <div class="row">
<div class="col-sm-12">
<div class="ibox float-e-margins">
        <div class="ibox-title">
        <h5>Bear小熊表单</h5>
        <div class="ibox-tools">
            <a class="dropdown-toggle" data-toggle="dropdown" alt='设置显示字段' href="table_basic.html#">
               <i class="fa fa-cogs" aria-hidden="true"></i>
            </a>
             <a onclick="window.history.go(-1)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                <a onclick="window.location.reload()" href="javascript:;"  alt='刷新'><i class="fa fa-refresh" aria-hidden="true"></i></a>
                <a href="" alt='导出csv'><i class="fa fa-download" aria-hidden="true"></i></a>
                <a onclick="window.history.go(1)"><cite><i class="fa fa-arrow-right" aria-hidden="true"></i></cite></a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="table_basic.html#">选项1</a>
                </li>
                <li><a href="table_basic.html#">选项2</a>
                </li>
            </ul>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
        <div class="ibox-content">
      <div class="col-sm-12"> 
       
 <div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
         
              <div class="col-sm-12"> 
                <form class=" tForm" action="" method="post">
                   
                            
                                                        <!-- ##表单开始 -->
                                                        
                       
                    
                    <input type="hidden" name="token" value="5n77i7fpgEh/vcXruoTL5g==">
                    <input type="hidden" name="validate" value="">
                    <input type="hidden" name="gourl" value="JavaScript:history.go(-1)">
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


         </div>
        </div>
	    </div>
	   
	</div>
</div>
<script src="/static/admin/bear/js/jquery-2.2.4.min.js"></script>
<script src="/static/admin/bear/js/bootstrap.min.js"></script>
<script src="http://bear.jerryblog.cn/bear/plus/layui/layui.all.js" charset="utf-8"></script>
<script src="/static/admin/bear/js/bear.js" charset="utf-8"></script>
<script src="/static/admin/bear/js/bearMethod.js" charset="utf-8"></script>






 
 
<script type="text/javascript">
    var formConfig = {
        upload_url:'/index.php/sys/post/upload'

    }

</script>

<script src="/static/admin/bear/js/bearForm.js" charset="utf-8"></script>
</body>
</html>
<?php }
}
