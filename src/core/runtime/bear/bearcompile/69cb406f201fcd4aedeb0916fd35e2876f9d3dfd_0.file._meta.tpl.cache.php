<?php
/* Smarty version 3.1.32, created on 2018-09-07 14:35:37
  from 'D:\Users\Administrator\Desktop\web\bear\bear\src\bear\make\template\boot\public\_meta.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b921c392ad288_63543376',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '69cb406f201fcd4aedeb0916fd35e2876f9d3dfd' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\public\\_meta.tpl',
      1 => 1535956291,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b921c392ad288_63543376 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '256825b921c3928de87_52167034';
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="JerryChen">
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'Bear小熊表单' : $tmp);?>
-后台管理-powerby-bear小熊</title>
    <meta name="keywords" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'Bear小熊表单' : $tmp);?>
-后台管理-powerby-bear小熊">
    <meta name="description" content="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? 'Bear小熊表单' : $tmp);?>
-后台管理-powerby-bear小熊">

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="/static/admin/bear/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['static_host']->value;?>
fontico/css/font-awesome.min.css"  media="all">
    <link href="/static/admin/bear/css/animate.min.css" rel="stylesheet">
    <!-- <link href="/static/admin/bear/css/font-awesome.min.css?v=4.4.0" rel="stylesheet"> -->
    <link href="/static/admin/bear/plus/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/admin/bear/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/bear/css/bear.css"  media="all">
    <!-- <base target="_blank"> -->
    <?php if (isset($_smarty_tpl->tpl_vars['_form_types']->value['switch'])) {?>
        <link href="/static/admin/bear/plus/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
    <?php }?>

</head>


<?php }
}
