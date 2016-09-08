<?php
class User extends Controller {

    public function index() {
    }

    public function login() {
        $user = FileVault::model('UserModel');
        $session = FileVault::model('Session');
        $username = $this->getParam("username");
        $password = $this->getParam("password");
        $user->login($username, $password);
        if (!empty($_POST))
        {
            $this->data['errors'] = $user->login($username,$password);
            $userId = $user->getId($username,$password);
            if(empty($this->data['errors']))
            {
                //$session->start();
                $session->set($username,$userId);
                echo $session->get('userid');
                //$model->display();
            }
        }
         var_dump($this->data['errors']);//$this->get("login")->renderLayout();
    }

    public function register($param = '') {
        $user = FileVault::model('UserModel');
        $username = $this->getParam("username");
        $password = $this->getParam("password");
        $email = $this->getParam("email");
        if (!empty($_POST))
        {
            $this->data['errors'] = $user->validateReg($username,$password,$email);
            if(empty($this->data['errors']))
            {
                $user->register($username,$password,$email);
            }

        }
        var_dump($this->data['errors']);//$this->setLayout("registr")->renderLayout();
    }

    public function logout() {
    }

    public function account() {
    }

    public function verify($value)
    {
        $user = FileVault::model('UserModel');
        $user->verify($value);
    }
}