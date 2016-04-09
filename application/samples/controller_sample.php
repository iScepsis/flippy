class Controller_<<Sample>> extends Controller
{

    function __construct()
    {
        $this->model = new Model_<<Sample>>();
        $this->view = new View();
    }

    function action_index()
    {
        $this->view->generate('<<Sample>>_view.tpl', 'default_layout.tpl');
    }
}