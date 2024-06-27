<?php

class AdminModule extends Module
{
    public array $allowed_actions = ['index', 'foo'];


    public function __construct($module, $action, $param)
    {
        parent::__construct($module, $action, $param);

    }

    protected function index($param): void
    {
        $this->render('admin.index', ['foo' => $param]);
    }

    protected function foo(): void
    {
        echo 'foo';
    }
}