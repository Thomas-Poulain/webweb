<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require(__ROOT__.'/controllers/Controller.php');

class UnconnectController extends Controller{

    /**
     * Get method
     * @param $request
     */
    public function get($request){
        session_destroy();
        header('Location: /');
    }
}
?>