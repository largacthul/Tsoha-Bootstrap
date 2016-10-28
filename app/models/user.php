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
        'salasana' => $row['salasana'],
        'admin' => $row['admin']
      ));
      return $user;
    }else{
      return null;
    }
  }

  public function all() {
    $query = DB::connection()->prepare('SELECT * FROM NoteOwner ORDER BY id');
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

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO NoteOwner (tunnus, nimi, kuvaus, salasana, admin) VALUES (:tunnus, :nimi, :kuvaus, :salasana, :admin)');
    $query->execute(array('tunnus' => $this->tunnus, 'nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'salasana' => $this->salasana, 'admin' => $this->admin));
    // $row = $query->fetch();
    // $this->id = $row['id'];
  }

  public function update($id) {
    //päivitetään NoteOwner
    $query = DB::connection()->prepare('UPDATE NoteOwner SET tunnus = :tunnus, nimi = :nimi, kuvaus = :kuvaus, salasana = :salasana, admin = :admin WHERE id = :id');
    $query->execute(array('id' => $this->id, 'tunnus' => $this->tunnus, 'nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'salasana' => $this->salasana, 'admin' => $this->admin));
  }

  public static function destroy($id) {
    //tuhotaan linkit käyttäjän noteista luokkiin
    $note_ids = self::get_note_ids($id);

    foreach ($note_ids as $note_id) {
      $query = DB::connection()->prepare('DELETE FROM NoteLabel WHERE note_id = :note_id');
      $query->execute(array('note_id' => $note_id));
    }
    // tuhotaan käyttäjän notet
    $query = DB::connection()->prepare('DELETE FROM Note WHERE noteowner_id = :id');
    $query->execute(array('id' => $id));

    // destroy user
    $query = DB::connection()->prepare('DELETE FROM NoteOwner WHERE id = :id');
    $query->execute(array('id' => $id));

  }

  public function num_notes($id) {

    $query = DB::connection()->prepare('SELECT * FROM Note WHERE noteowner_id = :id');
    $query->execute(array('id' => $id));
    $rows = $query->fetchAll();

    return count($rows);
  }

  public function get_note_ids($id) {
    $query = DB::connection()->prepare('SELECT * FROM Note WHERE noteowner_id = :id');
    $query->execute(array('id' => $id));
    $rows = $query->fetchAll();
    $note_ids = array();

    foreach ($rows as $row) {
      $note_ids[] = $row['id'];
    }

    return $note_ids;
  }

}
