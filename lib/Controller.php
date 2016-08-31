<?php
class Controller {
    public $layout;
    protected $data=array();

    public function setLayout($layout) {
        $this->layout = APP_ROOT."/app/view/" . $layout . ".phtml";
        return $this;
    }

    public function renderLayout() {

        if(file_exists($this->layout)) {
            ob_start();
            extract($this->data);
            require_once($this->layout);
            echo ob_get_clean();
        } else {
            echo "Invalid layout";
        }
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
}
