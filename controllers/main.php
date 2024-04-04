<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require(__ROOT__.'/controllers/Controller.php');
require(__ROOT__.'/controllers/connect.php');
class MainController extends Controller{

    /**
     * Get the main page
     * @param $request
     */
    public function get($request){
        //persistant connection
        header('Location: /');
    }

    /**
     * Post the main page
     * @param $request
     */
    public function post($request){}
}
?>

