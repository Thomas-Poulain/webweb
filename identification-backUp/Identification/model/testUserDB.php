<?php

require_once(dirname(__FILE__) . '/userDB.php');


class TestUserDB {


    public function TestGetUsers(){
        $userDB = new UserDB();
        $users = $userDB->getUsers();
        if ($users != false){
            echo "TestGetUsers: OK";
        } else {
            echo "TestGetUsers: KO";
        }

    }


    public function TestCheckUserName(String $username) {
        $userDB = new UserDB();
        $user = $userDB->checkUserName($username);
        if ($user != false){
            echo "TestCheckUserName: OK";
        } else {
            echo "TestCheckUserName: KO";
        }

        
    }

    public function TestAddUser(String $firstName, String $lastName, int $role = 4){
        $userDB = new UserDB();
        $user = $userDB->addUser($firstName, $lastName, $role);
        if ($user != false){
            echo "TestAddUser: OK";
        } else {
            echo "TestAddUser: KO";
            }
        }

    public function TestAddRolesSystemMembers(String $username, String $role): void{
        global $DB;
        $userDB = new UserDB();
        $userDB->addRolesSystemMembers($username, $role);
        $user = $userDB->getRecord($username);
        $roles =$DB->get_record('role_assignments', array('userid' => $user->id));
        if ($roles->roleid == $role){
            echo "TestAddRolesSystemMembers: OK";
        } else {
            echo "TestAddRolesSystemMembers: KO";
        }
    }
    
    public function TestGetUser_role(string $username) {
        $userDB = new UserDB();
        $role = $userDB->getUser_role($username);
        if ($role != false){
            echo "TestGetUser_role: OK";
        } else {
            echo "TestGetUser_role: KO";
        }
    }

    public function TestGetGroupOfUser(String $username) {
        $userDB = new UserDB();
        $group = $userDB->getGroupOfUser($username);
        if ($group != false){
            echo "TestGetGroupOfUser: OK";
        } else {
            echo "TestGetGroupOfUser: KO";
        }
    }


    public function TestDeleteUser(String $username): void{
        $userDB = new UserDB();
        $userDB->deleteUser($username);
        $user = $userDB->getRecord($username);
        if ($user == false){
            echo "TestDeleteUser: OK";
        } else {
            echo "TestDeleteUser: KO";
        }
    }

    public function TestUpdateUser(String $username, String $firstName, String $lastName, bool $password) {
        $userDB = new UserDB();
        $userDB->updateUser($username, $firstName, $lastName, $password);
        $user = $userDB->getRecord($username);
        if ($user->firstname == $firstName && $user->lastname == $lastName){
            echo "TestUpdateUser: OK";
        } else {
            echo "TestUpdateUser: KO";
        }
    }


}


$test = new TestUserDB();


// Test de la méthode TestGetUsers
if ($test->TestGetUsers() == "OK") {
    echo "TestGetUsers: OK\n";
} else {
    echo "TestGetUsers: KO\n";
}

// Test de la méthode TestCheckUserName avec un nom d'utilisateur valide
if ($test->TestCheckUserName("testuser") == "OK") {
    echo "TestCheckUserName: OK\n";
} else {
    echo "TestCheckUserName: KO\n";
}

// Test de la méthode TestAddUser avec des valeurs valides pour le prénom, le nom et le rôle
if ($test->TestAddUser("John", "Doe", 4) == "OK") {
    echo "TestAddUser: OK\n";
} else {
    echo "TestAddUser: KO\n";
}

// Test de la méthode TestAddRolesSystemMembers avec un nom d'utilisateur valide et un rôle valide
if ($test->TestAddRolesSystemMembers("testuser", "student") == "OK") {
    echo "TestAddRolesSystemMembers: OK\n";
} else {
    echo "TestAddRolesSystemMembers: KO\n";
}

// Test de la méthode TestGetUser_role avec un nom d'utilisateur valide
if ($test->TestGetUser_role("testuser") == "OK") {
    echo "TestGetUser_role: OK\n";
} else {
    echo "TestGetUser_role: KO\n";
}

// Test de la méthode TestGetGroupOfUser avec un nom d'utilisateur valide
if ($test->TestGetGroupOfUser("testuser") == "OK") {
    echo "TestGetGroupOfUser: OK\n";
} else {
    echo "TestGetGroupOfUser: KO\n";
}

// Test de la méthode TestDeleteUser avec un nom d'utilisateur valide
if ($test->TestDeleteUser("testuser") == "OK") {
    echo "TestDeleteUser: OK\n";
} else {
    echo "TestDeleteUser: KO\n";
}

// Test de la méthode TestUpdateUser avec un nom d'utilisateur valide et des valeurs valides pour le prénom, le nom et le mot de passe
if ($test->TestUpdateUser("testuser", "Jane", "Doe", true) == "OK") {
    echo "TestUpdateUser: OK\n";
} else {
    echo "TestUpdateUser: KO\n";
}
?>
