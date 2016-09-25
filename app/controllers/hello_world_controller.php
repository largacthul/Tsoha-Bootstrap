<?php

  // require 'app/models/note.php';
  // require 'app/models/label.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('suunnitelmat/frontpage.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      // View::make('helloworld.html');
      $katsastus = Note::find(1);
      $notes = Note::all();
      $luokitus = Label::find(1);
      $labels = Label::all();
      //Kint dumps
      Kint::dump($katsastus);
      Kint::dump($notes);
      Kint::dump($luokitus);
      Kint::dump($labels);
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
