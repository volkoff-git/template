<?php

class LibLeads
{
     static array $stages = [
      'selling' => ['title' => 'Продажа'],
      'underwriting' => ['title' => 'Андеррайтинг'],
      'approved' => ['title' => 'Одобрен'],
      'rej_sell' => ['title' => 'Отказ ОП'],
      'rej_under' => ['title' => 'Отказ андеррайтера'],
      'rej_client' => ['title' => 'Отказ клиента'],
      'success' => ['title' => 'Выдан'],
      'add_data' => ['title' => 'На исправление'],
      'guarantor_req' => ['title' => 'Запрос поручителя'],
    ];


     static array $sources = [
      '1' => ['title' => 'Неизвестен', 'priority' => 1],
      '2' => ['title' => 'Создан вручную', 'priority' => 10],
      '3' => ['title' => 'Лендинг', 'priority' => 50],
    ];


     static array $lead_events_aliases = [
       'new' => ['title' => 'Добавлен новый'],
       'recall' => ['title' => 'Перезвонить'],
       'unavailable' => ['title' => 'Недозвон'],
       'incoming_call' => ['title' => 'Входящий звонок'],
       'missed_call' => ['title' => 'Пропущеный'],
       'rej_sell' => ['title' => 'Отказ ОП'],
       'rej_client' => ['title' => 'Отказ клиента'],
       'rej_guar' => ['title' => 'Отказ андеррайтера'],
       'approved' => ['title' => 'Одобрен'],
       'guar_request' => ['title' => 'Запрос поручителя'],
       'add_data' => ['title' => 'Анкета на исправление'],
     ];
}