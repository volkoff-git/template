<?php


class LibAccess
{
    static array $modules = [
        'admin' => ['roles' => ['admin'], 'module' => 'AdminModule'],
        'index' => ['module' => 'IndexModule'],
        'auth' => ['module' => 'AuthModule'],
        'user' => ['module' => 'UserModule'],
        'lead' => ['module' => 'LeadModule'],
    ];



    static array $roles = [
      'user' => ['title' => 'Пользователь', 'assign' => true],
      'manager' => ['title' => 'Менеджер', 'assign' => true],
      'admin' => ['title' => 'Админ', 'assign' => false],
    ];
}