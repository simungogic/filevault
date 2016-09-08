<?php

class Home extends Controller
{
   public function index($param = '')
   {
       $this->getView('header');
       $this->getView('home');
       $this->getView('footer');
       //$this->getView('');
       $this->renderLayout();
   }

   public function register()
   {
       $this->getView('registr');
       $this->renderLayout();
   }

   public function login()
   {
       $this->getView('login');
       $this->renderLayout();
   }
}