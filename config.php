<?php
$host = 'localhost';
$dbname = 'api_scolaire';
$user = 'root'; // Remplace par ton utilisateur MySQL
$pass = ''; // Remplace par ton mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>