<?php
//База данных
define('DB_NAME', 'flippy.db');
define('DB_PATH', "inc/");

//Smarty
define('SMARTY_TEMPLATE_DIR','./application/views/templates');
define('SMARTY_COMPILE_DIR', './application/views/templates_c');
define('SMARTY_CACHE_DIR',   './inc/smarty/cache');
define('SMARTY_CONFIG_DIR',  './inc/smarty/config');

//Время жизни сессий
ini_set('session.gc_maxlifetime', 21600);
ini_set('session.cookie_lifetime', 21600);