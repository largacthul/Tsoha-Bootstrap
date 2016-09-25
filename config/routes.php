<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/note', function(){
    NoteController::index();
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
