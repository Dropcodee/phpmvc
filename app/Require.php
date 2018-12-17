<?php 

// LOAD CONFIG
require_once 'config/config.php';

// AUTO LOAD CORE LIBRARIES FROM THE LIB FOLDER IT GETS THE FILES BY THEIR CLASS NAME
// in this case your class namees in the lib folder has to be 
// the same with the file name
spl_autoload_register(function($className){
    require_once('lib/' . $className . '.php');
});