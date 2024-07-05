<?php

class LeadModule extends Module
{
    public array $allowed_actions = ['index'];
    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function index($param): void
    {
        $this->renderPage('lead.index_view', ['attach_js' => 'lead', 'title' => 'Лиды в работу']);
    }
}