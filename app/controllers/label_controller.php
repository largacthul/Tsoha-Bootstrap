<?php

class LabelController extends BaseController {

  public static function index(){
//    self::check_logged_in();
    $user = self::get_user_logged_in();
    if(!$user) {
      View::make('user/login.html');
    }else{
      $labels = Label::all();
      View::make('labels/labels.html', array('labels' => $labels));
    }
  }

  // public static function show($id) {
  //   self::check_logged_in();
  //   $note = Note::find($id);
  //   View::make('note/show.html', array('note' => $note));
  // }

  // public static function create() {
  //   self::check_logged_in();
  //   View::make('labels/labels.html');
  // }

  public static function store(){
    self::check_logged_in();
    $user = self::get_user_logged_in();
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
    );
    $label = new Label($attributes);
    $errors = $label->errors();

    if(count($errors) > 0){
      View::make('labels/labels.html', array('errors' => $errors, 'label' => $attributes));
    }else{
      $label->save();

      Redirect::to('/labels', array('message' => 'Luokka lisätty!'));
    }
  }

  // public static function edit($id) {
  //   self::check_logged_in();
  //   $note = Note::find($id);
  //   View::make('note/edit.html', array('note' => $note));
  // }

  // public static function update($id) {
  //   self::check_logged_in();
  //   $params = $_POST;
  //
  //   $attributes = array(
  //     'id' => $id,
  //     'nimi' => $params['nimi']
  //   );
   //
  //   $note = new Note($attributes);
  //   $errors = $note->errors();
   //
  //   if(count($errors) > 0){
  //     View::make('note/edit.html', array('errors' => $errors, 'attributes' => $attributes));
  //   }else{
  //     $note->update($id);
   //
  //     Redirect::to('/note/' . $note->id, array('message' => 'Askaretta on muokattu onnistuneesti!'));
  //   }
  //  }

  // public static function destroy($id){
  //   self::check_logged_in();
  //   $note = new Note(array('id' => $id));
  //   $note->destroy($id);
  //
  //
  //   Redirect::to('/note', array('message' => 'Askare on poistettu onnistuneesti!'));
  // }
}
