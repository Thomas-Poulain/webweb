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
            $db = new PDO('sqlite:base.db');
            $stmt = $db->prepare('SELECT password FROM users WHERE username = :username');
            $stmt->bindParam(':username', $username);
            $result = $stmt->execute();

            var_dump($result);
            password_verify($password, $result['password']);
            
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
