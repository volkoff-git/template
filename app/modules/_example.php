<?php

class _example extends Module
{
    public array $allowed_actions = ['index'];
    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function index($param): void
    {
        // $this->render('example.index', ['foo' => $param]);
    }
}