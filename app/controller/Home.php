<?php

class Home extends Controller
{

   public function index($param = '')
   {
       $this->data['errors'] = null;
       $this->setLayout("login")->renderLayout();
   }

   public function register()
   {
       $this->data['errors'] = null;
       $this->setLayout("registr")->renderLayout();
   }
}