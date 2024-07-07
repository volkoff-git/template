<?php

class Lead extends App
{
    public ?string $table = 'leads';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * phone*
     * stage def: selling
     * source def: 1
     * created_by: 2 (crm)
     * show_at def: now
     */
    public function add($params): array
    {

        $params = $this->sanitise_all($params);
        if(!isset($params['phone']) || strlen($params['phone']) !== 10) {
            (new Log())->error(['e' => 'Попытка добавить неформатный телефон в lead.add', 'd' => $params]);
            $this->e('no phone in lead.add');
        }

        if(!ctype_digit($params['phone'])) {$this->e('phone not valid');}


        $now = date('Y-m-d H:i:s');

        $sql_params = [
            'phone' => $params['phone'],
            'stage' => 'underwriting',
            'source' => '2',
            'created_by' => '2',
            'show_at' => $now
        ];


        if(isset($params['stage']) && isset(LibLeads::$stages[$params['stage']]))
        {
            $sql_params['stage'] = $params['stage'];
        }

        if(isset($params['source']) && isset(LibLeads::$sources[$params['source']]))
        {
            $sql_params['source'] = $params['source'];
        }

        if(isset($params['created_by']))
        {
            $sql_params['created_by'] = $params['created_by'];
        }

        if(isset($params['show_at']))
        {
            $sql_params['show_at'] = $params['show_at'];
        }

        $sql_params['priority'] = LibLeads::$sources[$sql_params['source']]['priority'];



        $set =  $this->make_set_string($sql_params);

        $q = "INSERT INTO `leads` SET $set ;";

        $r = $this->db_q($q, true);
        if($r['result'] != 'success')
        {
            (new Log())->error([
                'e' => 'Ошибка при добавлении лида Lead.add',
                'params' => $params,
                'error' => $r['mysql_error'],
                'sql_params' => $sql_params,
            ]);
            return ['result' => 'error', 'error' => 'ERROR DELTA#1023'];
        }
        $lid = $r['lid'];


        $event_r = $this->add_lead_event([
            'alias' => 'new',
            'id_lead' => $lid,
            'id_user' => $sql_params['created_by'],
            'show_at' => $now
        ]);

        $this->update_field($lid, 'last_event_id', $event_r['id_event']);

        return ['result' => 'success', 'id_lead' => $lid];
    }

    /**
     * alias *
     * id_lead *
     * id_user *
     * show_at def:null
     * reject_reason def:null
     */
    public function add_lead_event($params): array
    {
        $sql_params = [
            'alias' => $params['alias'],
            'id_lead' => $params['id_lead'],
            'id_user' => $params['id_user'],
            'show_at' => null
        ];

        if(isset($params['show_at']))
        {
            $sql_params['show_at'] = $params['show_at'];
        }

        if(isset($params['data']))
        {
            $sql_params['data'] = json_encode($params['data'], 256);
        }

        $set =  $this->make_set_string($sql_params);

        $q = "INSERT INTO `lead_events` SET $set ;";
        $r = $this->db_q($q, true);
        $event_lid = $r['lid'];
        return ['result' => 'success', 'id_event' => $event_lid];
    }
}