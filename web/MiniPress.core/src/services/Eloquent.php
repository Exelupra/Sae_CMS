<?php

namespace minipress\core\services;

use Illuminate\Database\Capsule\Manager as DB;

class Eloquent
{
    public static function init($filename)
    {
        $config = parse_ini_file($filename);

        $db = new DB();
        $db->addConnection([
            'driver' => 'pgsql',
            'host' => $config['host'],
            'port' => $config['port'],
            'database' => $config['database'],
            'username' => $config['username'],
            'password' => $config['password'],
            'charset' => $config['charset'],
            'collation' => $config['collation'],
            'prefix' => $config['prefix']
        ]);
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}
