<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:05:00
         compiled from "application\views\templates\admin\menus_list_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94085660844c81ca28-53007585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f9469b8b6421f77e767444cd609593bca96f417' => 
    array (
      0 => 'application\\views\\templates\\admin\\menus_list_view.tpl',
      1 => 1443033175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94085660844c81ca28-53007585',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'menus' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5660844c891d44_91820729',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5660844c891d44_91820729')) {function content_5660844c891d44_91820729($_smarty_tpl) {?><div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Список меню</h3>
        </div>

        <?php if (empty($_smarty_tpl->tpl_vars['data']->value['menus'])) {?>
            <h4>Нет доступных меню</h4>
        <?php } else { ?>
            <table id="menus_list" class="table table-striped">
                <thead>
                <tr class="bg-primary">
                    <th>Название меню</th>
                    <th>Тип меню</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php  $_smarty_tpl->tpl_vars['menus'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menus']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menus']->key => $_smarty_tpl->tpl_vars['menus']->value) {
$_smarty_tpl->tpl_vars['menus']->_loop = true;
?>
                    <tr data-menu-id="<?php echo $_smarty_tpl->tpl_vars['menus']->value['id_menu'];?>
" data-menu-name="<?php echo $_smarty_tpl->tpl_vars['menus']->value['name_record'];?>
">
                        <td><a href="admintools/edit_menu/menu/<?php echo $_smarty_tpl->tpl_vars['menus']->value['id_menu'];?>
"><?php echo $_smarty_tpl->tpl_vars['menus']->value['name_menu'];?>
</a></td>
                        <td>
                            <?php if ($_smarty_tpl->tpl_vars['menus']->value['type_menu']=='tabs') {?>Вкладки<?php } elseif ($_smarty_tpl->tpl_vars['menus']->value['type_menu']=='pills') {?>Кнопки<?php }?>
                        </td>
                        <td><a href="admintools/edit_menu/menu/<?php echo $_smarty_tpl->tpl_vars['menus']->value['id_menu'];?>
">Редактировать</a>        </td>
                        <td><p class="drop_menu" onclick="ask_about_drop(this);">Удалить</p>                   </td>
                        <td style="text-align: right">
                            <span class="glyphicon glyphicon-arrow-down" title="Предпросмотр" onclick="show_menu_preview(this, <?php echo $_smarty_tpl->tpl_vars['menus']->value['id_menu'];?>
);"></span>
                            <span class="glyphicon glyphicon-arrow-up" title="Скрыть" onclick="hide_menu_preview(this);" style="display: none;"></span>
                        </td>
                    </tr>
                    <tr style="display:none;">
                        <td colspan="5">
                            <div class="menu_loader">
                                <img src="img/admin/loader.GIF" />
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['menus']->value['type_menu']) {?>
                                <ul class="menu_preview nav nav-tabs">
                            <?php } else { ?>
                                <ul class="menu_preview nav nav-pills">
                            <?php }?>
                                </ul>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php }?>
    </div>
</div><?php }} ?>
