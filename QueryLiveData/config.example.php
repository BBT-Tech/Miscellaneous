<?php

class Config
{
    public static $db = [
        'host' => '127.0.0.1',
        'port' => '3306',

        'username' => 'DATABASE_USERNAME',
        'password' => 'DATABSE_PASSWORD'
    ];

    public static $queries = [
        'key' => 'value',
        'autumn-recruit' => 'SELECT COUNT(*) AS total FROM dbname.recruit'
    ];
}
