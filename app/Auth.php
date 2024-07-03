<?php


class Auth extends App
{

    public ?string $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user(): array
    {

        if(!isset($_COOKIE['token'])){
            return ['result' => 'error', 'error' => 'ERROR no auth token'];
        }
        $token =  htmlentities($_COOKIE['token'], ENT_QUOTES, 'UTF-8');
        if(strlen($token) !== 64)
        {
            return ['result' => 'error', 'error' => 'ERROR auth token to formatted'];
        }
        $user = $this->db_get("SELECT * FROM `users` WHERE token LIKE '$token'");
        if($user['result'] !== 'success')
        {
            return ['result' => 'error', 'error' => 'ERROR запрос токена прошел с ошибкой'];
        }

        if(empty($user['data']))
        {
            return ['result' => 'error', 'error' => 'ERROR Не нашли юзера'];
        }
        $user = $user['data'][0];

        if ($user['enabled'] !== '1')
        {
            return ['result' => 'error', 'error' => 'ERROR бзер отключен'];
        }

        unset($user['password']);
        unset($user['token']);
        return ['result' => 'success', 'user' => $user];
    }

    public function create_user($data): void
    {
        $login = $data['login'];
        $name = $data['name'];
        $role = $data['role'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);



        $q = "INSERT INTO `users` (
                     `login`, `role`, `name`, `enabled`, 
                     `password`
                ) VALUES (
                           '$login', '$role', '$name', '1', 
                          '$password')";

        $this->db_q($q);
    }

    public function login($data)
    {

        if(!isset($data['login'])) {$this->f(['error' => 'Логин обязателен'], 'e');}
        if(!isset($data['password'])) {$this->f(['error' => 'пароль обязателен'], 'e');}

        if(strlen($data['login']) < 5) {$this->f(['error' => 'Логин короткий'], 'e');}
        //if(strlen($data['password']) < 5) {$this->f(['error' => 'Пароль корочкий'], 'e');}

        $login = $data['login'];
        $result = $this->db_get("SELECT * FROM users WHERE login like '$login'");
        if(!$result['data']){
            $this->f(['error' => 'Неверный логин или пароль'], 'e');
        }

        $user = $result['data'][0];


        if(!password_verify($data['password'], $user['password']))
        {
            $this->f(['error' => 'Неверный логин или пароль'], 'e');
        }

        if($user['enabled'] !== "1")
        {
            $this->f(['error' => 'Пользователь неактивен'], 'e');
        }


        $token = hash('sha256', time().'some serious gourmet shit');
        $t = $this->update_field($user['id'], 'token', $token);

        setcookie('token', $token, time() + 3600*24*7, '/');
        $this->f();

    }
}