<?php

class LibValidationHandlers extends App
{
    public array $data;
    public array $payload;

    public array $current_fields_titles;

    public function __construct($data, $cft)
    {
        $this->payload['result'] = 'success';
        $this->data = $data;
        $this->current_fields_titles = $this->fields_titles[$cft];
        parent::__construct();
    }

    public function required($field): bool
    {
        if(!isset($this->data[$field]) || !($this->data[$field]))
        {
            $title = $this->_title($field);
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Поле $title обязательно";
            return false;
        }
        return true;
    }

    public function default($field, $default_value): void
    {
        if(!isset($this->data[$field]) || !($this->data[$field]))
        {
            $this->data[$field] = $default_value;
        }
    }


    public function white_list($field, $list, $default = false)
    {
        if(!in_array($this->data[$field], $list))
        {
            if($default)
            {
                $this->data[$field] = $default;
            }
            else
            {
                $title = $this->_title($field);
                $this->payload['result'] = 'error';
                $this->payload['errors'][$field] = "Поле $title имеет недопустимое значение";
            }
        }
    }


    public function max_len($field, $len): void
    {
        if (mb_strlen($this->data[$field]) > $len)
        {
            $title = $this->_title($field);
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Поле $title  должно быть не длиннее $len";
        }
    }

    public function min_len($field, $len): void
    {
        if (mb_strlen($this->data[$field]) < $len)
        {
            $title = $this->_title($field);
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Поле $title  должно быть не короче $len";
        }
    }

    public function int_val($field, $min = false, $max = false): void
    {
        $title = $this->_title($field);
        $val = intval($this->data[$field]);
        if ($min !== false && $val < $min)
        {
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Поле $title меньше $min";
        }
        if ($max !== false && $val > $max)
        {
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Поле $title больше $max";
        }
        $this->data[$field] = $val;

    }


    public function record_exists($field, $table): bool
    {
        $id = $this->data[$field];
        $q = "SELECT id FROM $table WHERE id = $id";

        $r = $this->db_get($q);
        if(!$r['data'])
        {
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Запись не найдена";
            return false;
        }
        return true;
    }


    public function unique($field, $table, $col): void
    {
        $val = $this->data[$field];
        $q = "SELECT * FROM `users` where login = '$val';";
        $res = $this->db_get($q);
        if($res['result'] !== 'success')
        {
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "db issue #carla";
            return;
        }
        if($res['data'])
        {
            $title = $this->_title($field);
            $this->payload['result'] = 'error';
            $this->payload['errors'][$field] = "Такой $title уже есть";
        }


    }


    private function _title($field)
    {
        return $this->current_fields_titles[$field] ?? $field;
    }





    public array $fields_titles = [
        'create_user' => [
            'login' => 'Логин',
            'password' => 'Пароль',
            'name' => 'Имя',
            'role' => 'Статус',
        ],
        'edit_user' => [
            'login' => 'Логин',
            'password' => 'Пароль',
            'name' => 'Имя',
            'role' => 'Статус',
        ]
    ];

}