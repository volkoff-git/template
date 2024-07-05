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


    public function api($log_data, $separator = "\n\n"): void
    {
        $log_data = json_encode($log_data, 256);
        $file = "api/".date('Y-m-d').".log";
        $ip = $_SERVER['REMOTE_ADDR'] ?? "^";
        $d = date('d.m.Y H:i:s');
        $log_uri = __DIR__ . "/../storage/log/$file";
        $data = "$d\t\t[ $ip ]"."\n".$log_data.$separator;
        file_put_contents($log_uri, $data, FILE_APPEND);
    }
}