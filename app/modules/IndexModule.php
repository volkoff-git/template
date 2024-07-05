<?php

class IndexModule extends Module
{
    public array $allowed_actions = ['index', 'template'];


    public function __construct($params)
    {
        parent::__construct($params);

    }


    protected function index($param): void
    {
        header("Location: /lead");  die;
        //$this->renderPage('index.index', ['foo' => $param]);
    }

    protected function template($param): void
    {
        $this->renderPage('index.template', [], 'templateLayout');
    }
}