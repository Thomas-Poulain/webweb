<?php
require_once(__ROOT__.'/controllers/Controller.php');

class ConnectController extends Controller{

    /**
     * Get the page to connect
     */
    public function get($request){
        $this->render('/main',[]);
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
            echo $username;
            $result = $request_PDO->connect($username, $password);
            if($result){
                $_SESSION['username'] = $username;
            }else{
                echo "Bad credentials";
            }
            $this->render('/main',[]);
            
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
