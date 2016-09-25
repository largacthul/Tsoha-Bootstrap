<?php

class Label extends BaseModel {
  public $id, $nimi, $prioriteetti;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all(){

    $query = DB::connection()->prepare('SELECT * FROM Label');
    $query->execute();
    $rows = $query->fetchAll();
    $labels = array();

    foreach($rows as $row){
      $labels[] = new Label(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'prioriteetti' => $row['prioriteetti'],
      ));
    }

    return $labels;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Label WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $label = new Label(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'prioriteetti' => $row['prioriteetti'],
      ));

      return $label;
    }

    return null;
  }
}
