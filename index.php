<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('APP_ROOT', getcwd());

require "app/inc/bootstrap.php";

FileVault::run();

