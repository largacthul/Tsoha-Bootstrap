<?php

  $routes->get('/', function() {
    NoteController::index();
  });

  $routes->get('/note', function(){
    NoteController::index();
  });

  $routes->post('/note', function(){
    NoteController::store();
  });

  $routes->get('/note/new', function(){
    NoteController::create();
  });

  $routes->get('/note/:id', function($id) {
    NoteController::show($id);
  });

  $routes->get('/note/:id/edit', function($id){
    NoteController::edit($id);
  });

  $routes->post('/note/:id/edit', function($id){
    NoteController::update($id);
  });

  $routes->post('/note/:id/destroy', function($id){
    NoteController::destroy($id);
  });

  $routes->get('/labels', function() {
    LabelController::index();
  });

  $routes->post('/labels', function() {
    LabelController::store();
  });

  $routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
    UserController::login();
  });
  $routes->post('/login', function(){
    // Kirjautumisen käsittely
    UserController::handle_login();
  });

  $routes->get('/admin', function(){
  // Kirjautumislomakkeen esittäminen
    UserController::index();
  });

  $routes->get('/admin/new', function(){
  // Kirjautumislomakkeen esittäminen
    UserController::create();
  });

  $routes->post('/admin', function(){
    UserController::store();
  });

  $routes->get('/admin/:id/edit', function($id){
    UserController::edit($id);
  });

  $routes->post('/admin/:id/edit', function($id){
    UserController::update($id);
  });

  $routes->post('/admin/:id/destroy', function($id){
    UserController::destroy($id);
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/job_list', function() {
    HelloWorldController::job_list();
  });

  $routes->get('/job_edit', function() {
    HelloWorldController::job_edit();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });
