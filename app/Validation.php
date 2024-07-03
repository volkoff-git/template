<?php

class Validation extends App
{

    public array $validated_data;
    public array $errors;
    private LibValidationHandlers $lvh;


    public function __construct()
    {
        parent::__construct();
    }

    private array $available_rules = ['create_user', 'edit_user'];

    public function validate($rule, $data)
    {

        if(!in_array($rule, $this->available_rules)) {
            $this->f(['no rule'], 'e');
        }


        $this->lvh = new LibValidationHandlers($data, $rule);

        switch ($rule) {
            case 'create_user':
                return $this->_rule_create_user();
            case 'edit_user':
                return $this->_rule_edit_user();
            default:
                $this->f(['no rule'], 'e');
        }

    }



    private function _rule_edit_user() :bool
    {
        if($this->lvh->required('id'))
        {
            $this->lvh->int_val('id', 0);
        }
        if($this->lvh->required('login'))
        {
            $this->lvh->max_len('login', 16);
            $this->lvh->min_len('login', 5);
        }
        if($this->lvh->required('name'))
        {
            $this->lvh->max_len('name', 100);
            $this->lvh->min_len('name', 3);
        }
        $this->lvh->white_list('role', ['user', 'manager', 'admin'], 'user');

        return $this->lvh_result();

    }


    private function _rule_create_user() :bool
    {

        if($this->lvh->required('login'))
        {
            $this->lvh->max_len('login', 16);
            $this->lvh->min_len('login', 5);
            $this->lvh->unique('login', 'users', 'login');
        }
        if($this->lvh->required('password'))
        {
            $this->lvh->max_len('password', 32);
            $this->lvh->min_len('password', 8);
        }
        if($this->lvh->required('name'))
        {
            $this->lvh->max_len('name', 100);
            $this->lvh->min_len('name', 3);
        }

        $this->lvh->white_list('role', ['user', 'manager', 'admin'], 'user');

        return $this->lvh_result();

    }

    private function lvh_result(): bool
    {
        if($this->lvh->payload['result'] === 'success')
        {
            $this->validated_data = $this->lvh->data;
            return true;
        }
        else
        {
            $this->validated_data = $this->lvh->data;
            $this->errors = $this->lvh->payload['errors'];
            return false;
        }
    }



}