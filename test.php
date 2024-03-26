<?php

//utilisation de php-sqlite3 (apt install php-sqlite3)
$db = new PDO('sqlite:database.db');

//requête de connexion
$username = "test@test.com";
$password = "nbtmg";
$connect = $db->prepare('SELECT Password FROM User WHERE email=?');
$connect->bindParam(1,$username);

$connect->execute();

/*foreach ($db->query($connect) as $row) {
    print_r($row);
}*/

//requête d'ajout d'utilisateur
$firstName="TEST";
$lastName="TEST";
$email = "n@n.com";
$password="nbtmg";
$hash=password_hash($password, PASSWORD_DEFAULT);
$add = "INSERT INTO User(FirstName,LastName,email,Password) VALUES (?,?,?,?)";
$add = $db->prepare($add);
//$add->execute([$firstName,$lastName,$email,$hash]);

//requête de changement de mot de passe
$id="0";
$password="coucou";
$hash=password_hash($password, PASSWORD_DEFAULT);
$changePasswd = "UPDATE User SET Password=? WHERE UserID=?";
$changePasswd = $db->prepare($changePasswd);
$changePasswd->execute([$hash,$id]);

while($row = $changePasswd->fetch()){
    var_dump($row);
}

?>