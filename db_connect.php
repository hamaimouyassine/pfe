<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "clubs";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}
?>