<?php
class View
{
    public $layout_path = 'application/views/templates/layout/';
    public $template_path = 'application/views/templates/';
    public $controller_path = 'application/controllers/';
    public $model_path = 'application/models/';

    /**Генерация вида
     *
     * @param $content_view  - шаблон с данными
     * @param null $layout   - шаблон обертка (меню, футер, хедер и т.п.)
     * @param null $data     - данные
     */
    function generate($content_view, $layout = null, $data = null)
    {
        require_once "./inc/smarty/Smarty.class.php";
        require_once "./inc/classes/smarty_singleton.class.php";

        $smarty = Smarty_Singleton::getInstance();

        if (null === $layout) {
            $layout = 'default_layout.tpl';
        }

        $data['layout']          = $this->load_layout_data($layout); //Загрузка данных для обертки
        $data['controller_name'] = Route::$controller_name;
        $data['action_name']     = Route::$action_name;
        //Пути до шаблона, который будет загружен помимо контента из БД
        $data['template_path']   = $this->template_path;
        $data['content_view']    = $content_view;

        $smarty->assign('data', $data);

        $smarty->display($this->layout_path.$layout);
    }

    /**Загрузка данных для общего шаблона (обертки) - данные меню, виджетов и т.п.
     *
     * @param string $layout - имя шаблона
     */
    private function load_layout_data($layout){
        try {
            $data = null;
            if (!file_exists($this->layout_path . $layout)) {
                throw new Exception("Файл " . $this->layout_path . $layout . " не найден.");
            }
            $arr = explode("/", $layout);
            $layout_filename = array_pop($arr);  //Получаем имя файла со слоем
            $arr = explode("_", $layout_filename);
            $name_postfix = $arr[0];             //Получаем имя постфикса для модели и контроллера слоя
            $file_controller = $this->controller_path."controller_".$name_postfix.".php";
            $file_model = $this->model_path."model_".$name_postfix.".php";

            if (file_exists($file_model)) {
                include_once $file_model;
            }

            if (file_exists($file_controller)) {
                include_once $file_controller;
                $controller_name = "Controller_".ucfirst($name_postfix);
                $controller_layout = new $controller_name;
                $data = $controller_layout->action_index();
            }
            return $data;
        } catch (Exception $e) {
            echo "Ошибка: ". $e->getMessage(). "File: ". $e->getFile() . " Line: ". $e->getLine();
        }

    }
}