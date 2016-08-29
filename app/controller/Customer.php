<?php
class Customer extends Controller {

    public function index() {

    }

    public function login() {
        $customer = new CustomerModel();
        $username = $this->getParam("username");
        $password = $this->getParam("password");
        $customer->login($username, $password);
    }

    public function register() {
        $customer = new CustomerModel();
        $username = $this->getParam("username");
        $password = $this->getParam("password");
        $email = $this->getParam("email");
        $customer->register($username, $password,$email);
    }

    public function logout() {
    }

    public function account() {


    }

}