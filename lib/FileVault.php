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


}