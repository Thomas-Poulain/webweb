<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
define ("__ROOT__",__DIR__);

//paramètrage de la session
if (!isset($_SESSION)){
    session_start();
    setcookie("session_id", session_id(), time()+3600, "/");
}

// Configuration
require (__ROOT__.'/model/userDB.php');
require (__ROOT__.'/model/groupsDB.php');
require (__ROOT__.'/model/usersConnected.php');



require_once (__ROOT__.'/config.php');
require_once(__ROOT__.'/user/lib.php');
require_once(__ROOT__.'/group/lib.php');
require_once(__ROOT__.'/course/lib.php');
require_once(__ROOT__.'/lib/moodlelib.php');
require_once (__ROOT__.'/config2.php');

// ApplicationController
require_once (CONTROLLERS_DIR.'/ApplicationController.php');


// Add routes here
ApplicationController::getInstance()->addRoute('seeConfig', CONTROLLERS_DIR.'/seeConfig.php');
ApplicationController::getInstance()->addRoute('connect', CONTROLLERS_DIR.'/connect.php');
ApplicationController::getInstance()->addRoute('sa_classCreate', CONTROLLERS_DIR.'/sa_classCreate.php');
ApplicationController::getInstance()->addRoute('sa_courseCreate', CONTROLLERS_DIR.'/sa_courseCreate.php');
ApplicationController::getInstance()->addRoute('sa_userCreate', CONTROLLERS_DIR.'/sa_userCreate.php');
ApplicationController::getInstance()->addRoute('sa_confirm', CONTROLLERS_DIR.'/sa_confirm.php');
ApplicationController::getInstance()->addRoute('sa_error', CONTROLLERS_DIR.'/sa_error.php');

ApplicationController::getInstance()->addRoute('sa_groupsList', CONTROLLERS_DIR.'/sa_groupsList.php');
ApplicationController::getInstance()->addRoute('sa_usersList', CONTROLLERS_DIR.'/sa_usersList.php');


ApplicationController::getInstance()->addRoute('sa_download', CONTROLLERS_DIR.'/sa_download.php');
ApplicationController::getInstance()->addRoute('authentified', CONTROLLERS_DIR.'/authentified.php');
ApplicationController::getInstance()->addRoute('groups', CONTROLLERS_DIR.'/groups.php');
ApplicationController::getInstance()->addRoute('disconnect', CONTROLLERS_DIR.'/disconnect.php');
ApplicationController::getInstance()->addRoute('users', CONTROLLERS_DIR.'/users.php');

// Process the request
ApplicationController::getInstance()->process();

?>
