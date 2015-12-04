<?php
/**
 * Created by PhpStorm.
 * User: SepsiS
 * Date: 21.06.2015
 * Time: 20:52
 */

class Smarty_Singleton{
    protected static $_instance;

    private function __construct() {
    }

    private function __clone(){
    }

    /**
     * Статическая функция, которая возвращает
     * экземпляр класса или создает новый при
     * необходимости
     * @return Smarty
     */
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new Smarty();
            self::$_instance->template_dir = SMARTY_TEMPLATE_DIR;
            self::$_instance->compile_dir  = SMARTY_COMPILE_DIR;
            self::$_instance->cache_dir    = SMARTY_CACHE_DIR;
            self::$_instance->config_dir   = SMARTY_CONFIG_DIR;
        }
        return self::$_instance;
    }
} 