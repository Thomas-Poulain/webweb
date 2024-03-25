<?php

require(__ROOT__.'/controllers/Controller.php');

class SaTestController extends Controller{

    public function get($request){
        if($_SESSION['role'] != 1){
            $this->render('sa_error',['message' => "Vous n'avez pas de permission d'entrer dans cette page"]);
        }else{
            $this->render('sa_test',[]);
        }
    }

}

?>            		
