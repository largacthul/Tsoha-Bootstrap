<?php

class Label extends BaseModel {
  public $id, $nimi;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi');
  }

  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Label');
    $query->execute();
    $rows = $query->fetchAll();
    $labels = array();

    foreach($rows as $row){
      $labels[] = new Label(array(
        'id' => $row['id'],
        'nimi' => $row['nimi']
      ));
    }

    return $labels;
  }

  // public static function all($note_id){
  //   $query = DB::connection()->prepare('SELECT * FROM Label WHERE id = :id');
  //   $query->execute();
  //   $rows = $query->fetchAll();
  //   $labels = array();
  //
  //   foreach($rows as $row){
  //     $labels[] = new Label(array(
  //       'id' => $row['id'],
  //       'nimi' => $row['nimi']
  //     ));
  //   }
  //
  //   return $labels;
  // }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Label WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $label = new Label(array(
        'id' => $row['id'],
        'nimi' => $row['nimi']
      ));

      return $label;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Label (nimi) VALUES (:nimi) RETURNING id');
    $query->execute(array('nimi' => $this->nimi));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update($id) {
    $query = DB::connection()->prepare('UPDATE Label SET nimi = :nimi WHERE id = :id');
    $query->execute(array('id' => $this->id, 'nimi' => $this->nimi));
  }

  public static function destroy($id) {
    $query = DB::connection()->prepare('DELETE FROM Label WHERE id = :id');
    $query->execute(array('id' => $id));
  }
}
