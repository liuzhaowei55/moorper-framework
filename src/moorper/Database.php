<?php
namespace moorper;

use Illuminate\Database\Capsule\Manager as Capsule;

// Eloquent ORM
class Database
{

    public static function init()
    {
        $capsule = new Capsule;
        $capsule->addConnection(Config::get('database'));
        $capsule->bootEloquent();
    }

}
