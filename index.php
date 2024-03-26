<?php
ini_set('display_errors', 'On');
define ("__ROOT__",__DIR__);
require_once (__ROOT__.'/config.php');

//paramètrage de lax session
if (!isset($_SESSION)){
    session_start();
}

// Configuration
require (MODEL_DIR.'/user.php');
require (MODEL_DIR.'/request_PDO.php');

// ApplicationController
require_once (CONTROLLERS_DIR.'/ApplicationController.php');

// Add routes here
ApplicationController::getInstance()->addRoute('connect', CONTROLLERS_DIR.'/connect.php');
ApplicationController::getInstance()->addRoute('disconnect', CONTROLLERS_DIR.'/disconnect.php');
ApplicationController::getInstance()->addRoute('createUser', CONTROLLERS_DIR.'/createUser.php');
ApplicationController::getInstance()->addRoute('resetPassword', CONTROLLERS_DIR.'/resetPassword.php');
ApplicationController::getInstance()->addRoute('main', CONTROLLERS_DIR.'/main.php');


// Process the request
ApplicationController::getInstance()->process();