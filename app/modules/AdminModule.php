<?php

class AdminModule extends Module
{
    public array $allowed_actions = ['index', 'foo'];


    public function __construct($params)
    {
        parent::__construct($params);

    }

    protected function index($param): void
    {
        $this->renderPage('admin.index', ['foo' => $param]);
    }

    protected function foo(): void
    {
        echo 'foo';
    }
}