<?php

class NoteController extends BaseController {

  public static function index(){
    $notes = Note::all();
    View::make('note/index.html', array('notes' => $notes));
  }

  public static function show($id) {
    $note = Note::find($id);
    View::make('note/show.html', array('note' => $note));
  }

  public static function create() {
    View::make('note/new.html');
  }

  public static function store(){
    $params = $_POST;
    $note = new Note(array(
      'otsikko' => $params['otsikko'],
      'kuvaus' => $params['kuvaus'],
      'deadline' => $params['deadline']
    ));

    $note->save();

    Redirect::to('/note/' . $note->id, array('message' => 'Askare on lisätty muistioosi!'));
  }

  public static function edit($id) {
    $note = Note::find($id);
    View::make('note/edit.html', array('note' => $note));
  }

  public static function update($id) {
    $params = $_POST;

    $attributes = array(
      'id' => $id,
      'otsikko' => $params['otsikko'],
      'kuvaus' => $params['kuvaus'],
      'deadline' => $params['deadline']
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
    $note = new Note(array('id' => $id));
    $note->destroy($id);


    Redirect::to('/note', array('message' => 'Askare on poistettu onnistuneesti!'));
  }
}
