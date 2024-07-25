<?php


class LibAccess
{
    static array $modules = [
        'admin' => ['roles' => ['admin'], 'module' => 'AdminModule'],
        'index' => ['module' => 'IndexModule'],
        'auth' => ['module' => 'AuthModule'],
        'user' => ['roles' => ['admin'], 'module' => 'UserModule'],
        'lead' => ['roles' => ['admin'], 'module' => 'LeadModule'],
        'api' => ['module' => 'ApiModule'],
        'external' => ['module' => 'ExternalModule'],
    ];



    static array $roles = [
      'broker' => ['title' => 'Брокер', 'assign' => true],
      'manager' => ['title' => 'Менеджер', 'assign' => true],
      'admin' => ['title' => 'Админ', 'assign' => false],
      'user' => ['title' => 'Сотрудник', 'assign' => false],
    ];
}