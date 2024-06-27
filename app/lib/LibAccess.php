<?php


class LibAccess
{
    static array $modules = [
        'admin' => ['roles' => ['admin'], 'module' => 'AdminModule'],
        'index' => ['module' => 'IndexModule'],
        'auth' => ['module' => 'AuthModule'],
        'user' => ['module' => 'UserModule'],
    ];
}