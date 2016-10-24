<?php

class NoteController extends BaseController {

  public static function index(){
//    self::check_logged_in();
    $user = self::get_user_logged_in();
    if(!$user) {
      View::make('user/login.html');
    }else{
      $notes = Note::all($user->id);
      View::make('note/index.html', array('notes' => $notes));
    }
  }

  public static function show($id) {
    self::check_logged_in();
    $note = Note::find($id);
    View::make('note/show.html', array('note' => $note));
  }

  public static function create() {
    self::check_logged_in();
    View::make('note/new.html');
  }

  public static function store(){
    self::check_logged_in();
    $user = self::get_user_logged_in();
    $params = $_POST;
    $note = new Note(array(
      'noteowner_id' => $user->id,
      'otsikko' => $params['otsikko'],
      'kuvaus' => $params['kuvaus'],
      'deadline' => $params['deadline'],
      'prioriteetti' => $params['prioriteetti']
    ));

    $note->save();

    Redirect::to('/note/' . $note->id, array('message' => 'Askare on lisätty muistioosi!'));
  }

  public static function edit($id) {
    self::check_logged_in();
    $note = Note::find($id);
    View::make('note/edit.html', array('note' => $note));
  }

  public static function update($id) {
    self::check_logged_in();
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'otsikko' => $params['otsikko'],
      'kuvaus' => $params['kuvaus'],
      'deadline' => $params['deadline'],
      'prioriteetti' => $params['prioriteetti'],
      'valmis' => $params['valmis']
    );

    $note = new Note($attributes);
    $errors = $note->errors();

    if(count($errors) > 0){
      View::make('note/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      $note->update($id);

      Redirect::to('/note/' . $note->id, array('message' => 'Askaretta on muokattu onnistuneesti!'));
    }
   }

  public static function destroy($id){
    self::check_logged_in();
    $note = new Note(array('id' => $id));
    $note->destroy($id);


    Redirect::to('/note', array('message' => 'Askare on poistettu onnistuneesti!'));
  }
}
