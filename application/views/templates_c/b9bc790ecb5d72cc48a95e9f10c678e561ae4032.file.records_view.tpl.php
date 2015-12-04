<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:03:56
         compiled from "application\views\templates\admin\records_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216555660840c553135-78629652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9bc790ecb5d72cc48a95e9f10c678e561ae4032' => 
    array (
      0 => 'application\\views\\templates\\admin\\records_view.tpl',
      1 => 1442653186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216555660840c553135-78629652',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'record' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5660840c5bc8d3_44610218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5660840c5bc8d3_44610218')) {function content_5660840c5bc8d3_44610218($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'G:\\OpenServer\\domains\\localhost\\flippy\\inc\\smarty\\plugins\\modifier.date_format.php';
?><div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Список существующих записей</h3>
        </div>

        <?php if (empty($_smarty_tpl->tpl_vars['data']->value['records'])) {?>
            <h4>Нет доступных записей</h4>
        <?php } else { ?>
        <table id="records_list" class="table table-striped">
            <thead>
                <tr class="bg-primary">
                    <th>Имя записи</th>
                    <th>Имя шаблона</th>
                    <th>Дата создания</th>
                    <th>Создатель</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['record']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['records']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value) {
$_smarty_tpl->tpl_vars['record']->_loop = true;
?>
                    <tr data-record-id="<?php echo $_smarty_tpl->tpl_vars['record']->value['id_record'];?>
" data-record-name="<?php echo $_smarty_tpl->tpl_vars['record']->value['name_record'];?>
">
                        <td><a href="admintools/edit_record/record/<?php echo $_smarty_tpl->tpl_vars['record']->value['id_record'];?>
"><?php echo $_smarty_tpl->tpl_vars['record']->value['name_record'];?>
</a></td>
                        <td><?php echo $_smarty_tpl->tpl_vars['record']->value['tpl_name'];?>
                                                                   </td>
                        <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['record']->value['creation_date'],"%d.%m.%Y %H:%M");?>
                                 </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['record']->value['creator'];?>
                                                                    </td>
                        <td><a href="admintools/edit_record/record/<?php echo $_smarty_tpl->tpl_vars['record']->value['id_record'];?>
">Редактировать</a>        </td>
                        <td><p class="drop_record" onclick="ask_about_drop(this);">Удалить</p>                   </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php }?>
    </div>
</div><?php }} ?>
