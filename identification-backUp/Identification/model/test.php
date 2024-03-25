<?php

require_once 'TestUserDB.php';

$test = new TestUserDB();

// Test de la méthode TestGetRecord avec un nom d'utilisateur valide
if ($test->TestGetRecord("testuser") == "OK") {
    echo "TestGetRecord: OK\n";
} else {
    echo "TestGetRecord: KO\n";
}

// Test de la méthode TestGetUserById avec un ID utilisateur valide
if ($test->TestGetUserById(1) == "OK") {
    echo "TestGetUserById: OK\n";
} else {
    echo "TestGetUserById: KO\n";
}

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
