<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'ifsm_stage'; // Nom de votre base de données
$username = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL (vide par défaut sur XAMPP)

try {
    // Connexion à la base de données avec PDO
    $bd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (Exception $e) {
    // Gestion de l'exception
    echo 'Exception capturée : ',  $e->getMessage(), "\n";
}
