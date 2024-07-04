<?php

class Log extends App
{
    public function __construct()
    {
        parent::__construct();

    }

    public function user($user_id, $alias, $text, $data = false): void
    {
        $data_db = 'NULL';
        if($data)
        {
            $data_db = "'".json_encode($data, 256)."'";
        }
        $q = "INSERT INTO `log_users` (`id_user`, `alias`, `text`, `created_at`, `data`
                ) VALUES (
             '$user_id', '$alias', '$text', '2024-07-04 16:19:23.000000', $data_db)";
        $this->db_q($q);
    }
}