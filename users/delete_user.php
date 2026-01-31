<?php
include '../config/config.php';

if (!isset($_SESSION['admin'])) {
	header('Location: ../auth/login.php');
	exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
	header('Location: ../dashboard.php');
	exit;
}

$stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

header('Location: ../dashboard.php');
exit;
?>