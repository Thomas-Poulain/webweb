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
        try{
            // Récupération de l'utilisateur
            $username = $request['username'];
            $password = $request['password'];

            try{
                $db = new PDO('sqlite:base.db');
                $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();
                
                // Traiter les résultats de la requête ici
                while ($row = $stmt->fetch()) {
                    // Faire quelque chose avec les résultats
                }
                
            } catch(PDOException $e){
                echo $e->getMessage();
            }
        } catch(Exception $e) {
            echo 'Une erreur s\'est produite : '.$e->getMessage();
        }
    }
}
?>
