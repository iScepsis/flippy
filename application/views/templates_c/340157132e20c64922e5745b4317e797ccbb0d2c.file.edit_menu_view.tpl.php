<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:08:22
         compiled from "application\views\templates\admin\edit_menu_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:306656608516924889-64924840%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '340157132e20c64922e5745b4317e797ccbb0d2c' => 
    array (
      0 => 'application\\views\\templates\\admin\\edit_menu_view.tpl',
      1 => 1444760043,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '306656608516924889-64924840',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'menu_base' => 0,
    'menu_sections' => 0,
    'item' => 0,
    'record' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_566085169d06b2_26401213',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566085169d06b2_26401213')) {function content_566085169d06b2_26401213($_smarty_tpl) {?><div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <?php $_smarty_tpl->tpl_vars['menu_base'] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value['menu_edit']['base'], null, 0);?>
        <?php $_smarty_tpl->tpl_vars['menu_sections'] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value['menu_edit']['sections'], null, 0);?>
        <div class="well">
            <h3>Редактирование меню "<?php echo $_smarty_tpl->tpl_vars['menu_base']->value['name_menu'];?>
"</h3>
        </div>

        <div class="edit_menu">
            <p>
                <b>
                    Название меню
                </b>
            </p>
            <input name="menu_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['menu_base']->value['id_menu'];?>
" />
            <input name="tpl_file" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['menu_base']->value['tpl_file'];?>
" />
            <p>
                <input name="menu_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['menu_base']->value['name_menu'];?>
" class="form-control" maxlength="200" width="100%"/>
            </p>
            <p>
                <b>
                    Тип меню
                </b>
            </p>
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1">
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <p>
                        <img src="img/admin/tabs.jpg" alt="Вкладки" />
                    </p>
                    <label>
                        <input type="radio" name="typeMenu" value="1" <?php if (!isset($_smarty_tpl->tpl_vars['menu_base']) || !is_array($_smarty_tpl->tpl_vars['menu_base']->value)) $_smarty_tpl->createLocalArrayVariable('menu_base');
if ($_smarty_tpl->tpl_vars['menu_base']->value['type_menu'] = "tabs") {?>checked=""<?php }?> />
                        <b><i>Вкладки</i></b>
                    </label>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-4">
                    <p>
                        <img src="img/admin/pills.jpg" alt="Кнопки" />
                    </p>
                    <label>
                        <input type="radio" name="typeMenu" value="2" <?php if (!isset($_smarty_tpl->tpl_vars['menu_base']) || !is_array($_smarty_tpl->tpl_vars['menu_base']->value)) $_smarty_tpl->createLocalArrayVariable('menu_base');
if ($_smarty_tpl->tpl_vars['menu_base']->value['type_menu'] = "pills") {?>checked=""<?php }?> />
                        <b><i>Кнопки</i></b>
                    </label>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1">
                </div>

            </div>
            <p>
                <b>
                    Класс меню (необязательно)
                </b>
            </p>
            <p>
                <input name="menu_class" value="<?php echo $_smarty_tpl->tpl_vars['menu_base']->value['class_menu'];?>
" class="form-control" maxlength="200" width="100%"/>
            </p>


            <div class="row">
                <div class="col-md-12">

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Сортировка разделов</h3>
                        </div>
                        <div class="panel-body">
                            <ul id="edit_sections" class="sortable menu_elements nav nav-pills nav-stacked">
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                                    <li class="add-menu-sortable ui-state-default" data-id_section="<?php echo $_smarty_tpl->tpl_vars['item']->value['id_section'];?>
"
                                        data-text_record="<?php echo $_smarty_tpl->tpl_vars['item']->value['name_record'];?>
"
                                        data-fid_record="<?php echo $_smarty_tpl->tpl_vars['item']->value['id_record'];?>
"
                                        data-request_type="<?php echo $_smarty_tpl->tpl_vars['item']->value['fid_rt'];?>
"
                                        data-html_id="<?php echo $_smarty_tpl->tpl_vars['item']->value['html_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name_section'];?>
</li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <p>
                        <button class="btn btn-primary" onclick="create_section();">
                            <b>+ Добавить раздел</b>
                        </button>
                    </p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Удаление разделов</h3>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-dismissible alert-danger">
                                Перетащите удаляемые разделы в блок ниже
                            </div>
                            <ul id="drop_sections" class="menu_elements nav nav-pills nav-stacked">

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="create_section">
                        <p>
                            <b>
                                Название раздела
                            </b>
                        </p>
                        <p>
                            <input name="section_name" class="form-control" onkeyup="change_section_name(this);"
                                   maxlength="200" width="100%"/>
                        </p>
                        <p>
                            <b>
                                Прикрепить запись (выберите из списка)
                            </b>
                        </p>
                        <div class="ui-widget">
                            <select id="combobox" class="fid_record" onchange="change_record_info();">
                                <option value=""></option>
                                <?php  $_smarty_tpl->tpl_vars['record'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['record']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value['records_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['record']->key => $_smarty_tpl->tpl_vars['record']->value) {
$_smarty_tpl->tpl_vars['record']->_loop = true;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['record']->value['id_record'];?>
"><?php echo $_smarty_tpl->tpl_vars['record']->value['name_record'];?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                        <p>
                            id статуса фиксирующийся при выборе раздела (необязательно)
                        </p>
                        <p>
                            <input name="request_type" onkeyup="change_request_type(this);" class="form-control" maxlength="3" width="100%"/>
                        </p>
                        <p>
                            Уникальный идентификатор раздела (необязательно)
                        </p>
                        <p>
                            <input name="html_id" class="form-control" onkeyup="change_html_id(this);" maxlength="200" width="100%"/>
                        </p>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br />
                    <div class="pg-btn-container">
                        <button class="save_menu-btn btn btn-success" onclick="edit_menu(this);">
                            Сохранить меню
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div><?php }} ?>
