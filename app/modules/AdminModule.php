<?php

class AdminModule extends Module
{
    public array $allowed_actions = ['index', 'subpage', 'create_user'];
    private array $allowed_subpages = ['userList', 'foo', 'bar'];


    public function __construct($params)
    {
        parent::__construct($params);

    }

    protected function index($param): void
    {
        $this->renderPage('admin.index', ['attach_js' => 'admin', 'title' => 'Админка']);
    }

    protected function create_user()
    {
        // VAlidator->required(POST, ['login', 'pass'])

        $v = new Validation();
        $post = $this->sanitise_all($_POST);
        $v->validate('create_user', $post);

    }

    protected function subpage(): void
    {
        if(!isset($_POST['tab']))
        {
            $this->f(['error' => 'i can see you'], 'e');
        }
        if(in_array($_POST['tab'], $this->allowed_subpages))
        {
            $tab = $_POST['tab'];
            $this->f(['html' => $this->renderFragment('admin._subpages.admin_'.$tab)]);
        }
        else
        {
            $this->f(['error' => 'subpage not found'], 'e');
        }

    }


}