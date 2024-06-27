<?php


class Auth extends App
{
    protected string $table = 'users';


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
}