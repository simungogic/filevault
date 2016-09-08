<?php

class Request
{
    protected $params;
    static $instance;

    protected function __clone()
    {
    }

    public function setParams($params)
    {
        if(!empty($params))
        {
            $counter = 0;
            foreach ($params as $key)
            {
                $counter++;
                if($counter % 2 == 0)
                {
                   $arrayKeys[$params[$counter - 2]] = $key;
                }
                else
                {
                    $arrayKeys[$key] = null;
                }
            }
        }
        else
        {
            $arrayKeys = null;
        }
        $this->params = $arrayKeys;
    }

    public function getParam($name)
    {
        if(isset($this->params[$name]))
        {
            return $this->params[$name];
        }
        return null;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Request();
        }
        return self::$instance;
    }
}