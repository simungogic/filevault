<?php

class FileVault
{

    public static function run()
    {
        try{
            new Router();
            }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public static function model($name)
    {
        $name = explode("_",$name);
        $ime = array();
        foreach ($name as $Name)
        {
            $Name = ucfirst($Name);
            $ime[] = $Name;
        }
        $name = implode($ime);

        if(method_exists($name, 'getInstance'))
        {
            return $name::getInstance();
        }

        return new $name;
    }

    public function url($path, $params = array())
    {
        return APP_ROOT.'/'.$path;
    }
}