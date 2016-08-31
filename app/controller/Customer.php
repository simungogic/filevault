<?php
class Customer extends Controller {

    public function index() {

    }

    public function login() {
        $customer = new CustomerModel();
        $username = $this->getParam("username");
        $password = $this->getParam("password");
        $customer->login($username, $password);
        if (!empty($_POST))
        {
            $this->data['errors'] = $customer->login($username,$password);
            if(empty($this->data['errors']))
            {

            }
        }

        $this->setLayout("login")->renderLayout();
    }

    public function register() {
        $customer = new CustomerModel();
        $username = $this->getParam("username");
        $password = $this->getParam("password");
        $email = $this->getParam("email");
        if (!empty($_POST))
        {
            $this->data['errors'] = $customer->validateReg($username,$password,$email);
            if(empty($this->data['errors']))
            {
                $customer->register($username,$password,$email);
            }
        }

        $this->setLayout("registr")->renderLayout();

    }

    public function logout() {
    }

    public function account() {


    }

}