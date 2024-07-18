<?php

class LibLeads
{
     static array $stages = [
      'preparing_form' => ['title' => 'Подготовка анкеты'],
      'underwriting' => ['title' => 'Андеррайтинг'],
      'approved' => ['title' => 'Одобрен'],
      'rej_sell' => ['title' => 'Отказ ОП'],
      'rej_under' => ['title' => 'Отказ андеррайтера'],
      'rej_client' => ['title' => 'Отказ клиента'],
      'finished' => ['title' => 'Выдан'],
      'add_data' => ['title' => 'На исправление'],
      'guarantor_req' => ['title' => 'Запрос поручителя'],
      'leasing' => ['title' => 'Отправлен в лизинг'],
      'sign_docs' => ['title' => 'На подписании'],
      'signed' => ['title' => 'Документы подписаны'],
      'ready' => ['title' => 'Готов к выдаче'],
    ];


     static array $sources = [
      '1' => ['title' => 'Неизвестен', 'priority' => 1],
      '2' => ['title' => 'Офис', 'priority' => 10],
      '3' => ['title' => 'Лендинг', 'priority' => 50],
      '4' => ['title' => 'Менеджер', 'priority' => 50],
      '5' => ['title' => 'Брокер', 'priority' => 50],
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