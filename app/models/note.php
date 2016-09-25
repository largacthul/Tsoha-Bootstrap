<?php
class Note extends BaseModel {
  public $id, $otsikko, $kuvaus, $deadline, $valmis;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all(){

    $query = DB::connection()->prepare('SELECT * FROM Note');
    $query->execute();
    $rows = $query->fetchAll();
    $notes = array();

    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $notes[] = new Note(array(
        'id' => $row['id'],
//        'player_id' => $row['player_id'],
        'otsikko' => $row['otsikko'],
        'kuvaus' => $row['kuvaus'],
        'deadline' => $row['deadline'],
        'valmis' => $row['valmis']
        // 'publisher' => $row['publisher'],
        // 'added' => $row['added']
      ));
    }

    return $notes;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Note WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $note = new Note(array(
        'id' => $row['id'],
        'otsikko' => $row['otsikko'],
        'kuvaus' => $row['kuvaus'],
        'deadline' => $row['deadline'],
        'valmis' => $row['valmis']
      ));

      return $note;
    }

    return null;
  }
}
