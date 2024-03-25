<?php

use PHPUnit\Framework\TestCase;

require_once '/var/www/html/model/UserDB.php';

class UserDBTest extends TestCase
{
    protected static $userDB;

    public static function setUpBeforeClass(): void
    {
        // Crée une instance de UserDB
        self::$userDB = new UserDB();

        // Ajoute un utilisateur à la base de données pour les tests
        self::$userDB->addUser('John', 'Doe', 2);
    }

    public static function tearDownAfterClass(): void
    {
        // Supprime l'utilisateur ajouté pour les tests
        self::$userDB->deleteUser('johndoe');

        // Supprime les rôles, les groupes et les autres données ajoutées pour les tests
        // ...
    }


    public function testGetUsers()
    {
        // Crée une instance de UserDB
        $userDB = new UserDB();

        // Appelle la méthode getUsers
        $users = $userDB->getUsers();

        // Vérifie que la méthode retourne un tableau
        $this->assertIsArray($users);

        // Vérifie que le tableau contient des éléments
        $this->assertNotEmpty($users);

        // Vérifie que chaque élément du tableau est un objet
        foreach ($users as $user) {
            $this->assertIsObject($user);
        }
    }

    public function testAddRolesSystemMembers()
    {
        // Ajoute un rôle système à l'utilisateur créé pour les tests
        self::$userDB->addRolesSystemMembers('johndoe', 'teacher');

        // Récupère le rôle de l'utilisateur
        $role = self::$userDB->getUser_role('johndoe');

        // Vérifie que l'utilisateur a bien le rôle système ajouté
        $this->assertEquals('teacher', $role);
    }

    public function testGetGroupOfUser()
    {
        // Ajoute un utilisateur à un groupe pour les tests
        $groupsDB = new GroupsDB();
        $groupsDB->addMember('testgroup', 'johndoe');

        // Récupère le groupe de l'utilisateur
        $groupName = self::$userDB->getGroupOfUser('johndoe');

        // Vérifie que l'utilisateur appartient bien au groupe ajouté
        $this->assertEquals('testgroup', $groupName);
    }

    public function testDeleteUser()
    {
        // Ajoute un deuxième utilisateur à la base de données pour les tests
        self::$userDB->addUser('Jane', 'Doe', 3);

        // Supprime l'utilisateur ajouté pour les tests
        self::$userDB->deleteUser('janedoe');

        // Vérifie que l'utilisateur a bien été supprimé de la base de données
        $this->assertNull(self::$userDB->getRecord('janedoe'));
    }

    public function testUpdateUser()
    {
        // Met à jour les informations de l'utilisateur créé pour les tests
        $result = self::$userDB->updateUser('johndoe', 'John', 'Smith', false);

        // Vérifie que les informations de l'utilisateur ont été mises à jour
        $this->assertEquals(array('teacher', 'johndoe', 'John', 'Smith', 'password'), $result);
    }

    public function testGetRecord()
    {
        // Récupère l'utilisateur ajouté pour les tests
        $user = self::$userDB->getRecord('johndoe');

        // Vérifie que l'utilisateur a bien été récupéré de la base de données
        $this->assertEquals('John', $user->firstname);
        $this->assertEquals('Doe', $user->lastname);
    }

    public function testGetUserById()
    {
        // Récupère l'utilisateur ajouté pour les tests
        $user = self::$userDB->getRecord('johndoe');

        // Récupère l'utilisateur par son identifiant
        $userById = self::$userDB->getUserById($user->id);

        // Vérifie que les informations de l'utilisateur sont les mêmes
        $this->assertEquals($user->username, $userById->username);
    }

    public function testCheckUserName()
    {
        // Vérifie que le nom d'utilisateur est unique
        $username = self::$userDB->checkUserName('johndoe');
        $this->assertNotEquals('johndoe', $username);
    }

    public function testAddUser()
    {
        // Ajoute un utilisateur à la base de données pour les tests
        $result = self::$userDB->addUser('Jane', 'Doe', 3);

        // Vérifie que l'utilisateur a bien été ajouté à la base de données
        $this->assertEquals('janedoe', $result[0]);
        $this->assertEquals('password', $result[1]);
        $this->assertEquals(3, $result[2]);

        // Récupère l'utilisateur ajouté pour les tests
        $user = self::$userDB->getRecord('janedoe');

        // Vérifie que les informations de l'utilisateur sont correctes
        $this->assertEquals('Jane', $user->firstname);
        $this->assertEquals('Doe', $user->lastname);
        $this->assertEquals('janedoe', $user->username);
    }



}
?>