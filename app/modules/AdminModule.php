<?php

class AdminModule extends Module
{
    public array $allowed_actions = [
        'index', 'subpage', 'create_user', 'show_edit_user_modal'];
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
        $v = new Validation();
        $post = $this->sanitise_all($_POST);
        if($v->validate('create_user', $post))
        {
            $data = $v->validated_data;
            $Auth = new Auth();
            $Auth->create_user($data);
            $this->f();
        }
        else
        {
            $this->f(['error' => current($v->errors)], 'e');
        }


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
            $U = new User();
            $users = $U->get_all();
            $this->f([
                'html' => $this->renderFragment('admin._subpages.admin_'.$tab, ['users' => $users]),
            ]);
        }
        else
        {
            $this->f(['error' => 'subpage not found'], 'e');
        }

    }

    protected function show_edit_user_modal()
    {
        $id = 0;
        if(!isset($_POST['id']) || intval($id = $_POST['id']) == 0){
            $this->f(['error' => 'no id'], 'e');
        }

        $U = new User();
        $user = $U->getById($id);


        $this->f([
            'html' => $this->renderFragment('admin._includes.edit_user', $user)
        ]);
    }


}