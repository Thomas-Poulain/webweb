<?php
require(__ROOT__.'/controllers/Controller.php');

class SaConfirmController extends Controller{

    /**
     * Get confirmation page
     * @param $request
     */
    public function get($request){
        if($_SESSION['role'] != 1){
            $this->render('/',[]);
        }else{
            $this->render('sa_confirm',[]);
        }
        $this->render('sa_userCreate',[]);
    }
}

?>
