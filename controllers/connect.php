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
        $username = $request['username'];
        $password = $request['password'];

        try{
            $request_PDO = new request_PDO();
            $result = $request_PDO->connect($username, $password);
            if($result){
                $_SESSION['username'] = $username;
                $this->render('main',[]);
                //connexion admin
                if($username == "admin@admin"){
                    $this->render('admin',[]);
                }
            }else{
                echo "Bad credentials";
                $this->render('main',[]);
            }
        
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
