<?php

class AssetView extends View
{
    public function isLoggedIn()
    {
        return $this->loggedIn;
    }
}