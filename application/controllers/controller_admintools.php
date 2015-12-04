<?php
session_start();
$_SESSION['user_name'] = 'dev';

class Controller_AdminTools extends Controller
{

    function __construct()
    {
        $this->model = new Model_AdminTools();
        $this->view  = new View();

    }

    function action_index()
    {
        $this->view->generate('admin/admin_view.tpl', 'admin_layout.tpl');
    }

    function action_pages(){
        $data = $this->model->get_menu();
        $this->view->generate('admin/pages_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_records(){
        $data['records'] = $this->model->get_records('creation_date', true);
        $this->view->generate('admin/records_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_add_records(){
        $this->view->generate('admin/add_records_view.tpl', 'admin_layout.tpl');
    }

    function action_edit_record(){
        $data['record'] = $this->model->get_record();
        $this->view->generate('admin/edit_record_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_menus_list(){
        $data['menus'] = $this->model->get_menus_list();
        $this->view->generate('admin/menus_list_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_add_menus(){
        $data['records_list'] = $this->model->get_records_list();
        $this->view->generate('admin/add_menus_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_edit_menu(){
        if (!empty(Route::$params['menu'])) {
            $data['records_list'] = $this->model->get_records_list();
            $data['menu_edit'] = $this->model->get_menu_for_edit((int)Route::$params['menu']);
            $this->view->generate('admin/edit_menu_view.tpl', 'admin_layout.tpl', $data);
        }
    }



    //экшены AJAX-запросов
    function action_save_record(){
        if (empty($_POST['name_record'])) die("Не указано имя записи");
        if (empty($_POST['text_record'])) die("Не заполнено содержимое записи");

        $record_id = $this->model->save_record($_POST);
        print($record_id);
    }

    function action_update_record(){
        if (empty($_POST['id_record']))   die("Не указан id записи");
        if (empty($_POST['name_record'])) die("Не указано имя записи");
        if (empty($_POST['text_record'])) die("Не заполнено содержимое записи");

        $result = $this->model->edit_record($_POST);
        print($result);
    }

    function action_drop_record(){
        if (empty($_POST['id_record'])) die("Не указан id записи");

        $result = $this->model->drop_record($_POST['id_record']);
        print($result);
    }

    function action_create_menu(){
        if (empty($_POST['menu_id']))   die("Не передан id меню");
        if (empty($_POST['menu_name'])) die("Не передано название меню");
        if (empty($_POST['typeMenu']))  die("Не передан тип меню");
        if (empty($_POST['sections']))  die("Нет идентификатора меню");

        foreach ($_POST['sections'] as $item) {
            if (empty($item['section_name'])) exit('Ошибка, недостаточно данных в массиве');
        }

        if ($result = $this->model->create_menu($_POST)) {
            print("Меню успешно создано");
        }
    }

    function action_update_menu(){
        if (empty($_POST['menu_id']))   die("Не передан id меню");
        if (empty($_POST['menu_name'])) die("Не передано название меню");
        if (empty($_POST['typeMenu']))  die("Не передан тип меню");
        if (empty($_POST['sections']))  die("Нет идентификатора меню");


        if ($result = $this->model->update_menu($_POST)) {
            print("Меню успешно обновлено");
        }
    }

    function action_show_menu_preview(){
        if (empty($_POST['menu_fid'])) {
            exit("Не передан id меню");
        }
        $data = $this->model->show_menu_preview($_POST['menu_fid']);
        return $data;
    }



}