<?php


class Model_News extends Model
{
    public $db;
    private $news_limit = 3;   //Кол-во новостей выводимых на странице
    private $link_limit = 5;   //Кол-во чанков доступных на стр.


    private $sql_get_page_data = "SELECT * FROM pages
                                 INNER JOIN meta ON m_id = p_meta_fid
                                 WHERE p_view = :view_name";

    //Получение кол-ва новостных статей
    private $sql_get_count_news = "SELECT count(*) AS count_news FROM news";

    //Вывод списка новостей
    private $sql_get_news_list = "SELECT * FROM news ORDER BY date DESC LIMIT :start, :limit";

    //Вывод новости по id
    private $sql_get_news = "SELECT * FROM news WHERE id_news = :news_id";

    //Увеличение счетчика кол-ва просмотров при клике на новость
    private $sql_incriment_views = "UPDATE news SET views_count = views_count + 1 WHERE id_news = :news_id";

    public function __construct(){
        $this->db = Db::getInstance();
    }

    public function get_data()
    {
        $query = $this->db->get_elements($this->sql_get_page_data, array('view_name' => 'news'));
        $data['page'] = $query[0];
        return $data;
    }


    /**Получение новостных статей
     *
     * @return array|string
     */
    public function get_news(){
        if (!empty(Route::$routes[2])) {
            $action = strtolower(Route::$routes[2]);
        } else {
            $action = 'index';
        }
        $count_news = $this->db->get_elements($this->sql_get_count_news);
        $count_news = $count_news[0]['count_news'];
        switch ($action) {
            case 'index':  //если не был прописан экшен, подгатавливаем url для работы с постраничной навигацией
                Route::$routes[] = 'list';
            //Вывод списка новостей
            case 'list':
                if (!empty(Route::$routes[3])) {
                    $navigate_start = (int)Route::$routes[3];
                } else {
                    $navigate_start = 0;
                }
                $news = $this->db->get_elements($this->sql_get_news_list, array('start' => $navigate_start,
                                                                                'limit' => $this->news_limit));
                $news['mode'] = 'list'; //Говорим представлению о том, что нужно выводить список
                $news['navigate'] = $this->getPageNavigation($count_news, $this->news_limit, $navigate_start, $this->link_limit);
                break;
            //Чтение одной новости
            case 'read':
                if (!empty(Route::$routes[3])) {
                    $news_id = (int)Route::$routes[3];
                }
                $news = $this->db->get_elements($this->sql_get_news, array('news_id' => $news_id));
                $news['mode'] = 'read'; //Говорим представлению о том, что нужно прочитать конкретную новость
                $this->db->sql_execute($this->sql_incriment_views,  array('news_id' => $news_id));
                break;
            default:
                Route::ErrorPage404();
        }
        return $news;
    }


    public function getPageNavigation($all, $limit, $start, $link_limit){
        include_once("inc/classes/page_navigation.class.php");

        $pageNav = new PageNavigation();
        $navigation = $pageNav->getLinks( $all, $limit, $start, $link_limit, Route::$routes);

        return $navigation;
    }
}