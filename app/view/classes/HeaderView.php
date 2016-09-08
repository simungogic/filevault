<?php

class HeaderView extends View
{
    protected $loggedIn = false;

    public function __construct()
    {
        //todo logika za provjeru jel logiran
    }

   public function isLoggedIn()
    {

            $this->loggedIn = true;

        return $this->loggedIn;

    }
}