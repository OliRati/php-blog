<?php
$host = $configdb['host'];
$db = $configdb['db'];
$user = $configdb['user'];
$pass = $configdb['pass'];
$charset = $configdb['charset'];


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $erreur) {
    echo '<h1>Erreur de connexion PDO !!!</h1> ' . $erreur->getMessage() . '<br>';
    die('Impossible de se connecter à la base de donnée !');
}
