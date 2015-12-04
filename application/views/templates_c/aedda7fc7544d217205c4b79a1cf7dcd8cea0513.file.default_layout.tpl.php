<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:03:34
         compiled from "application\views\templates\layout\default_layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10478566083f6e666b8-42304251%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aedda7fc7544d217205c4b79a1cf7dcd8cea0513' => 
    array (
      0 => 'application\\views\\templates\\layout\\default_layout.tpl',
      1 => 1442653186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10478566083f6e666b8-42304251',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_566083f6ee7555_20625097',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566083f6ee7555_20625097')) {function content_566083f6ee7555_20625097($_smarty_tpl) {?><html>
<head>
    <?php echo $_smarty_tpl->getSubTemplate ("application/views/templates/block/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</head>
<body>
<div class="container base-container">
    <div class="row">
        <header class="page-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1>Пример заголовка страницы <small>Дополнительный текст</small></h1>
        </header>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <?php echo $_smarty_tpl->getSubTemplate ("../block/vertical_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <!-- Вывод текстра страницы из БД, если таковой имеется -->
            <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['page']['p_text'])) {?>
                <?php echo $_smarty_tpl->tpl_vars['data']->value['page']['p_text'];?>

            <?php }?>

            <!-- Вывод содержимого страницы из шаблона -->
            <div class="template_view">
                <?php $_smarty_tpl->tpl_vars['template_file'] = new Smarty_variable(($_smarty_tpl->tpl_vars['data']->value['template_path']).($_smarty_tpl->tpl_vars['data']->value['content_view']), null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['template_file']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </div>
        </div>
    </div>
    <div class="row">
        <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Футер</h3>
        </footer>
    </div>
</div>
</body>
</html><?php }} ?>
