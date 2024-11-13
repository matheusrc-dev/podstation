<?php
$servername = "10.90.43.198";
$username = "crud_user";
$password = "abc123";
$dbname = "crud_db";

// Conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar Conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
