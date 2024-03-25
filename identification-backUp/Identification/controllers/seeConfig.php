<?php
require(__ROOT__.'/controllers/Controller.php');

class SeeConfigController extends Controller{

    /**
     * Get the config page
     * @param $request
     */
    public function get($request){
        $this->render('seeconfig',[]);
    }
}

?>
