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
}