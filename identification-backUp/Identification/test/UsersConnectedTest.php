<?php

define('__ROOT__', dirname(__FILE__));

use PHPUnit\Framework\TestCase;

class UsersConnectedTest extends TestCase {

    public function testNewConnection() {
        // Créer une instance de UsersConnected
        $userConnected = new UsersConnected();
        // Appeler la méthode newConnection avec des arguments valides
        $userConnected->newConnection("john", "2", "123456");
        // Vérifier que le fichier de log a été créé
        $this->assertFileExists(__ROOT__."/logs.csv");
    }

    public function testCheckAlreadyConnect() {
        // Créer une instance de UsersConnected
        $userConnected = new UsersConnected();
        // Ajouter un enregistrement dans le fichier de log
        $fileHandle = fopen(__ROOT__."/logs.csv", "a+");
        $logEntry = array(
            "jane",
            "3",
            "654321"
        );
        fputcsv($fileHandle, $logEntry);
        fclose($fileHandle);
        // Appeler la méthode checkAlreadyConnect avec un id existant
        $userConnected->checkAlreadyConnect("654321");
        // Vérifier que l'enregistrement a été supprimé du fichier de log
        $fileHandle = fopen(__ROOT__."/logs.csv", "r");
        $this->assertEquals(1, count(fgetcsv($fileHandle)));
        fclose($fileHandle);
    }

    public function testGetUserConnected() {
        // Créer une instance de UsersConnected
        $userConnected = new UsersConnected();
        // Ajouter des enregistrements dans le fichier de log
        $fileHandle = fopen(__ROOT__."/logs.csv", "a+");
        $logEntry1 = array(
            "john",
            "2",
            "123456"
        );
        $logEntry2 = array(
            "jane",
            "3",
            "654321"
        );
        fputcsv($fileHandle, $logEntry1);
        fputcsv($fileHandle, $logEntry2);
        fclose($fileHandle);
        // Appeler la méthode getUserConnected
        $result = $userConnected->getUserConnected();
        // Vérifier que la méthode retourne un tableau de taille 1
        $this->assertEquals(1, count(json_decode($result, true)));
    }

    public function testGetUserBySessionId() {
        // Créer une instance de UsersConnected
        $userConnected = new UsersConnected();
        // Ajouter un enregistrement dans le fichier de log
        $fileHandle = fopen(__ROOT__."/logs.csv", "a+");
        $logEntry = array(
            "john",
            "2",
            "123456"
        );
        fputcsv($fileHandle, $logEntry);
        fclose($fileHandle);
        // Appeler la méthode getUserBySessionId avec un id existant
        $result = $userConnected->getUserBySessionId("123456");
        // Vérifier que la méthode retourne un tableau avec les informations de l'utilisateur
        $this->assertArrayHasKey("username", $result);
        $this->assertArrayHasKey("role", $result);
        $this->assertArrayHasKey("id", $result);
        $this->assertArrayHasKey("firstname", $result);
        $this->assertArrayHasKey("lastname", $result);
    }
}


?>