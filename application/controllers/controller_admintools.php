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
        $this->checkAccess(9, true);
        $data = $this->model->get_menu();
        $this->view->generate('admin/pages_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_add_pages(){
        $this->checkAccess(9, true);
        $data = $this->model->get_record_and_menus_list();
        $this->view->generate('admin/add_pages_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_edit_page(){
        $this->checkAccess(9, true);
        $data = array();
        $data['page'] = $this->model->get_page_info((int)Route::$params['page']);
        $data['lists'] = $this->model->get_record_and_menus_list();
        $this->view->generate('admin/edit_page_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_records(){
        $this->checkAccess(3, true);
        $data['records'] = $this->model->get_records('creation_date', true);
        $this->view->generate('admin/records_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_users(){
        $this->checkAccess(9, true);
        $data['users'] = $this->model->get_users();
        $this->view->generate('admin/users_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_add_records(){
        $this->checkAccess(3, true);
        $this->view->generate('admin/add_records_view.tpl', 'admin_layout.tpl');
    }

    function action_edit_record(){
        $this->checkAccess(3, true);
        $data['record'] = $this->model->get_record();
        $this->view->generate('admin/edit_record_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_menus_list(){
        $this->checkAccess(3, true);
        $data['menus'] = $this->model->get_menus_list();
        $this->view->generate('admin/menus_list_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_add_menus(){
        $this->checkAccess(3, true);
        $data['records_list'] = $this->model->get_records_list();
        $this->view->generate('admin/add_menus_view.tpl', 'admin_layout.tpl', $data);
    }

    function action_edit_menu(){
        $this->checkAccess(3, true);
        if (!empty(Route::$params['menu'])) {
            $data['records_list'] = $this->model->get_records_list();
            $data['menu_edit'] = $this->model->get_menu_for_edit((int)Route::$params['menu']);
            $this->view->generate('admin/edit_menu_view.tpl', 'admin_layout.tpl', $data);
        }
    }

    function action_add_user(){
        $this->checkAccess(9, true);
        $this->view->generate('admin/add_user_view.tpl', 'admin_layout.tpl');
    }

    function action_edit_user(){
        $this->checkAccess(9, true);
        if (!empty(Route::$params['user'])) {
            $data['user'] = $this->model->get_user_for_edit((int)Route::$params['user']);
            $this->view->generate('admin/edit_user_view.tpl', 'admin_layout.tpl', $data);
        }
    }



    //экшены AJAX-запросов
    function action_save_record(){
        $this->checkAccess(3);
        if (empty($_POST['name_record'])) die("Не указано имя записи");
        if (empty($_POST['text_record'])) die("Не заполнено содержимое записи");

        $record_id = $this->model->save_record($_POST);
        print($record_id);
    }

    function action_update_record(){
        $this->checkAccess(3);
        if (empty($_POST['id_record']))   die("Не указан id записи");
        if (empty($_POST['name_record'])) die("Не указано имя записи");
        if (empty($_POST['text_record'])) die("Не заполнено содержимое записи");

        $result = $this->model->edit_record($_POST);
        print($result);
    }

    function action_drop_record(){
        $this->checkAccess(3);
        if (empty($_POST['id_record'])) die("Не указан id записи");

        $result = $this->model->drop_record($_POST['id_record']);
        print($result);
    }

    function action_create_menu(){
        $this->checkAccess(3);
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
        $this->checkAccess(3);
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
        $this->checkAccess(9);
        if (empty($_POST['login'])) die("Не передан логин пользователя");
        if (empty($_POST['pass']))  die("Не передан пароль");
        if (empty($_POST['role']))  die("Не передана роль пользователя");

        $this->model->create_user($_POST['login'], $_POST['pass'], $_POST['role']);
    }

    function action_update_user(){
        $this->checkAccess(9);
        if (empty($_POST['id']))    die("Не передан id пользователя");
        if (empty($_POST['pass']))  die("Не передан пароль");
        if (empty($_POST['role']))  die("Не передана роль пользователя");

        $this->model->update_user($_POST['id'], $_POST['pass'], $_POST['role']);
    }

    function action_delete_user(){
        $this->checkAccess(9);
        if (empty($_POST['id']))    die("Не передан id пользователя");

        $this->model->delete_user($_POST['id']);
    }
    
    function action_create_page(){
        $this->checkAccess(9);
        if (empty($_POST['p_title']))  die("Не передано название страницы");
        if (empty($_POST['p_view'])) die("Не передано название страницы в адресной строке");
        if (empty($_POST['p_text'])) die("Не передано содержимое страницы");

        if ($this->model->create_page($_POST)) print(1);
    }

    function action_update_page(){
        $this->checkAccess(9);
        if (empty($_POST['p_title']))  die("Не передано название страницы");
        if (empty($_POST['p_view'])) die("Не передано название страницы в адресной строке");
        if (empty($_POST['p_text'])) die("Не передано содержимое страницы");

        if ($this->model->update_page($_POST)) print(1);
    }

    function action_delete_page(){
        $this->checkAccess(9);
        if (empty($_POST['id']))  die("Не передан id страницы");

        if ($this->model->delete_page($_POST['id'])) print(1);
    }

    function action_save_page_sort(){
        $this->checkAccess(9);
        if (empty($_POST['elements'])) die("Не переданы данные о страницах");

        if ($this->model->save_page_sort($_POST)) print(1);
    }

    private function checkAccess($minLevel, $redirect = false){
        switch ($_SESSION['role']) {
            case 'Администратор': $level = 9; break;
            case 'Пользователь': $level = 3; break;  //Другие числа оставлены прозапас, можно пользоваться ими
            default: die("Недопустимая роль пользователя");
        }
        if ($level >= $minLevel) {
            return true;
        } else {
            if ($redirect) {
                $this->view->generate('admin/not_access_view.tpl', 'admin_layout.tpl');
                die();
            } else {
                die("Не достаточный уровень доступа");
            }
        }
    }

}