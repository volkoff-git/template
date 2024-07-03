<?php

class Validation extends App
{

    public array $validated_data;
    public array $errors;


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


    private function _rule_create_user($data) :bool
    {

        $lvh = new LibValidationHandlers($data, 'create_user');
        if($lvh->required('login'))
        {
            $lvh->max_len('login', 16);
            $lvh->min_len('login', 5);
            $lvh->unique('login', 'users', 'login');
        }
        if($lvh->required('password'))
        {
            $lvh->max_len('password', 32);
            $lvh->min_len('password', 8);
        }
        if($lvh->required('name'))
        {
            $lvh->max_len('name', 100);
            $lvh->min_len('name', 3);
        }
       // $lvh->default('role', 'user');
        $lvh->white_list('role', ['user', 'manager'], 'user');


//        var_export($lvh->payload);
//        var_export($lvh->data);
        if($lvh->payload['result'] === 'success')
        {
            $this->validated_data = $lvh->data;
            return true;
        }
        else
        {
            $this->validated_data = $lvh->data;
            $this->errors = $lvh->payload['errors'];
            return false;
        }

    }



}