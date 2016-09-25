<?php

class NoteController extends BaseController {

  public static function index(){
    $notes = Note::all();
    View::make('note/index.html', array('notes' => $notes));
  }
}
