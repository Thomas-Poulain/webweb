<?php
require(__ROOT__.'/controllers/Controller.php');
require(__ROOT__.'/controllers/connect.php');
class MainController extends Controller{

    /**
     * Get the main page
     * @param $request
     */
    public function get($request){
        //persistant connection
        $this->render('main',[]);
    }
}
?>

