<?php
class User extends BaseModel {
  public $id, $tunnus, $nimi, $kuvaus, $salasana, $admin, $num_notes;

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
        'kuvaus' => $row['kuvaus'],
        'admin' => $row['admin']
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
        'kuvaus' => $row['kuvaus'],
        'admin' => $row['admin']
      ));
      return $user;
    }else{
      return null;
    }
  }

  public function all() {
    $query = DB::connection()->prepare('SELECT * FROM NoteOwner');
    $query->execute();
    $rows = $query->fetchAll();
    $users = array();


    foreach($rows as $row){
      $users[] = new User(array(
        'id' => $row['id'],
        'tunnus' => $row['tunnus'],
        'nimi' => $row['nimi'],
        'kuvaus' => $row['kuvaus'],
        'admin' => $row['admin'],
        'num_notes' => User::num_notes($row['id'])
      ));
    }

    return $users;
  }

  public function num_notes($id) {
    $query = DB::connection()->prepare('SELECT * FROM Note WHERE noteowner_id = :id');
    $query->execute(array('id' => $id));
    $rows = $query->fetchAll();
    return count($rows);
  }

}
