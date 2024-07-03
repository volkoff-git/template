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
}