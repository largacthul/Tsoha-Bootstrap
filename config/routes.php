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
