<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require(__ROOT__.'/controllers/Controller.php');
class AboutController extends Controller{

    /**
     * Get method
     * @param $request
     */
    public function get($request){
        //persistant connection
        $this->render('about',[]);
    }

    /**
     * Post method
     * @param $request
     */
    public function post($request){}
}
?>