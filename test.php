<?php

    //utilisation de php-sqlite3 (apt install php-sqlite3)
    $db = new PDO('sqlite:database.db');
    $tmp = null;

    $dernierID=$db->prepare('SELECT COUNT(*) as count FROM User');
    $dernierID->execute();
    $result=$dernierID->fetch();

    var_dump($result["count"]);
?>