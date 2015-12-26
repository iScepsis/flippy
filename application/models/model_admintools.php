<?php
class Model_AdminTools extends Model
{
    public $db;

    //Сохранение записи
    public $sql_save_record = "INSERT INTO records( name_record,  tpl_name,  text_record,  creation_date,  creator)
                                            VALUES(:name_record, :tpl_name, :text_record, :creation_date, :creator) ";

    //Получение данных записи для редактирования
    public $sql_get_record_for_update = "SELECT id_record, name_record,  tpl_name,  text_record FROM records
                                                WHERE id_record = :id_record";

    //Обновление записи
    public $sql_update_record = "UPDATE records SET name_record = :name_record,  tpl_name = :tpl_name,
                                                    text_record = :text_record, creation_date = :creation_date ,
                                                    creator = :creator
                                        WHERE id_record = :id_record";

    //Удаление записи
    public $sql_drop_record = "DELETE FROM records WHERE id_record = :id_record";

    //Получение имени шаблона
    public $sql_get_tpl_name = "SELECT tpl_name FROM records WHERE id_record = :id_record";

    //Получение данных для меню в разделе страниц
    public $sql_get_page_menu = "SELECT p_id, p_view, p_title, m_id FROM pages
                                 INNER JOIN meta ON m_id = p_meta_fid";

    //Получение списка записей для добавления разделов
    public $sql_get_records_list = "SELECT id_record, name_record FROM records ORDER BY creation_date DESC";

    public $sql_create_menu = "INSERT INTO menus(name_menu, type_menu, tpl_file, class_menu) VALUES (:name_menu, :type_menu, :tpl_file, :class_menu)";

    public $sql_create_section = "INSERT INTO menus_sections(id_section, fid_menu,
                                                             name_section, fid_record,
                                                             sort_section, fid_rt, html_id)
                                                VALUES (
                                                             :id_section, :fid_menu,
                                                             :name_section, :fid_record,
                                                             :sort_section, :fid_rt, :html_id
                                                        )";

    public $sql_get_menus_list = "SELECT id_menu, name_menu, type_menu FROM menus ORDER BY id_menu DESC";

    public $sql_show_menu_preview = "SELECT name_section FROM menus_sections WHERE fid_menu = :fid_menu ORDER BY sort_section";

    public $sql_get_menu_for_edit = "SELECT * FROM menus WHERE id_menu = :id_menu";

    public $sql_get_menu_elements_for_edit = "SELECT m.*, r.id_record, r.name_record FROM menus_sections m
                                                  LEFT JOIN records r ON fid_record = id_record
                                                  WHERE fid_menu = :fid_menu ORDER BY sort_section";

    public $sql_update_menu = "UPDATE menus SET name_menu = :name_menu,
                                                type_menu = :type_menu,
                                                tpl_file = :tpl_file,
                                                class_menu = :class_menu WHERE id_menu = :id_menu";

    public $sql_update_section = "UPDATE menus_sections SET fid_menu = :fid_menu, name_section = :name_section,
                                                            fid_record = :fid_record, sort_section = :sort_section,
                                                            fid_rt = :fid_rt, html_id = :html_id
                                                WHERE id_section = :id_section";

    public $sql_delete_section = "DELETE FROM menus_sections WHERE id_section = :id_section";

    public $sql_get_users = "SELECT * FROM users ORDER BY login, role";

    private $sql_auth_user = "SELECT role FROM users WHERE login = :login AND password = :password";

    private $sql_get_user_for_edit = "SELECT id_user, login, role FROM users WHERE id_user = :id_user";

    private $sql_check_repeat_login = "SELECT id_user FROM users WHERE login = :login";

    private $sql_create_user = "INSERT INTO users(login, password, role) VALUES (:login, :password, :role)";

    private $sql_update_user = "UPDATE users SET password = :password, role = :role WHERE id_user = :id";

    private $sql_delete_user = "DELETE FROM users WHERE id_user = :id";


    public function __construct(){
        $this->db = Db::getInstance();
    }

    public function auth_user($login, $pass){
        $query = $this->db->get_elements($this->sql_auth_user, array('login' => $login, 'password' => sha1($pass)));
        if ($query && $query[0]['role']) {
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $query[0]['role'];
            return true;
        } else
            return false;
    }

    /**
     * Получение данных для меню
     * @return mixed
     */
    public function get_menu()
    {
        $query = $this->db->get_elements($this->sql_get_page_menu);
        $data['page'] = $query;
        return $data;
    }

    /**
     * Получение списка записей
     *
     * @param $order_by string - название поля по которому будет производиться сортировка
     * @param $desc boolean - сортировать ли по убыванию
     * @return array|string
     */
    public function get_records($order_by, $desc = null){
        $query = "SELECT id_record,name_record, tpl_name, creation_date, creator
                        FROM records ORDER BY ".$order_by;
        if (!is_null($desc)) {
            $query .= " DESC";
        }
        $data = $this->db->get_elements($query);
        return $data;
    }

    /**
     * Получение записи для дальнейшего редактирования
     *
     * @return mixed
     */
    public function get_record(){
        $params = array('id_record' => Route::$params['record']);

        $data = $this->db->get_elements($this->sql_get_record_for_update, $params);
        $tpl_file = 'application/views/templates/records/' . $data[0]['tpl_name'] . '.tpl';
        //Загружаем содержимое шаблона, если таковой имеется
        if (file_exists($tpl_file)) {
            $tpl_text = file_get_contents($tpl_file);
            $data[0]['tpl_text'] = $tpl_text;
        }
        return $data[0];
    }

    /**
     * Сохранение записи в БД
     *
     * @param $data - массив с данными для записи
     * @return string - id созданной записи
     */
    public function save_record($data){
        if (empty($data['tpl_name'])) {
            $data['tpl_name'] = $data['name_record'];
        }

        if (strlen($data['tpl_name']) < 3) return "Имя шаблона должно сотоять не менее чем из 3 символов";
        $data['tpl_name'] = strtolower(transliterate($data['tpl_name']));
        $data['tpl_name'] = str_replace(array(' ', '-', ',', '.'), '_', $data['tpl_name']);
        $tpl_file = 'application/views/templates/records/' . $data['tpl_name'] . '.tpl';

        //Запись шаблона
        if (file_exists($tpl_file)) {
            return "Файл с названием " . $data['tpl_name'] . ".tpl" . " уже существует";
        } else {
            $handle = fopen($tpl_file, "w");
            fwrite($handle, $data['text_record']);
            fclose($handle);
        }

        //Запись в БД
        $params = array('name_record'   => $data['name_record'],
                        'tpl_name'      => $data['tpl_name'],
                        'text_record'   => $data['text_record'],
                        'creation_date' => time(),
                        'creator'       => $_SESSION['user_name'],
        );

        $query = $this->db->sql_execute($this->sql_save_record, $params);
        return $query;
    }

    /**
     * Обновление записи
     *
     * @param $data - параметры переданные через $_POST
     * @return array|int|string - в случае успеха, вернет 1
     */
    public function edit_record($data){
        //Получаем данные о предудущей версии записи из БД
        $old_record = $this->db->get_elements($this->sql_get_record_for_update,
                                                array('id_record' => $data['id_record'])
                                              );
        $old_record = $old_record[0];

        //Если шаблон отсутствует как в БД, так и в отправленной форме, создаем его
        if (empty($data['tpl_name']) && empty($old_record['tpl_name'])) {
            $data['tpl_name'] = $data['name_record'];
            if (strlen($data['tpl_name']) < 3) return "Имя шаблона должно сотоять не менее чем из 3 символов";
            $data['tpl_name'] = transliterate($data['tpl_name']);
            $tpl_file = 'application/views/templates/records/' . $data['tpl_name'] . '.tpl';
            if (file_exists($tpl_file)) {
                return "Файл с названием " . $data['tpl_name'] . ".tpl" . " уже используется для другой записи";
            }
        }
        //Если в БД шаблон записан, но не передан в форме
        elseif (!empty($old_record['tpl_name']) && empty($data['tpl_name'])) {
            $tpl_file = 'application/views/templates/records/' . $old_record['tpl_name'] . '.tpl';
        }
        //Если шаблон записан в БД и передан в форме, но имена не совпадают, переименовываем
        elseif ($old_record['tpl_name'] != $data['tpl_name']) {
            $old_tpl = 'application/views/templates/records/' . $old_record['tpl_name'] . '.tpl';
            $tpl_file = 'application/views/templates/records/' . $data['tpl_name'] . '.tpl';
            if (file_exists($old_tpl)) {
                rename($old_tpl, $tpl_file);
            }
        } else {
            $tpl_file = 'application/views/templates/records/' . $data['tpl_name'] . '.tpl';
        }

        //Обновляем шаблон, содержимым из присланной формы
        $handle = fopen($tpl_file, "w");
        fwrite($handle, $data['text_record']);
        fclose($handle);
        //Обновляем информацию в БД
        $params = array(
            'id_record'     => $data['id_record'],
            'name_record'   => $data['name_record'],
            'tpl_name'      => $data['tpl_name'],
            'text_record'   => $data['text_record'],
            'creation_date' => time(),
            'creator'       => $_SESSION['user_name'],
        );

        $query = $this->db->sql_execute($this->sql_update_record, $params);
        return $query;
    }

    /**
     * Удаление записи
     *
     * @param $id_record - id удаляемой записи
     * @return int|string - 1 в случае успеха
     */
    public function drop_record($id_record){
        try {
            $tpl_name = $this->db->get_elements($this->sql_get_tpl_name, array('id_record' => $id_record));
            $tpl_name = $tpl_name[0];
            $tpl_file = 'application/views/templates/records/' . $tpl_name['tpl_name'] . '.tpl';
            $this->db->sql_execute($this->sql_drop_record, array('id_record' => $id_record));
            if (file_exists($tpl_file)) {
                unlink($tpl_file);
            }
            return 1;
        } catch (Exception $e) {
            return "Ошибка: ". $e->getMessage(). "File: ". $e->getFile() . " Line: ". $e->getLine();
        }
    }

    /**
     * Получение списка записей для добавления разделов
     * @return array|string
     */
    public function get_records_list(){
        $data = $this->db->get_elements($this->sql_get_records_list);
        return $data;
    }

    /**
     * Создание меню
     * @param $data array - $_POST массив с параметрами
     * @return string
     */
    public function create_menu($data){

        //Создание имени шаблона
        $tpl_name = strtolower(transliterate($data['menu_name']));
        $tpl_name = str_replace(array(' ', '-', ',', '.'), '_', $tpl_name);
        $tpl_file = 'application/views/templates/menus/' . $tpl_name . '.tpl';

        if (file_exists($tpl_file)) {
            $tpl_file = 'application/views/templates/menus/' . $tpl_name . '_' . time() . '.tpl';
        }

        switch ($data['typeMenu']) {
            case "1":
                $type_menu = 'tabs';
                $menu_content = $this->create_tab_menu_tpl($data, $tpl_name, $tpl_file);
                break;
            case "2":
                $type_menu = 'pills';
                $menu_content = $this->create_pills_menu_tpl($data, $tpl_name, $tpl_file);
                break;
            default:
                exit("Не определен тип меню");
        }

        $handle = fopen($tpl_file, "w");
        fwrite($handle, $menu_content);
        fclose($handle);

        //Запись в БД
        $params = array('name_menu' => $data['menu_name'],
                        'type_menu' => $type_menu,
                        'class_menu' => $data['menu_class'],
                        'tpl_file'  => $tpl_file);

        $menu_id = $this->db->sql_execute($this->sql_create_menu, $params);

        if (!$menu_id) {
            exit('Не удалось создать меню');
        }

        foreach ($data['sections'] as $item){
            $params = array('fid_menu' => $menu_id,
                'name_section' => $item['section_name'],
                'fid_record' => $item['fid_record'],
                'sort_section' => $item['section_sort'],
                'fid_rt' => $item['request_type'],
                'html_id' => $item['html_id']);
            $result = $this->db->sql_execute($this->sql_create_section, $params);

            if (!$result) {
                exit('Не удалось создать раздел');
            }
        }
        return true;
    }

    /**
     * Обновление меню
     * @param $data array - $_POST массив с параметрами
     * @return string
     */
    public function update_menu($data){
        //Получаем содержимое файла, что бы в случае ошибки перешел откат к ранней версии
        if (file_exists($data['tpl_file'])) {
            $file_content = file_get_contents($data['tpl_file']);
        } else {
            exit('Не найден файл с меню');
        }
        try {
            //Получаем название шаблона из пути до него
            $tpl = explode("/", $data['tpl_file']);
            $tpl_name = str_replace(".tpl", "", array_pop($tpl));
            switch ($data['typeMenu']) {
                case "1":
                    $type_menu = 'tabs';
                    $menu_content = $this->create_tab_menu_tpl($data, $tpl_name);
                    break;
                case "2":
                    $type_menu = 'pills';
                    $menu_content = $this->create_pills_menu_tpl($data, $tpl_name);
                    break;
                default:
                    throw new Exception("Не определен тип меню");
            }

            $handle = fopen($data['tpl_file'], "w");
            fwrite($handle, $menu_content);
            fclose($handle);

            //Запись в БД
            $params = array('name_menu' => $data['menu_name'],
                'type_menu' => $type_menu,
                'class_menu' => $data['menu_class'],
                'tpl_file' => $data['tpl_file']);

            $update = $this->db->sql_execute($this->sql_update_menu, $params);

            if (!$update) {
                throw new Exception('Не удалось обновить меню');
            }

            //Редактируем секции
            foreach ($data['sections'] as $item) {
                //проверяем, есть ли разделы для удаления
                if (!empty($item['deleted'])) {
                    if (empty($item['id_section'])) {
                        throw new Exception('Не удалось удалить раздел');
                    } else {
                        $this->db->sql_execute($this->sql_delete_section, array('id_section' => $item['id_section']));
                        continue;
                    }
                }

                $params = array(
                    'fid_menu' => $data['menu_id'],
                    'name_section' => $item['section_name'],
                    'fid_record' => $item['fid_record'],
                    'sort_section' => $item['section_sort'],
                    'fid_rt' => $item['request_type'],
                    'html_id' => $item['html_id']);
                //Если есть id, это старая секция - обновляем, если нет - новая, добавляем
                if ($item['id_section']) {
                    $params['id_section'] = $item['id_section'];
                    $result = $this->db->sql_execute($this->sql_update_section, $params);
                } else {
                    $result = $this->db->sql_execute($this->sql_create_section, $params);
                }

                if (!$result) {
                    throw new Exception('Не удалось обновить раздел');
                }
            }
            return true;
        } catch (Exception $e){
            //Откатываемся к более ранней версии шаблона
            $handle = fopen($data['tpl_file'], "w");
            fwrite($handle, $file_content);
            fclose($handle);
            print("Ошибка: " . $e->getMessage());
        }
    }

    /** Получение списка меню
     *
     * @return array|string
     */
    public function get_menus_list(){
        $data = $this->db->get_elements($this->sql_get_menus_list);
        return $data;
    }

    /** Выбор имен разделов для превью меню
     *
     * @param $fid_menu
     */
    public function show_menu_preview($fid_menu){
        $data = $this->db->get_elements($this->sql_show_menu_preview, array('fid_menu' => $fid_menu));
        if ($data) {
            print(json_encode($data));
        } else {
            echo "Не удалось получить данные";
        }
    }

    /** Редактирование меню
     *
     * @param $menu_id - id меню, которое будет редактироваться
     */
    public function get_menu_for_edit($menu_id){
        $data['base'] = $this->db->get_elements($this->sql_get_menu_for_edit, array('id_menu' => $menu_id));
        $data['base'] = $data['base'][0];
        $data['sections'] = $this->db->get_elements($this->sql_get_menu_elements_for_edit, array('fid_menu' => $menu_id));
        $data['records_list'] = $this->db->get_elements($this->sql_get_records_list);
        return $data;
    }

    /**Получаем список пользователей для редактирования или удаления
     *
     * @return array|string
     */
    public function get_users() {
        $data = $this->db->get_elements($this->sql_get_users);
        return $data;
    }

    /**Получаем данные для редактирования пользователя
     *
     * @param $id_user
     * @return array|string
     */
    public function get_user_for_edit($id_user){
        $data = $this->db->get_elements($this->sql_get_user_for_edit, array('id_user' => $id_user));
        return $data[0];
    }

    /**Создание нового пользователя
     *
     * @param $login - логин
     * @param $pass - пароль (пароль будет зашифрован в sha1)
     * @param $role - роль пользователя
     */
    public function create_user($login, $pass, $role){
        $find_repeat = $this->db->get_elements($this->sql_check_repeat_login, array('login' => $login));
        if (count($find_repeat) > 0) {
            die("<p class='text-danger'>Пользователь с логином <b class='text-warning'>" . $login . "</b> уже существует</p>");
        }

        $result = $this->db->sql_execute($this->sql_create_user, array('login' => $login, 'password' => sha1($pass), 'role' => $role));
        if ($result) {
            echo 1;
        } else {
            die('Не удалось создать пользователя: ' . $result);
        }
    }

    /**Изменение данных пользователя
     *
     * @param $id - id изменяемого пользователя
     * @param $pass - пароль (пароль будет зашифрован в sha1)
     * @param $role - роль пользователя
     */
    public function update_user($id, $pass, $role){
        $result = $this->db->sql_execute($this->sql_update_user, array('id' => $id,'password' => sha1($pass), 'role' => $role));
        if ($result) {
            echo 1;
        } else {
            die('Не удалось изменить данные пользователя: ' . $result);
        }
    }

    /**Изменение данных пользователя
     *
     * @param $id - id изменяемого пользователя
     */
    public function delete_user($id){
        $result = $this->db->sql_execute($this->sql_delete_user, array('id' => $id));
        if ($result) {
            echo 1;
        } else {
            die('Не удалось удалить пользователя: ' . $result);
        }
    }

    /**
     * Получение пути до записи по ее id
     *
     * @param $id_record - id записи, путь которой нужно вытащить
     * @return string
     */
    private function get_path_tpl_record($id_record){
        $tpl_name = $this->db->get_elements($this->sql_get_tpl_name, array('id_record' => $id_record));
        $tpl_path = 'application/views/templates/records/' . $tpl_name[0]['tpl_name'] . '.tpl';
        return $tpl_path;
    }

    /**
     * Создание контента для шаблона с tab меню
     *
     * @param $data  - данные из которых будет собираться меню
     * @param $tpl_name - имя шаблона
     * @return string - содержимое шаблона
     */
    private function create_tab_menu_tpl($data, $tpl_name){
        //Создание кнопок (ссылок на разделы)
        $menu_content  = "<ul class='nav nav-tabs ". $data['menu_class'] ."'>";
        foreach ($data['sections'] as $key=>$val){
            if (!empty($val['deleted'])) continue; //Пропускаем разделы для удаления

            $html_id_section = $tpl_name . "_" . $key;
            $menu_content .= "<li><a href='#" . $html_id_section . "' data-toggle='tab'>" . $val['section_name'] . "</a></li>";
        }
        $menu_content .= "</ul>";

        //Создание разделов
        $menu_content .= "<div class='tab-content'>";
        foreach ($data['sections'] as $key=>$val){
            if (!empty($val['deleted'])) continue; //Пропускаем разделы для удаления

            $html_id_section = $tpl_name . "_" . $key;
            $menu_content .= "<div class='tab-pane fade' id='" . $html_id_section . "'>";
            //Подключение записи
            if (!empty($val['fid_record'])) {
                $tpl_path = $this->get_path_tpl_record($val['fid_record']);
                $menu_content .= "{if file_exists('" . $tpl_path . "')}{include file='";
                $menu_content .= $tpl_path;
                $menu_content .= "'}{else}Не найден файл{/if}";
            }
            $menu_content .= "</div>";
        }
        $menu_content .= "</div>";

        return $menu_content;
    }

    /**
     * Создание контента для шаблона с pills меню
     *
     * @param $data  - данные из которых будет собираться меню
     * @param $tpl_name - имя шаблона
     * @return string  - содержимое шаблона
     */
    private function create_pills_menu_tpl($data, $tpl_name){
        //Создание кнопок (ссылок на разделы)
        $menu_content  = "<ul class='nav nav-pills ". $data['menu_class'] ."'>";
        foreach ($data['sections'] as $key=>$val){
            if (!empty($val['deleted'])) continue; //Пропускаем разделы для удаления

            $html_id_section = $tpl_name . "_" . $key;
            $menu_content .= "<li><a data-toggle='pill' href='#" . $html_id_section . "'>" . $val['section_name'] . "</a></li>";
        }
        $menu_content .= "</ul>";

        //Создание разделов
        $menu_content .= "<div class='tab-content'>";
        foreach ($data['sections'] as $key=>$val){
            if (!empty($val['deleted'])) continue; //Пропускаем разделы для удаления

            $html_id_section = $tpl_name . "_" . $key;
            $menu_content .= "<div class='tab-pane fade' id='" . $html_id_section . "'>";
            //Подключение записи
            if (!empty($val['fid_record'])) {
                $tpl_path = $this->get_path_tpl_record($val['fid_record']);
                $menu_content .= "{if file_exists('" . $tpl_path . "')}{include file='";
                $menu_content .= $tpl_path;
                $menu_content .= "'}{else}Не найден файл{/if}";
            }
            $menu_content .= "</div>";
        }
        $menu_content .= "</div>";

        return $menu_content;
    }

    /*private function check_password($pass){

    }*/

}