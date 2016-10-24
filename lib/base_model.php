<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $virheet = array();
        $testi_metodi = $validator;
        $virheet = $this->{$testi_metodi}();
        $errors = array_merge($errors, $virheet);
      }

      return $errors;
    }

    public function validate_otsikko() {
      $errors = array();
      if($this->otsikko == '' || $this->otsikko == null){
        $errors[] = 'Otsikko ei saa olla tyhjä!';
      }
      if(strlen($this->otsikko) < 3){
        $errors[] = 'Otsikon pituuden tulee olla vähintään kolme merkkiä!';
      }

      if(strlen($this->otsikko) > 50) {
        $errors[] = 'Otsikon maksimipituus on 50 merkkiä!';
      }
      return $errors;
    }

    public function validate_kuvaus() {
      $errors = array();
      if(strlen($this->kuvaus) > 200) {
        $errors[] = 'Kuvauksen maksimipituus on 200 merkkiä!';
      }
      return $errors;
    }

    public function validate_deadline() {
      // tarkistetaan että deadline sopivassa muodossa tietokantaan
      $pattern = '';
      // tarkistetaan että deadline ei ole menneisyydessä

    }

    public function validate_tunnus() {
      $errors = array();
      if($this->tunnus == '' || $this->tunnus == null){
        $errors[] = 'Tunnus ei saa olla tyhjä!';
      }
      if(strlen($this->tunnus) > 30) {
        $errors[] = 'Tunnuksen maksimipituus on 30 merkkiä!';
      }

      return $errors;
    }

    public function validate_nimi() {
      $errors = array();
      if($this->nimi == '' || $this->nimi == null){
        $errors[] = 'Nimi ei saa olla tyhjä!';
      }
      if(strlen($this->nimi) > 30) {
        $errors[] = 'Nimen maksimipituus on 30 merkkiä!';
      }

      return $errors;
    }

    public function validate_user_kuvaus() {
      $errors = array();
      if(strlen($this->kuvaus) > 120) {
        $errors[] = 'Kuvauksen maksimipituus on 120 merkkiä!';
      }

      return $errors;
    }

    public function validate_salasana() {
      $errors = array();
      if($this->salasana == '' || $this->salasana == null){
        $errors[] = 'Salasana ei saa olla tyhjä!';
      }
      if(strlen($this->salasana) > 30) {
        $errors[] = 'Salasanan maksimipituus on 30 merkkiä!';
      }

      return $errors;
    }

    public function validate_label_nimi() {
      $errors = array();
      if($this->nimi == '' || $this->nimi == null) {
        $errors[] = 'Tyhjä ei käy!';
      }
      if(strlen($this->nimi) > 30) {
        $errors[] = 'Maksimipituus 30 merkkiä';
      }

      return $errors;
    }

  }
