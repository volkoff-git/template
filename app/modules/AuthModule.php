<?php

class AuthModule extends Module
{
    public array $allowed_actions = ['login', 'index'];
    public function __construct($module, $action, $param)
    {
        parent::__construct($module, $action, $param);
    }

    protected function index($param): void
    {
        header("Location: /auth/login");
    }

    protected function login($param): void
    {
        $this->renderPage('auth.login', ['foo' => $param], 'guestLayout');
    }
}