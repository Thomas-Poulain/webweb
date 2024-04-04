<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require_once(__ROOT__.'/controllers/Controller.php');

class ConnectController extends Controller{

    /**
     * Get method
     */
    public function get($request){
        if($_SESSION['username'] != "admin@admin"){
            $this->render('main',[]);
        }
        $this->render('admin',[]);
    }

    /**
     * Post method
     * @param $request
     */
    public function post($request){
        // Récupération de l'utilisateur
    }
}
?>