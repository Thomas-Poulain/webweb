<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
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
        $email = $request['email'];
        $password = $request['password'];
        $confirm_password = $request['confirm_password'];

        if($password != $confirm_password){
            echo "Les mots de passe ne correspondent pas";

        }else{
            try{
                $request_PDO = new request_PDO();
                $result = $request_PDO->changePassword($email, $password);
                $this->render('/main',[]);
                
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
}
?>
