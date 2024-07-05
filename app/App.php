<?php

require_once 'config.php';

class App
{
    private string $db_host = DB_HOST;
    private string $db_user = DB_USER;
    private string $db_pass = DB_PASSWORD;
    private string $db_name = DB_NAME;

    protected ?string $table = null;

    public ?array $user = null;

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


    protected function getById($id): ?array
    {
        $q = "SELECT * FROM $this->table WHERE id = $id";
        $r = $this->db_get($q);
        if($r['result'] === 'success'){
            return  $r['data'][0]??null;
        }
        return null;
    }

    protected function db_get($query): array
    {
        $data = [];

        try {
            $r = $this->db->query($query);
        }
        catch (Exception $e){
            return [
                'result' => "error", 'mysql_error' => $e->getMessage(),
            ];
        }

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
        try {
            $r = $this->db->query($query);
        }
        catch (Exception $e){

            return [
                'result' => "error", 'mysql_error' => $e->getMessage(),
            ];
        }
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


    protected function update_field($id, $field, $value, $table = null): array
    {
        if(!$table)
        {
            $table = $this->table;
        }
        if(!$table)
        {
            return ['result' => 'error', 'error' => 'no table'];
        }
        $q = "UPDATE `$table` SET `$field` = '$value' WHERE `id` = $id;";
        return $this->db_q($q);
    }

    protected function f($data = [], $result = 'success'): void
    {
        $data['result'] = $result == 'success'?'success':'error';
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    }

    protected function e($error): void
    {
        echo json_encode(['result' => 'error', 'error' => $error], 246); die;
    }


    protected function sanitise($string): string
    {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }

     protected function sanitise_all($arr): array
     {
        $payload = [];
        foreach ($arr as $k => $i)
        {
            $payload[$k] = $this->sanitise($i);
        }
        return $payload;
    }




}

/// класс auth начать забирать юзера из БД