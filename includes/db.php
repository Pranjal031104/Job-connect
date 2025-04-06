<?php
$host = 'localhost';
$user = 'root';
$password = '0703';
$database = 'jobconnect';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>