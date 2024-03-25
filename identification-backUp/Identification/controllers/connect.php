<?php
require_once(__ROOT__.'/controllers/Controller.php');


class ConnectController extends Controller{

	/**
	 * Get the page to connect
	 */
	public function get($request){
		$this-> render('/main',[]);
	}

	/**
	 * Redirect to the right page according to the role
	 * @param $role
	 */	
	public function connection($role){
		switch ($role){  
			case 'admin':
				$this-> render('/',[]);
				break;
			case 'user':
		}
	}

	/**
	 * connect the user
	 * @param $request
	 */
    public function post($request){
        try{
			//recuperation de l'utilisateur
			$userdb = new UserDB();
			$user = $userdb->getRecord($request['username']);
			$username = $request['username'];
			$password = $request['password'];

			//vérification de l'existance de l'utilisateur
			if($user != false){
				if ($username == "moodleuser") {
					role_assign(1, $user->id, context_system::instance());
					if ($userdb->getRecord("g1") == null) {
						$userdb->basicUser();
					}
				}
				//vérification du mot de passe
				if(password_verify($password, $user->password)){
					$role = $userdb->getUser_role($request['username']);
					
					//définition des variables de session
					$_SESSION['role'] = $role;
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					$uc = new UsersConnected();
					$uc->newConnection($request['username'], $role, session_id());
					$this->connection($role);

				}else{
					$this-> render('/sa_error',["message" => "Mot de passe incorrect"]);
					
				}
			}
			else{
				$this-> render('/sa_error',["message" => "Utilisateur inconnu"]);
			}			
        }catch (Error $e){
            $this->render('/sa_error',["message" => "Erreur de connexion"]);
	    $this-> render('/error',['surname' => 'Error', 'password' => 'Error', 'idprof' => null]);
        }
    }
}
?>
