<?php

class AdminModule extends Module
{
    public array $allowed_actions = [
        'index', 'subpage', 'create_user', 'edit_user', 'toggle_user', 'show_edit_user_modal', 'toggle_user_stage'];
    private array $allowed_subpages = ['userList', 'foo', 'bar'];


    public function __construct($params)
    {
        parent::__construct($params);

    }

    protected function index($param): void
    {
        $this->renderPage('admin.index',
            [ 'title' => 'Админка']);
    }

    protected function create_user(): void
    {
        $v = new Validation();
        $post = $this->sanitise_all($_POST);
        if($v->validate('create_user', $post))
        {
            $data = $v->validated_data;
            $Auth = new Auth();
            $Auth->create_user($data);
            (new Log())->user($this->user['id'], 'create_user', 'Создал пользователя '.$data['login'], $data);
            $this->f();
        }
        else
        {
            $this->f(['error' => current($v->errors)], 'e');
        }
    }

    protected function edit_user(): void
    {


        $v = new Validation();
        $post = $this->sanitise_all($_POST);
        $post['current_user_id'] = $this->user['id'];

        if(!$v->validate('edit_user', $post))
        {
            $this->f(['error' => current($v->errors)], 'e');
        }

        $data = $v->validated_data;



        $U = new User();
        $U->edit_user($data);
        (new Log())->user($this->user['id'], 'edit_user', 'Изменил пользователя '.$data['id'], $data);

        $this->f();

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
                'html' => $this->renderFragment('admin._subpages.admin_'.$tab, [
                    'users' => $users
                ]),
            ]);
        }
        else
        {
            $this->f(['error' => 'subpage not found'], 'e');
        }

    }

    protected function get_user_stages($id_user): array
    {
        $q = "SELECT * FROM `users_stages` WHERE id_user = $id_user";
        $r = $this->db_get($q);

        $payload = [];
        foreach ($r['data'] as $i)
        {
            $payload[] = $i['stage'];
        }
        return $payload;
    }

    /* Переключение видиным групп для юзеров в админке*/
    protected function toggle_user_stage():void
    {
        if(!isset($_POST['user_id']) || intval($id_user = $_POST['user_id']) == 0){
            $this->f(['error' => 'user_id'], 'e');
        }

        $action = 'off';
        if(isset($_POST['action']) && $_POST['action'] == 'on') { $action = 'on'; }

        if(!isset($_POST['stage']) || !isset(LibLeads::$stages[$_POST['stage']])){
            $this->f(['error' => 'no stage'], 'e');
        }

        $stage = $_POST['stage'];

        $q = "SELECT * FROM `users_stages` WHERE id_user = $id_user AND stage like '$stage'";
        $current_record = $this->db_get($q);
        $record_exists = !empty($current_record['data']);

        if($action == 'on')
        {
            if(!$record_exists)
            {
                $q = "INSERT INTO `users_stages` ( `id_user`, `stage`) VALUES ( '$id_user', '$stage')";
                $this->db_q($q);
            }

        }
        else
        {
            if($record_exists)
            {
                $id_record = $current_record['data'][0]['id'];
                $q =  "DELETE FROM users_stages WHERE `users_stages`.`id` = $id_record";
                $this->db_q($q);
            }
        }
        $this->f();
    }

    protected function toggle_user(): void
    {
        $id = 0;
        if(!isset($_POST['id']) || intval($id = $_POST['id']) == 0){
            $this->f(['error' => 'no id'], 'e');
        }

        $U = new User();
        $user = $U->getById($id);

        if($user['id'] == 1)
        {
            $this->f(['error' => 'Нельзя деактивировать суперадмина'], 'e');
        }

        $state = 0;
        if($user['enabled'] == 0)
        {
            $state = 1;
        }

        $U->update_field($user['id'], 'enabled', $state);
        (new Log())->user($this->user['id'], 'create_user', 'Переключил пользователя',
            ['user' => $user['id'], 'state' =>$state]);
        $this->f();

    }

    protected function show_edit_user_modal(): void
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