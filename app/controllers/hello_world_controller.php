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
//      View::make('helloworld.html');
      $testi_askare = new Note(array(
        'id' => '9',
        'otsikko' => 'joeoeoeoe',
        'kuvaus' => 'testimielessä kokeillaan',
        'deadline' => '2016-11-04 13:13:13'

      ));
      $id = $testi_askare->id;
      $errors = $testi_askare->errors();
      $testi_askare->update($id);
      Kint::dump($errors);
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

    public static function update($id) {
      $params = $_POST;

      $attributes = array(
        'id' => $id,
        'otsikko' => $params['otsikko'],
        'kuvaus' => $params['kuvaus'],
        'deadline' => $params['deadline']
      );

      Kint::dump($params);

      $note = new Note($attributes);
      $errors = $note->errors();
    }
  }
