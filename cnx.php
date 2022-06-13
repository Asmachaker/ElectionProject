<?php
$servername = 'localhost';
$username = 'root';
$password = '';

//On essaie de se connecter
try {
    // pour tester l'erreur on se connecte à une base inexistancte "achats"
    $db = new PDO("mysql:host=$servername;dbname=election", $username, $password);
    //On définit le mode d'erreur de PDO sur Exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

/*On capture les exceptions si une exception est lancée et on affiche les informations relatives à celle-ci*/ catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
