<?php

class UserController extends BaseController{

  public static function login(){
      View::make('user/login.html');
  }

  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }

  public static function handle_login(){
    $params = $_POST;

    $user = User::auth($params['username'], $params['password']);

    if(!$user){
      View::make('user/login.html', array('errors' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
    }
  }

  public static function index(){
    $user = self::get_user_logged_in();
    if(!$user) {
      View::make('user/login.html');
    }else{
      $users = User::all($user->id);
      View::make('user/admin.html', array('users' => $users));
    }
  }

  public static function create() {
    self::check_logged_in();
    View::make('/user/user-new.html');
  }

  public static function store(){
    self::check_logged_in();
    $params = $_POST;

    //tarkistetaan oliko admin-checkbox valittu
    if(count($params) < 5) {
      $params['admin'] = 'false';
    }

    $attributes = array(
      'tunnus' => $params['tunnus'],
      'nimi' => $params['nimi'],
      'kuvaus' => $params['kuvaus'],
      'salasana' => $params['salasana'],
      'admin' => $params['admin']
    );
    $user = new User($attributes);
    $errors = $user->errors();

    if(count($errors) > 0){
      View::make('user/user-new.html', array('errors' => $errors, 'user' => $attributes));
    }else{
      $user->save();

      Redirect::to('/admin', array('message' => 'Käyttäjä on lisätty palveluun'));
    }
  }

  public static function edit($id) {
    self::check_logged_in();
    $user = User::find($id);
    View::make('user/user-edit.html', array('user' => $user));
  }

  public static function update($id) {
    self::check_logged_in();
    $params = $_POST;

    //tarkistetaan oliko admin-checkbox valittu
    if(count($params) < 6) {
      $params['admin'] = 'false';
    }

    $attributes = array(
      'id' => $id,
      'tunnus' => $params['tunnus'],
      'nimi' => $params['nimi'],
      'kuvaus' => $params['kuvaus'],
      'salasana' => $params['salasana'],
      'admin' => $params['admin']
    );

    $user = new User($attributes);
    $errors = $user->errors();

    if(count($errors) > 0){
      View::make('user/user-edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      $user->update($id);

      Redirect::to('/admin', array('message' => 'Käyttäjää on muokattu onnistuneesti!'));
    }
  }

  public static function destroy($id){
    self::check_logged_in();
    $user = new User(array('id' => $id));
    $user->destroy($id);

    Redirect::to('/admin', array('message' => 'Käyttäjä on poistettu onnistuneesti!'));
  }

}
