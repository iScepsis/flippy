<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-12-03 21:03:34
         compiled from "application\views\templates\block\head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8591566083f6efadd5-91884834%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f3d14b68123c6ae3ced402fd38a29c4c06903b6' => 
    array (
      0 => 'application\\views\\templates\\block\\head.tpl',
      1 => 1435681715,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8591566083f6efadd5-91884834',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_566083f6f0e651_14641983',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_566083f6f0e651_14641983')) {function content_566083f6f0e651_14641983($_smarty_tpl) {?>    <head>
        <title>
            <?php echo $_smarty_tpl->tpl_vars['data']->value['page']['p_title'];?>

        </title>

        
        <base href="http://localhost/flippy/">

        <meta http-equiv="Content-Type" content="application/javascript; charset=utf-8">
        <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['data']->value['page']['meta_key'];?>
">
        <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['data']->value['page']['meta_description'];?>
">

        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.min.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.structure.min.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery-ui.theme.min.css" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-ui.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/script.js"><?php echo '</script'; ?>
>
    </head><?php }} ?>
