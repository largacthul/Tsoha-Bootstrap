<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function job_list(){
      //Listaussivu
      View::make('suunnitelmat/job_list.html');
    }

    public static function job_edit(){
      //Muokkaus
      View::make('suunnitelmat/job_edit.html');
    }

    public static function login(){
      //Kirjautuminen
      View::make('suunnitelmat/login.html');
    }
  }
