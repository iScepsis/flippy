<?php
class Controller_News extends Controller
{

    function __construct()
    {
        $this->model = new Model_News();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $data['news'] = $this->model->get_news();
        $this->view->generate('news_view.tpl', 'default_layout.tpl', $data);
    }

    function action_list(){
        $this->action_index();
    }

    function action_read(){
        $this->action_index();
    }

}