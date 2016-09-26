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

    // Kint::dump($params);

    $note->save();

    Redirect::to('/note/' . $note->id, array('message' => 'Askare on lisätty muistioosi!'));
  }
}
