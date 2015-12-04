<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:03:52
         compiled from "application\views\templates\layout\admin_layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94325660840814adf0-25207040%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2ecbdd0042ce5a35b0fe78d71231cec28d6b922' => 
    array (
      0 => 'application\\views\\templates\\layout\\admin_layout.tpl',
      1 => 1442653186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94325660840814adf0-25207040',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_566084081b8416_72631079',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566084081b8416_72631079')) {function content_566084081b8416_72631079($_smarty_tpl) {?><html>
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("application/views/templates/block/admin_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
<body>
<div class="container base-container">
    <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="admintools/">Админка</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Записи<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admintools/records/">Список записей</a></li>
                                <li><a href="admintools/add_records/">Добавить запись</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Навигация<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admintools/menus_list/">Список меню</a></li>
                                <li><a href="admintools/add_menus/">Добавить меню</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Редактор <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="admintools/pages/">Страницы</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- Вывод содержимого страницы из шаблона -->
                <div class="template_view">
                    <?php $_smarty_tpl->tpl_vars['template_file'] = new Smarty_variable(($_smarty_tpl->tpl_vars['data']->value['template_path']).($_smarty_tpl->tpl_vars['data']->value['content_view']), null, 0);?>
                    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['template_file']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </div>
            </div>
    </div>
</div>

<!-- Диалоговое окно alert -->
<div class="modal alert-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_dialog();">
                    ×
                </button>
                <h4 class="modal-title">Информация</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="close_dialog();">
                    OK
                </button>
                <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>

<!-- Диалоговое окно confirm -->
<div id="confirm-modal" class="modal confirm-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_dialog();">
                    ×
                </button>
                <h4 class="modal-title">Информация</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="submit-btn btn btn-success" data-dismiss="modal">
                    Подтвердить
                </button>

                <button type="button" class="abort-btn btn btn-default" data-dismiss="modal">
                    Отмена
                </button>
                <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
</body>
</html><?php }} ?>
