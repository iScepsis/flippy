<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:03:35
         compiled from "G:\OpenServer\domains\localhost\flippy\application\views\templates\block\vertical_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3100566083f7054df7-15592082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '162878cf9c33078e3eed62c684155be3159cec71' => 
    array (
      0 => 'G:\\OpenServer\\domains\\localhost\\flippy\\application\\views\\templates\\block\\vertical_menu.tpl',
      1 => 1436016211,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3100566083f7054df7-15592082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_566083f7078087_57715224',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566083f7078087_57715224')) {function content_566083f7078087_57715224($_smarty_tpl) {?><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
    <ul class="nav nav-pills nav-stacked" style="max-width: 260px">
        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['layout']['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
            <li <?php if ($_smarty_tpl->tpl_vars['data']->value['layout']['menu'][$_smarty_tpl->tpl_vars['key']->value]['p_view']==$_smarty_tpl->tpl_vars['data']->value['controller_name']) {?> class="active" <?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['data']->value['layout']['menu'][$_smarty_tpl->tpl_vars['key']->value]['p_view'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['data']->value['layout']['menu'][$_smarty_tpl->tpl_vars['key']->value]['p_title'];?>

                </a>
            </li>
        <?php } ?>
    </ul>
</div><?php }} ?>
