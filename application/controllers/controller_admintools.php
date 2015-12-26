<?php

class Controller_AdminTools extends Controller
{

    function __construct()
    {
        session_start();

        $this->view  = new View();
        $this->model = new Model_AdminTools();

        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $this->LogIn();
        }

        if (empty($_SESSION['login'])) {
            $this->action_auth();
        }
    }

    function action_index()
    {
        $this->view->generate('admin/admin_view.tpl', 'admin_layout.tpl');
    }

    function action_auth(){
        $this->view->generate('admin/auth_view.tpl', 'auth_layout.tpl');
        die();
    }

    function action_logout(){
        session_destroy();
        $this->view->generate('admin/auth_view.tpl', 'auth_layout.tpl');
    }

    private function logIn(){
        if (empty($_POST['login'])) die("Не указан логин");
        if (empty($_POST['password'])) die("Не указан пароль");

        if ($this->model->auth_user($_POST['login'], $_POST['password'])) {
            $this->view->generate('admin/admin_view.tpl', 'admin_layout.tpl');
        } else {
            $this->view->generate('admin/auth_view.tpl', 'auth_layout.tpl', array('denied' => true));
        }
        die();
    }

    function action_pages(){
        $data = $this->model->get_menu();
        $this->view->generate('admin/pages_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_records(){
        $data['records'] = $this->model->get_records('creation_date', true);
        $this->view->generate('admin/records_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_users(){
        $data['users'] = $this->model->get_users();
        $this->view->generate('admin/users_view.tpl', 'admin_layout.tpl', $data);
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

    function action_add_user(){
        $this->view->generate('admin/add_user_view.tpl', 'admin_layout.tpl');
    }

    function action_edit_user(){
        if (!empty(Route::$params['user'])) {
            $data['user'] = $this->model->get_user_for_edit((int)Route::$params['user']);
            $this->view->generate('admin/edit_user_view.tpl', 'admin_layout.tpl', $data);
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

    function action_create_user(){
        if (empty($_POST['login'])) die("Не передан логин пользователя");
        if (empty($_POST['pass']))  die("Не передан пароль");
        if (empty($_POST['role']))  die("Не передана роль пользователя");

        $this->model->create_user($_POST['login'], $_POST['pass'], $_POST['role']);
    }

    function action_update_user(){
        if (empty($_POST['id']))    die("Не передан id пользователя");
        if (empty($_POST['pass']))  die("Не передан пароль");
        if (empty($_POST['role']))  die("Не передана роль пользователя");

        $this->model->update_user($_POST['id'], $_POST['pass'], $_POST['role']);
    }

    function action_delete_user(){
        if (empty($_POST['id']))    die("Не передан id пользователя");

        $this->model->delete_user($_POST['id']);
    }

}