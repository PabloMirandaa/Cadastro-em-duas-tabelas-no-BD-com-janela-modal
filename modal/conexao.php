<?php 
$host = "localhost";
$dbname = "modal";
$user = "root";
$pass = "";



try {
    $conn = new PDO("mysql:host=$host; dbname=" . $dbname, $user, $pass);
    //echo "deu certo";
} catch (PDOException $err) {
    //echo "deu errado" . $err->getMessage();
}
?>