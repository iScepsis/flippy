<?php
require_once 'inc/config.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'inc/classes/db.class.php';    //база данных
require_once 'inc/classes/smarty_singleton.class.php';
include_once 'inc/functions.php';
Route::start(); // запускаем маршрутизатор