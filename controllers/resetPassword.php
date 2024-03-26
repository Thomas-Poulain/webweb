<?php
require_once(__ROOT__.'/controllers/Controller.php');

class resetPasswordController extends Controller{

    /**
     * Get the page to reset the password
     */
    public function get($request){
        $this->render('/main',[]);
    }

    /**
     * Post the page to reset the password
     * @param $request
     */
    public function post($request){
        // Récupération de l'utilisateur
        $username = $request['username'];
        $password = $request['password'];

        try{
            $request_PDO = new request_PDO();
            $result = $request_PDO->changePassword($username, $password);
            $this->render('/main',[]);
            
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
