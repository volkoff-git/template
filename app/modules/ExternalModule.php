<?php

class ExternalModule extends Module
{
    public array $allowed_actions = ['index', 'lead', 'login', 'performLogin'];
    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function index($param): void
    {
        $user_id = $this->user['id'];
        $user_id = 2;
        // фильтр по стадиям для ролей broker/manager
        $q = "SELECT l.id, l.id_user, l.stage, l.name, l.name_last, l.name_middle,  l.created_at, l.show_at,
                le.alias e_alias 
            FROM `leads` l 
            LEFT JOIN `lead_events` le ON l.last_event_id = le.id 
            WHERE l.created_by = $user_id";
        $leads = $this->db_get($q);
        if($leads['result'] !== 'success') {$this->f(['description' => 'error EXT0001'], 'e');}
        $leads = $leads['data'];
        foreach ($leads as $k => $lead)
        {
            $leads[$k]['stage_text'] = LibLeads::$stages[$lead['stage']]['title']??$lead['stage'];
            $leads[$k]['event_text'] = LibLeads::$lead_events_aliases[$lead['e_alias']]['title']??$lead['e_alias'];
        }

        $this->renderPage('external.index', [
            'title' => 'Внешний интерфейс',
            'leads' => $leads,
            'user' => $this->user,
        ], 'externalLayout');
    }

    protected function lead($param): void
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