<?php
class Controller_Default extends Controller
{

    function __construct()
    {
        $this->model = new Model_Default();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        return $data;
    }
}