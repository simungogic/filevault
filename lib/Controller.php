<?php
class Controller {
    //public $layout;
    //protected $data=array();


    protected $views = array();
    /*public function setLayout($layout) {
        $this->layout = APP_ROOT."/app/view/" . $layout . ".phtml";
        return $this;
    }*/

    public function __construct()
    {
        $model = FileVault::model('Session');
        if($model->isLoggedIn())
        {
            echo "true";
        }
    }

    public function renderLayout()
    {
        $html = '';
        if (!empty($this->views)) {
            foreach ($this->views as $viewInfo) {
                extract(array('view' => new $viewInfo['class']));
                ob_start();
                require $viewInfo['template'];
                $html .= ob_get_clean();
            }
        }
        echo $html;
    }

    public function getParam($key) {
        if(array_key_exists($key, $_POST)) {
            $value =  $_POST[$key];
        } elseif(array_key_exists($key, $_GET)) {
            $value = $_GET[$key];
        } else {
            $value = null;
        }

        return $value;
    }

    public function getView($name)
    {
        $path = APP_ROOT . '/app/view/template/' . $name . '.phtml';
        $class = 'View';
        $searchClass = ucfirst(strtolower($name)).'View';

        if(class_exists($searchClass))
        {
            $class = $searchClass;
        }

        $this->views[$name] = array('class' => $class,
                                    'template' => $path);
    }
}
