<?php

require_once 'config.php';

class App
{
    private string $db_host = DB_HOST;
    private string $db_user = DB_USER;
    private string $db_pass = DB_PASSWORD;
    private string $db_name = DB_NAME;

    private string $table;

    private ?array $user = null;

    protected ?mysqli $db;


    public function __construct()
    {
        $this->db_connect();
    }

    protected function db_connect(): void
    {
        $charset = "utf8";
        $db = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($db->connect_errno) {
            echo 'service erorr'; die;
        }
        $db->set_charset($charset);
        date_default_timezone_set('Europe/Minsk');
        $this->db = $db;
    }


    protected function getById($id): array
    {
        $q = "SELECT * FROM $this->table WHERE id = $id";
        return $this->db_get($q);
    }

    protected function db_get($query): array
    {
        $data = [];

        $r = $this->db->query($query);
        if(!$r)
        {
            return [
                'result' => "error", 'mysql_error' => $this->db->error,
            ];
        }
        else
        {
            if ($r->num_rows > 0){
                while ($row = $r->fetch_assoc()){
                    $data[] = $row;
                }
            }
        }
        return ['result' => 'success', 'data' => $data];
    }

    protected function db_q($query): array
    {
        $r = $this->db->query($query);
        if(!$r)
        {
            return [
                'result' => "error", 'mysql_error' => $this->db->error,
            ];
        }
        else
        {
            return ['result' => 'success'];
        }

    }

    protected function f($data = [], $result = 'success'): void
    {
        $data['result'] = $result == 'success'?'success':'error';
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    }


}

/// класс auth начать забирать юзера из БД