<?php
$host = 'localhost';
$user = 'root'; // Default MySQL username
$password = ''; // Default MySQL password for XAMPP/WAMP
$dbname = 'todo_app';

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
