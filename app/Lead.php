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
     */
    public function add($params): array
    {

        $params = $this->sanitise_all($params);
        if(!isset($params['phone']) || strlen($params['phone']) !== 10) {
            (new Log())->error(['e' => 'Попытка добавить неформатный телефон в lead.add', 'd' => $params]);
            $this->e('no phone in lead.add');
        }

        if(!ctype_digit($params['phone'])) {$this->e('phone not valid');}

        $sql_params = [
            'phone' => $params['phone'],
            'stage' => 'underwriting',
            'source' => '2',
        ];


        if(isset($params['stage']) && isset(LibLeads::$stages[$params['stage']]))
        {
            $sql_params['stage'] = $params['stage'];
        }

        if(isset($params['source']) && isset(LibLeads::$sources[$params['source']]))
        {
            $sql_params['source'] = $params['source'];
        }

        $sql_params['priority'] = LibLeads::$sources[$sql_params['source']]['priority'];



        $set =  $this->make_set_string($sql_params);

        $q = "INSERT INTO `leads` SET $set ;";

        $r = $this->db_q($q);
        if($r['result'] != 'success')
        {
            (new Log())->error([
                'e' => 'Ошибка при добавлении лида Lead.add',
                'params' => $params,
                'error' => $r['mysql_error'],
                'sql_params' => $sql_params,
            ]);
            $this->e('ERROR DELTA#1023');
        }


        // todo сгенерировать show_at
        // todo сгенерировать history
        // todo возвращать lid

        return ['result' => 'success', 'id' => 666];
    }
}