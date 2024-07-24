<?php

class ExternalModule extends Module
{
    public array $allowed_actions = ['index'];
    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function index($param): void
    {
        $this->renderPage('external.index', ['title' => 'Внешний интерфейс'], 'externalLayout');
    }
}