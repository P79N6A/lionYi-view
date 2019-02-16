<?php
/* Smarty version 3.1.32, created on 2018-09-07 14:35:37
  from 'D:\Users\Administrator\Desktop\web\bear\bear\src\bear\make\template\boot\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b921c39170c07_10790787',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2fced11ea5868855bb2dbba09f732ae54413cd25' => 
    array (
      0 => 'D:\\Users\\Administrator\\Desktop\\web\\bear\\bear\\src\\bear\\make\\template\\boot\\form.tpl',
      1 => 1536137223,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./public/header.tpl' => 1,
    'file:./table/btn.tpl' => 1,
    'file:./form/alert.tpl' => 1,
    'file:./form/hidden.tpl' => 1,
    'file:./form/hr.tpl' => 2,
    'file:./form/text.tpl' => 1,
    'file:./form/textarea.tpl' => 1,
    'file:./form/password.tpl' => 1,
    'file:./form/radio.tpl' => 1,
    'file:./form/checkbox.tpl' => 1,
    'file:./form/switch.tpl' => 1,
    'file:./form/select.tpl' => 1,
    'file:./form/selectgroup.tpl' => 1,
    'file:./form/selectsearch.tpl' => 1,
    'file:./form/date.tpl' => 1,
    'file:./form/img.tpl' => 1,
    'file:./public/footer.tpl' => 1,
  ),
),false)) {
function content_5b921c39170c07_10790787 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '90315b921c38e7c983_01780988';
$_smarty_tpl->_subTemplateRender('file:./public/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
         <?php if (isset($_smarty_tpl->tpl_vars['_topBtn']->value) && $_smarty_tpl->tpl_vars['_topBtn']->value) {?>
        <div class="bars">
            <div class="btn-group hidden-xs" role="group"> 
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_topBtn']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                    <?php $_smarty_tpl->_subTemplateRender('file:./table/btn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
           </div>
           <div class="hr-line-dashed"></div>
           <?php }?>

              <div class="col-sm-12"> 
                <form class=" tForm" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['method']->value)===null||$tmp==='' ? 'post' : $tmp);?>
">
                   
                            
                            <?php if (isset($_smarty_tpl->tpl_vars['_alert']->value)) {
$_smarty_tpl->_subTemplateRender('file:./form/alert.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                            <!-- ##表单开始 -->
                            <?php if (isset($_smarty_tpl->tpl_vars['_form']->value) && count($_smarty_tpl->tpl_vars['_form']->value) > 0) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_form']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                                <?php $_smarty_tpl->_assignInScope('form', $_smarty_tpl->tpl_vars['v']->value);?>

                                    <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'hidden') {?>
                                                                                  <?php $_smarty_tpl->_subTemplateRender('file:./form/hidden.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['v']->value['type'] == 'hr') {?>
                                                                                   <?php $_smarty_tpl->_subTemplateRender('file:./form/hr.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> 
                                    <?php } elseif ($_smarty_tpl->tpl_vars['v']->value['type'] == 'static') {?>
                                                                                    <?php $_smarty_tpl->_subTemplateRender('file:./form/hr.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> 
                                    <?php } else { ?>
                                                                             <div class="form-group <?php echo (($tmp = @$_smarty_tpl->tpl_vars['form']->value['triggerHide'])===null||$tmp==='' ? '' : $tmp);?>
 <?php echo (($tmp = @$_smarty_tpl->tpl_vars['form']->value['triggerShow'])===null||$tmp==='' ? '' : $tmp);?>
">
                                        <label class="font-noraml bear-label label-<?php echo $_smarty_tpl->tpl_vars['form']->value['field'];?>
"><?php echo $_smarty_tpl->tpl_vars['form']->value['title'];?>
</label>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'text') {
$_smarty_tpl->_subTemplateRender('file:./form/text.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'textarea') {
$_smarty_tpl->_subTemplateRender('file:./form/textarea.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'password') {
$_smarty_tpl->_subTemplateRender('file:./form/password.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'radio') {
$_smarty_tpl->_subTemplateRender('file:./form/radio.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'checkbox') {
$_smarty_tpl->_subTemplateRender('file:./form/checkbox.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'switch') {
$_smarty_tpl->_subTemplateRender('file:./form/switch.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'select') {
$_smarty_tpl->_subTemplateRender('file:./form/select.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'selectgroup') {
$_smarty_tpl->_subTemplateRender('file:./form/selectgroup.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'selectsearch') {
$_smarty_tpl->_subTemplateRender('file:./form/selectsearch.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'date') {
$_smarty_tpl->_subTemplateRender('file:./form/date.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <?php if ($_smarty_tpl->tpl_vars['v']->value['type'] == 'img') {
$_smarty_tpl->_subTemplateRender('file:./form/img.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
                                         <span class='bear-tips tips-<?php echo $_smarty_tpl->tpl_vars['form']->value['field'];?>
'><?php echo $_smarty_tpl->tpl_vars['form']->value['param']['tips'];?>
</span>
                                      </div>
                                <?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php }?>
                            
                       
                    
                    <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
                    <input type="hidden" name="validate" value="<?php echo $_smarty_tpl->tpl_vars['validate']->value;?>
">
                    <input type="hidden" name="gourl" value="<?php echo $_smarty_tpl->tpl_vars['goUrl']->value;?>
">
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


<?php $_smarty_tpl->_subTemplateRender('file:./public/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript">
    var formConfig = {
        upload_url:'/index.php/sys/post/upload'

    }

<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="/static/admin/bear/js/bearForm.js" charset="utf-8"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
