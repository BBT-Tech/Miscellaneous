<?php

class Config
{
    public static $db = [
        'host' => '127.0.0.1',
        'port' => '3306',
        'charset' => 'utf8',

        'database' => 'DATABASE_NAME',
        'username' => 'DATABASE_USERNAME',
        'password' => 'DATABSE_PASSWORD'
    ];

    // Raw SQL used here to
    // speed up the development
    // and prevent leaking of database structure details
    public static $sql = [
        'select' => '',
        'reset' => ''
    ];

    public static $auth = [
        'user' => 'AUTH_USER',
        'pwd' => 'AUTH_PWD'
    ];
}
