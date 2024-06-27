<?php

class _example extends Module
{
    public array $allowed_actions = ['index'];
    public function __construct($module, $action, $param)
    {
        parent::__construct($module, $action, $param);
    }

    protected function index($param): void
    {
        // $this->render('example.index', ['foo' => $param]);
    }
}