<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:07:35
         compiled from "application\views\templates\admin\add_menus_view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:220095660844eacc9f6-52603629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23cda400ccfe1460d4edaa929eba5141696d2318' => 
    array (
      0 => 'application\\views\\templates\\admin\\add_menus_view.tpl',
      1 => 1449166052,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '220095660844eacc9f6-52603629',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5660844eb1ea83_71177671',
  'variables' => 
  array (
    'data' => 0,
    'record' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5660844eb1ea83_71177671')) {function content_5660844eb1ea83_71177671($_smarty_tpl) {?><div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
            <h3>Добавление меню</h3>
        </div>

        <div class="add_menu">
            <!-- Шаг 1 -->
            <div class="step_one">
                <p>
                    <b>
                        Название меню
                    </b>
                </p>
                <p>
                    <input name="menu_name" class="form-control" maxlength="200" width="100%"/>
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
                            <input type="radio" name="typeMenu" value="1" checked="" />
                            <b><i>Вкладки</i></b>
                        </label>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <p>
                            <img src="img/admin/pills.jpg" alt="Кнопки" />
                        </p>
                        <label>
                            <input type="radio" name="typeMenu" value="2"/>
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
                    <input name="menu_class" class="form-control" maxlength="200" width="100%"/>
                </p>
                <p>
                    <button class="btn btn-success" onclick="show_step_two(this);">
                        Далее >>
                    </button>
                </p>
            </div>
            <!-- Шаг 2 -->
            <div class="step_two" style="display: none">
                <div class="alert alert-dismissible alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    Добавьте разделы для меню (необязательно, можно сделать позже)
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Сортировка разделов</h3>
                            </div>
                            <div class="panel-body">
                                <ul id="edit_sections" class="menu_elements sortable nav nav-pills nav-stacked">

                                </ul>
                            </div>
                        </div>
                        <p>
                            <button class="btn btn-primary btn-create-section" onclick="create_section();">
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
				
				<div>
					<div class="col-lg-12 col-md-12 col-sm-12">
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
                        <div class="pg-btn-container">
                            <button class="save_menu-btn btn btn-success" onclick="save_menu();">
                                Сохранить меню
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><?php }} ?>
