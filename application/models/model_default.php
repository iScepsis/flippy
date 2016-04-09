<?php
class Model_Default extends Model
{
    public $db;

    public $sql_get_menu = "SELECT p_view, p_title FROM pages ORDER BY sort";

    public function get_data()
    {
        $this->db = Db::getInstance();

        //Выборка данных для меню
        $data['menu'] = $this->db->get_elements($this->sql_get_menu);
        return $data;
    }
}