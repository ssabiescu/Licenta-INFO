<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "smiletrack";

// Creeaza conexiunea
$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexiunea
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>
