<?php
/* Smarty version 3.1.32, created on 2018-09-07 14:35:37
  from 'D:\Users\Administrator\Desktop\web\bear\bear\src\bear\make\template\boot\public\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b921c39326404_13813523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db22710b9b942ddaa6fc0210b2af53d0cbf58cf8' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\public\\footer.tpl',
      1 => 1535684038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b921c39326404_13813523 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '254975b921c39307004_88339598';
?>
         </div>
        </div>
	    </div>
	   
	</div>
</div>
<?php echo '<script'; ?>
 src="/static/admin/bear/js/jquery-2.2.4.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/static/admin/bear/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['static_host']->value;?>
plus/layui/layui.all.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/static/admin/bear/js/bear.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/static/admin/bear/js/bearMethod.js" charset="utf-8"><?php echo '</script'; ?>
>
<?php if (isset($_smarty_tpl->tpl_vars['_form_types']->value['switch'])) {?>
    <?php echo '<script'; ?>
 src="/static/admin/bear/plus/bootstrap-switch/js/bootstrap-switch.min.js" charset="utf-8"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
    $('.bear-switch input').bootstrapSwitch();
//     $(".bear-switch").on('switch-change', function (e, data) {
//     var $el = $(data.el)
//       , value = data.value;
//     console.log(e, $el, value);
// });
    <?php echo '</script'; ?>
>
<?php }?>






 
 <?php }
}
