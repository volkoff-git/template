<?php

class User extends App
{
    public ?string $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $q = "SELECT id, login, role, name, enabled 
                FROM users ORDER BY enabled DESC, id";
        $r = $this->db_get($q);
        return $r['data'];
    }


    public function edit_user($data): void
    {
        $id = $data['id'];
        $login = $data['login'];
        $role = $data['role'];
        $name = $data['name'];

        $q_password = '';
        if(isset($data['password']))
        {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $q_password = "  ,  `password` = '$password' , `token` = NULL";
        }

        $q = "UPDATE `users` SET 
                   `login` = '$login', 
                   `role` = '$role', 
                   `name` = '$name'
                    $q_password
               WHERE `users`.`id` = $id";
        $this->db_q($q);

    }
}