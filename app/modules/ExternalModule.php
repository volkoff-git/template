<?php

class ExternalModule extends Module
{
    public array $allowed_actions = ['index', 'form', 'login', 'performLogin'];
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

    protected function login($param): void
    {
        $this->renderPage('auth.login', ['title' => 'Логин', 'spot' => 'external'], 'guestLayout');
    }


    protected function performLogin($param): void
    {
        $post = $this->sanitise_all($_POST);
        $Auth = new Auth();
        $Auth->login($post);
    }
}