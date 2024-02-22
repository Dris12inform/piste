<?php
// Connect to MySQL database
$host = 'localhost';
$user = 'pisteinnovation';
$pass = 'Agadir@2020';
$db = 'pisteinnovation_irrigation';

$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
