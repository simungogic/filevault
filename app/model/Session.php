<?php

class Session
{
    static $session = null;
    protected $loggedIn = false;

    protected function __clone()
    {
    }

    public function start()
    {
        session_start();
    }

    public function destroy()
    {
        session_destroy();
    }

    public function set($value, $id)
    {
        $_SESSION['username'] = $value;
        $_SESSION['userid'] = $id;
    }

    public function get($name)
    {
        if(isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
        return null;
    }

    public function display()
    {
        var_dump($_SESSION);
    }

    public function isLoggedIn()
    {
        if(isset($_SESSION['username']))
        {
            $this->loggedIn = true;
        }
        return $this->loggedIn;
    }

    public static function getInstance()
    {
        if (self::$session === null) {
            self::$session = new Session();
        }
        return self::$session;
    }
}