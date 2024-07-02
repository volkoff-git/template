<?php

class Validation extends App
{
    public function __construct()
    {
        parent::__construct();
    }

    private array $available_rules = ['create_user'];

    public function validate($rule, $data)
    {
        if(!in_array($rule, $this->available_rules)) {
            $this->f(['no rule'], 'e');
        }


        switch ($rule) {
            case 'create_user':
                return $this->_rule_create_user($data);
                break;
            default:
                $this->f(['no rule'], 'e');
        }

    }


    private function _rule_create_user($data) :array
    {

        $lvh = new LibValidationHandlers($data, 'create_user');
        if($lvh->required('login'))
        {
            $lvh->max_len('login', 16);
            $lvh->min_len('login', 5);
        }
        if($lvh->required('password'))
        {
            $lvh->max_len('password', 32);
            $lvh->min_len('password', 8);
        }
       // $lvh->default('role', 'user');
        $lvh->white_list('role', ['user', 'manager'], 'user');


        var_export($lvh->payload);
        return $lvh->payload;

    }



}