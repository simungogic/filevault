<?php

class Model
{
    function __clone()
    {
    }

    public function getDatabase()
    {
        return Database::getInstance();
    }
}