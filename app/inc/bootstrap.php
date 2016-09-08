<?php
function __autoload($class)
{
    $path1 = APP_ROOT . "/lib/" . $class . '.php';
    $path2 = APP_ROOT . "/app/model/" . $class . '.php';
    $path3 = APP_ROOT . "/app/controller/" . $class . '.php';
    $path4 = APP_ROOT . "/app/view/classes/" . $class . '.php';

    if (file_exists($path1)) {
        include $path1;
    }

    if (file_exists($path2)) {
        include $path2;
    }

    if (file_exists($path3)) {
        include $path3;
    }

    if (file_exists($path4)) {
        include $path4;
    }
}

require_once 'config.php';

FileVault::model('Session')->start();






















