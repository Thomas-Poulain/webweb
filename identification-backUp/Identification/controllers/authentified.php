<?php
require(__ROOT__.'/controllers/Controller.php');

class AuthentifiedController extends Controller{

    /**
     * Get user data by session ID
     * @param $request
     */
    public function get($request){
        // Check if session ID provided in query parameter
        if(isset($_GET['id'])){
            $session_id = $_GET['id'];
            $uc = new UsersConnected();
            // Response success, return code 200 and user data
            header("HTTP/1.1 200 OK");
            echo json_encode($uc->getUserBySessionId($session_id));
        } else {
            // No session ID provided, return error with code 400
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(array('error' => 'Session ID not provided'));
            return;
        }
    }
}
?>
