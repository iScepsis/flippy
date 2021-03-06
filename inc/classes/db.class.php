<?php
/**
 * Created by PhpStorm.
 * User: SepsiS
 * Date: 26.03.2015
 * Time: 21:10
 */

class Db {
    private $db;
    protected static $_instance;

    private function __construct() {
        $this->db = new PDO("sqlite:". DB_PATH . DB_NAME);
    }

    private function __clone(){
    }

    /**
     * Статическая функция, которая возвращает
     * экземпляр класса или создает новый при
     * необходимости
     * @return Db
     */
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $sql - тело запроса
     * @param null $params - массив с параметрами
     * @return array|string
     */
    public function get_elements($sql, $params=null){
        try {
            $stmt = $this->db->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $val) {
                    $stmt->bindValue($key, $val);
                }
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage() . ":" . $e->getLine();
        }
    }

    /**
     * Запрос на insert с возвращением последнего вставленного id
     * @param $sql - тело запроса
     * @param null $params - массив с параметрами
     * @return string
     */

    public function sql_execute($sql, $params=null){
        try {
            $stmt = $this->db->prepare($sql);
            if (!empty($params)) {
                foreach ($params as $key => $val) {
                    $stmt->bindValue($key, $val);
                }
            }
            $stmt->execute();
            if ($last_id = $this->db->lastInsertId())
                return $this->db->lastInsertId();
            else
                return 1;
        } catch (PDOException $e) {
            return $e->getMessage() . ":" . $e->getLine();
        }
    }
}