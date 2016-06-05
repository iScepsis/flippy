class Model_<<Sample>> extends Model
{
    public $db;

    public $sql_get_page_data = "SELECT * FROM pages
                                 INNER JOIN meta ON m_id = p_meta_fid
                                 WHERE p_view = :view_name";

   public function get_data()
    {
        $this->db = Db::getInstance();

        $query = $this->db->get_elements($this->sql_get_page_data, array('view_name' => strtolower('<<Sample>>')));
        $data['page'] = $query[0];
        return $data;
    }


}