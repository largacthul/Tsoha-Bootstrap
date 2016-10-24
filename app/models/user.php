<?php
class User extends BaseModel {
  public $id, $tunnus, $nimi, $kuvaus, $salasana;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_tunnus', 'validate_nimi', 'validate_user_kuvaus', 'validate_salasana');
  }

  public function auth($tunnus, $salasana) {
    $query = DB::connection()->prepare('SELECT * FROM NoteOwner WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
    $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
    $row = $query->fetch();
    if($row){
      $user = new User(array(
        'id' => $row['id'],
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi'],
        'kuvaus' => $row['kuvaus']
      ));
      return $user;
    }else{
      return null;
    }
  }

  public function find($id) {
    $query = DB::connection()->prepare('SELECT * FROM NoteOwner WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();
    if($row){
      $user = new User(array(
        'id' => $row['id'],
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi'],
        'kuvaus' => $row['kuvaus']
      ));
      return $user;
    }else{
      return null;
    }
  }

}
