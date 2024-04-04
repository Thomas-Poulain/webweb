<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require(__ROOT__.'/controllers/Controller.php');

class CreateUserController extends Controller{

    /**
     * Get method
     * @param $request
     */
    public function get($request){
        $this->render('main',[]);                                                                      
    }

    /**
     * Post method
     * @param $request
     */
    public function post($request){
        // Récupération de l'utilisateur
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        $username = $request['email'];
        $password = $request['password'];
        $confirm_password = $request['confirm_password'];

        if($password != $confirm_password){
            echo "Passwords are not the same";
            return;
        }

        try{
            $request_PDO = new request_PDO();
            $request_PDO->addUser($firstname, $lastname, $username, $password);
            $_SESSION['username'] = $username;
            $this->render('main',[]);
            echo "User created";
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>