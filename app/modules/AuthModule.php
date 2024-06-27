<?php

class AuthModule extends Module
{
    public array $allowed_actions = ['login', 'index'];
    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function index($param): void
    {
        header("Location: /auth/login");
    }

    protected function login($param): void
    {
        if($this->user)
        {
            header("Location: /");
        }
        $this->renderPage('auth.login', ['foo' => $param], 'guestLayout');
    }
}