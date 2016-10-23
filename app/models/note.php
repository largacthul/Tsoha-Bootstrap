<?php
class Note extends BaseModel {
  public $id, $otsikko, $kuvaus, $deadline, $valmis, $lisays_paiva;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_otsikko', 'validate_kuvaus');
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
        'otsikko' => $row['otsikko'],
        'kuvaus' => $row['kuvaus'],
        'deadline' => $row['deadline'],
        'valmis' => $row['valmis'],
        'lisays_paiva' => $row['lisays_paiva']
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
        'valmis' => $row['valmis'],
        'lisays_paiva' => $row['lisays_paiva']
      ));

      return $note;
    }

    return null;
  }

  public function save(){
    // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
    $query = DB::connection()->prepare('INSERT INTO Note (otsikko, kuvaus, deadline) VALUES (:otsikko, :kuvaus, :deadline) RETURNING id');
    $query->execute(array('id' => $this->id, 'otsikko' => $this->otsikko, 'kuvaus' => $this->kuvaus, 'deadline' => $this->deadline));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update($id) {
    $query = DB::connection()->prepare('UPDATE Note SET otsikko = :otsikko, kuvaus = :kuvaus, deadline = :deadline WHERE id = :id');
    $query->execute(array('id' => $this->id, 'otsikko' => $this->otsikko, 'kuvaus' => $this->kuvaus, 'deadline' => $this->deadline));
  }

  public static function destroy($id) {
    $query = DB::connection()->prepare('DELETE FROM Note WHERE id = :id');
    $query->execute(array('id' => $id));
  }
}
