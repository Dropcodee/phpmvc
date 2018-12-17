<?php
 
 // loads the models and the views

 class Controller {

    // loads models

    public function model($model) {
        require_once('../app/models/' . $model . '.php');

        // Instatiate models
        
        return new $model();

    }


    // view method that loads view 

    public function view($view, $data = []) {

        if(file_exists('../app/views/' . $view . '.php')) {
            require_once('../app/views/' . $view . '.php');
        } else {
            die("file doesnt exist");
        }
    }
 }