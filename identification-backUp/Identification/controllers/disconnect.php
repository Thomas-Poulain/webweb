<?php
require(__ROOT__.'/controllers/Controller.php');

class UnconnectController extends Controller{

    /**
     * Disconnect the user
     * @param $request
     */
    public function get($request){
        $id = session_id();
        $uc = new UsersConnected();
        $uc->checkAlreadyConnect($id);
        session_destroy();
        $this-> render('/main',["message" => "Vous êtes déconnecté"]);
    }
}
?>