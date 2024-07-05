<?php

class ApiModule extends App
{

    private array $rd;
    private string $token = 'api_EXj0khkjtuddao9VdKWZKGjJjcF87Jbk7y1JseDrjMW1cM0BD0EmXHwB5nyX';

    private array $available_actions = ['ping'];

    public function __construct($params)
    {
        parent::__construct();



        $this->get_data();
        (new Log())->api($this->rd);
        $this->check_access();
        $this->run($params);
    }


    private function run($params): void
    {
        if(!isset($params['action']) || !in_array($params['action'], $this->available_actions))
        {
            $this->f(['error' => 'no action'], 'e');
        }
        $a = '_'.$params['action'];
        if(is_callable(array($this, $a))){
            $this->rd = $this->rd['data'];
            $this->$a();
        }
        else{
            $this->f(['error' => 'no call action'], 'e');
        }
    }


    private function check_access(): void
    {
        if(!isset($this->rd['token'])) {$this->f(['error' => 'no auth key'], 'e');}
        if(mb_strlen($this->rd['token']) !== 64) {$this->f(['error' => 'no auth key'], 'e');}
        if($this->rd['token'] !== $this->token)
        {
            $this->f(['error' => 'no auth key'], 'e');
        }
    }

    private function get_data(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if(!$data)
        {
            $this->f(['error' => 'no json'], 'e');
        }
        $this->rd = $data;
    }





    private function _ping(): void
    {
       var_export($this->rd);
    }
}