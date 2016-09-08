<?php

class Router
{
    protected $controller;
    protected $method;
    protected $params = [];

    public function __construct()
    {
        $url = $this->_parseUrl();
        $url[0] = ucfirst($url[0]);
        if (file_exists(APP_ROOT . '/app/controller/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        if(empty($this->_parseUrl()))
        {
            $this->controller = "Home";
            $this->method = "index";
        }

        if(!class_exists($this->controller)) {
            $this->set404();
        }

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->set404();
            }
        } else {
            $this->method = "index";
        }

        $this->params = $url ? array_values($url):null;
        FileVault::model('request')->setParams($this->params);
        $value[] = FileVault::model('request')->getParam('key');
        call_user_func_array([$this->controller, $this->method], $value);
    }

    public function set404()
    {
        echo "404 Page not found";
        header("HTTP/1.0 404 Not Found");
        exit;
    }

    private function _parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}