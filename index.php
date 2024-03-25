<?php
ini_set('display_errors', 'On');
define ("__ROOT__",__DIR__);

//paramètrage de lax session
if (!isset($_SESSION)){
    session_start();
    setcookie("session_id", session_id(), time()+3600, "/");
}

// Configuration
require (MODEL_DIR.'/user.php');
require_once (__ROOT__.'/config.php');

// ApplicationController
require_once (CONTROLLERS_DIR.'/ApplicationController.php');

// Add routes here
ApplicationController::getInstance()->addRoute('connect', CONTROLLERS_DIR.'/connect.php');
ApplicationController::getInstance()->addRoute('disconnect', CONTROLLERS_DIR.'/disconnect.php');
ApplicationController::getInstance()->addRoute('createUser', CONTROLLERS_DIR.'/CreateUser.php');

// Process the request
ApplicationController::getInstance()->process();