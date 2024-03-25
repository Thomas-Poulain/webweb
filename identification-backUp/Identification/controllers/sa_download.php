<?php
require(__ROOT__.'/controllers/Controller.php');

class SaDownloadController extends Controller{

    /**
     * Get download page
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
