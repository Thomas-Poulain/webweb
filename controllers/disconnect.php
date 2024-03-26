<?php
require(__ROOT__.'/controllers/Controller.php');

class UnconnectController extends Controller{

    /**
     * Disconnect the user
     * @param $request
     */
    public function get($request){
        session_destroy();
        header('Location: /');
    }
}
?>