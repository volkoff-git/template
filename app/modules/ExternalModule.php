<?php

class ExternalModule extends Module
{
    public array $allowed_actions = ['index', 'form'];
    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function index($param): void
    {
        $this->renderPage('external.index', ['title' => 'Внешний интерфейс'], 'externalLayout');
    }

    protected function form($param): void
    {
        $this->renderPage('external.form', ['title' => 'Анкета', 'id' => $param], 'externalLayout');
    }
}