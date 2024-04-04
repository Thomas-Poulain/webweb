<?php
/**
* Jamet Titouan
* Poulain Thomas
* Hyeans Matthieu
* Testé sur Firefox
*/
require_once(__ROOT__.'/controllers/Controller.php');

class ConnectController extends Controller{

    /**
     * Get the page to connect
     */
    public function get($request){
        header('Location: /main');
    }

    /**
     * Connect the user
     * @param $request
     */
    public function post($request){
        // Récupération de l'utilisateur
        $username = $request['username'];
        $password = $request['password'];

        try{
            $request_PDO = new request_PDO();
            $result = $request_PDO->connect($username, $password);
            if($result){
                $_SESSION['username'] = $username;
            }else{
                echo "Bad credentials";
            }
            header('Location: /main');
            
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
