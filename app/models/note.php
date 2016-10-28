<?php
class Note extends BaseModel {
  public $id, $noteowner_id, $otsikko, $kuvaus, $deadline, $prioriteetti, $valmis, $lisays_paiva, $labels;

  public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_otsikko', 'validate_kuvaus');
  }

  public function get_labels($note_id) {
    $query = DB::connection()->prepare('SELECT Label.id, Label.nimi FROM NoteLabel INNER JOIN Note ON Note.id = NoteLabel.note_id INNER JOIN Label ON Label.id = NoteLabel.label_id WHERE Note.id = :id');
    $query->execute(array('id' => $note_id));
    $notelabels = $query->fetchAll();
    $labels = array();

    foreach ($notelabels as $notelabel) {
      $labels[] = new Label(array(
        'id' => $notelabel['id'],
        'nimi' => $notelabel['nimi']
      ));
    }
    return $labels;
  }

  public function get_label_ids($id) {
    $query = DB::connection()->prepare('SELECT * FROM Label WHERE note_id = :id');
    $query->execute(array('id' => $id));
    $rows = $query->fetchAll();
    $note_ids = array();

    foreach ($rows as $row) {
      $label_ids[] = $row['id'];
    }

    return $label_ids;
  }

  public static function all($user){

    $query = DB::connection()->prepare('SELECT * FROM Note WHERE noteowner_id = :user ORDER BY deadline');
    $query->execute(array('user' => $user));
    $rows = $query->fetchAll();
    $notes = array();
    $labels = array();

    foreach($rows as $row){
      $notes[] = new Note(array(
        'id' => $row['id'],
        'otsikko' => $row['otsikko'],
        'kuvaus' => $row['kuvaus'],
        'deadline' => $row['deadline'],
        'prioriteetti' => $row['prioriteetti'],
        'valmis' => $row['valmis'],
        'lisays_paiva' => $row['lisays_paiva'],
        'labels' => Note::get_labels($row['id'])

      ));
    }

    return $notes;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Note WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();
    $labels = array();

    if($row){
      $note = new Note(array(
        'id' => $row['id'],
        'otsikko' => $row['otsikko'],
        'kuvaus' => $row['kuvaus'],
        'deadline' => $row['deadline'],
        'prioriteetti' => $row['prioriteetti'],
        'valmis' => $row['valmis'],
        'lisays_paiva' => $row['lisays_paiva'],
        'labels' => Note::get_labels($row['id'])
      ));

      return $note;
    }

    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Note (noteowner_id, otsikko, kuvaus, deadline, prioriteetti) VALUES (:noteowner_id, :otsikko, :kuvaus, :deadline, :prioriteetti) RETURNING id');
    $query->execute(array('noteowner_id' => $this->noteowner_id, 'otsikko' => $this->otsikko, 'kuvaus' => $this->kuvaus, 'deadline' => $this->deadline, 'prioriteetti' => $this->prioriteetti));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

  public function update($id, $labels) {
    //päivitetään Note
    $query = DB::connection()->prepare('UPDATE Note SET otsikko = :otsikko, kuvaus = :kuvaus, deadline = :deadline, prioriteetti = :prioriteetti, valmis = :valmis WHERE id = :id');
    $query->execute(array('id' => $this->id, 'otsikko' => $this->otsikko, 'kuvaus' => $this->kuvaus, 'deadline' => $this->deadline, 'prioriteetti' => $this->prioriteetti, 'valmis' => $this->valmis));
    //päivitetään NoteLabel
    foreach ($labels as $label) {
       $label_id = $label;
       $query = DB::connection()->prepare('INSERT INTO NoteLabel (note_id, label_id) VALUES (:id, :label_id)');
       $query->execute(array('id' => $id, 'label_id' => $label_id));
     }
  }

  public static function destroy($id) {
    //tuhotaan noten linkit labeleihin
    $query = DB::connection()->prepare('DELETE FROM NoteLabel WHERE note_id = :id');
    $query->execute(array('id' => $id));
    //tuhotaan note
    $query = DB::connection()->prepare('DELETE FROM Note WHERE id = :id');
    $query->execute(array('id' => $id));


  }


}
