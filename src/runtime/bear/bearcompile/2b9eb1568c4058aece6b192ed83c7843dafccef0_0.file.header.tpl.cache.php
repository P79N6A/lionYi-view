<?php
/* Smarty version 3.1.32, created on 2018-09-07 14:21:14
  from 'D:\Users\Administrator\Desktop\web\bear\bear\src\bear\make\template\boot\public\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b9218da8fe580_06329326',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b9eb1568c4058aece6b192ed83c7843dafccef0' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\public\\header.tpl',
      1 => 1536288739,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./_meta.tpl' => 1,
  ),
),false)) {
function content_5b9218da8fe580_06329326 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '269865b9218da8d7480_75360000';
$_smarty_tpl->_subTemplateRender('file:./_meta.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php echo '<script'; ?>
 type="text/javascript">
  var bearConfig = {
    changeSortUrl        : ''//排序处理的URL
    ,upload_url          : '/sys/post/upload'//附件上传URL
    ,header_url          : "<?php echo $_smarty_tpl->tpl_vars['_header']->value['url'];?>
"//当前URL地址
    ,header_url_param    : "<?php echo $_smarty_tpl->tpl_vars['_header']->value['param'];?>
"//当前GET参数
  };
<?php echo '</script'; ?>
>

 <div class="row">
<div class="col-sm-12">
<div class="ibox float-e-margins">
    <?php if (!$_smarty_tpl->tpl_vars['hideTop']->value) {?>
    <div class="ibox-title">
        <h5><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'Bear小熊表单' : $tmp);?>
</h5>
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
    <?php }?>
    <div class="ibox-content">
      <div class="col-sm-12"> 
       <?php }
}
