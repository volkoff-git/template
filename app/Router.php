<?php

class Router extends App
{
    private string $module = 'index';
    private string $action = 'index';
    private string $param = "0";
    public function run(): void
    {
        $this->parse_request();
        $this->check_access();
        $this->call();

    }

     private function call(): void
     {
         if(!isset(LibAccess::$modules[$this->module]['module']))
         {
             echo 'ERROR Запрашиваемый модуль не найден'; die;
         }
         $call_module = LibAccess::$modules[$this->module]['module'];
         if(class_exists($call_module))
         {
             $instance = new $call_module($this->module, $this->action, $this->param);
         }
         else
         {
             echo 'Запрашиваемый модуль отключен или недоступен'; die;
         }
     }


    private function get_user(): array
    {
        $Auth = new Auth();
        $result = $Auth->get_user();
        if($result['result'] !== 'success')
        {
            header("Location: /auth/login");  die;
            //echo $result['error']; die;
        }
        return  $result['user'];
    }


    private function check_access(): void
    {
        if($this->module === 'auth')
        {
            return;
        }

        $user = $this->get_user();
        $access_list = LibAccess::$modules;
        if(!isset($access_list[$this->module]))
        {
            echo 'big brother watching you!'; die;
        }

        // если в настройках доступа модуля нет roles = доступно всем залогованым
        if(!isset($access_list[$this->module]['roles']))
        {
            return;
        }

        if(!in_array($user['role'], $access_list[$this->module]['roles']))
        {
            header("Location: /");  die;
        }

        if(!isset($access_list[$this->module]['module']))
        {
            echo 'Запрашиваемый модуль отключен'; die;
        }

    }



    private function parse_request(): void
    {
        $url = $_SERVER['REQUEST_URI'];
        $parts = parse_url($url);
        $parts_arr = explode('/', $parts['path']);

        if(isset($parts_arr[1]) && $parts_arr[1] != '')
        {
            $this->module = $parts_arr[1];
        }



        if(isset($parts_arr[2]) && $parts_arr[2] != '')
        {
            $this->action = $parts_arr[2];
        }


        if(isset($parts_arr[3]) && $parts_arr[3] != '')
        {
            $this->param = $parts_arr[3];
        }
    }
}