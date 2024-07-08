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

    private array $available_rules = ['create_user', 'edit_user', 'api_add_lead'];

    public function validate($rule, $data)
    {

        if(!in_array($rule, $this->available_rules)) {
            $this->f(['no rule available'], 'e');
        }


        $this->lvh = new LibValidationHandlers($data, $rule);

        switch ($rule) {
            case 'create_user':
                return $this->_rule_create_user();
            case 'edit_user':
                return $this->_rule_edit_user();
            case 'api_add_lead':
                return $this->_rule_api_add_lead();
            default:
                $this->f(['no rule'], 'e');
        }

    }


    private function _rule_api_add_lead(): bool
    {
        if($this->lvh->required('phone'))
        {
            $this->lvh->max_len('phone', 10);
            $this->lvh->min_len('phone', 10);
            $this->lvh->valid_phone('phone');
        }
        if($this->lvh->isset('source'))
        {
            $this->lvh->int_val('source');
        }



        return $this->lvh_result();
    }



    private function _rule_edit_user() :bool
    {

        if($this->lvh->required('id'))
        {
            $this->lvh->int_val('id', 1);
            if($this->lvh->data['id'] == 1 && $this->lvh->data['current_user_id'] != 1)
            {
                $this->lvh->payload['result'] = 'error';
                $this->lvh->payload['errors']['id'] = 'За вами выехали';
                return $this->lvh_result();
            }

            if(!$this->lvh->record_exists('id', 'users'))
            {
                return $this->lvh_result();
            }

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

        if(isset($this->lvh->data['password']))
        {
            $this->lvh->max_len('password', 32);
            $this->lvh->min_len('password', 8);
        }


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
        $this->validated_data = $this->lvh->data;
        if($this->lvh->payload['result'] === 'success')
        {
            return true;
        }
        else
        {
            $this->errors = $this->lvh->payload['errors'];
            return false;
        }
    }



}