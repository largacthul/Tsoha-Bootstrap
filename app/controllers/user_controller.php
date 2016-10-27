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
    Redirect::to('/admin', array('message' => 'Käyttäjien luonti ei onnistu tätä kautta!'));
  }
}
