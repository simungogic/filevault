<?php

class Home extends Controller
{
   public function index($param = '')
   {
       $this->setLayout("login")->renderLayout();
   }

   public function register()
   {
       $this->setLayout("register")->renderLayout();
   }
}