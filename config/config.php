<?php
$conn = new mysqli('localhost', 'root', '', 'user_management');
if ($conn->connect_error) {
die('Database connection failed');
}
session_start();
?>