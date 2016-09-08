<?php

class View
{
    protected $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setVar($name,$value)
    {
        $this->data[$name] = $value;
    }

    public function getVar()
    {
        //echo $this->data[];
    }
}