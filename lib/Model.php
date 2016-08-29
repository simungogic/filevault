<?php

class Model
{
    protected static $database;

    public static function getDatabase()
    {
         function __clone()
        {

        }

        if (!isset(Model::$database)) {
            Model::$database = new Database();
        }

        return Model::$database;
    }
}