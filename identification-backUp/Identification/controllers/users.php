<?php
require(__ROOT__.'/controllers/Controller.php');

class UsersController extends Controller{

    /**
     * Get all users
     * @param $request
     */
    public function get($request){
        try{
            header("HTTP/1.1 200 OK");
            $uc = new UsersConnected();
            $users = $uc->getUserConnected();
            echo json_encode($users);
        }catch(Exception $e){
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(array('error' => $e->getMessage()));
        }
    }
}
?>
