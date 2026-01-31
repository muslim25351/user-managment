<?php
include '../config/config.php';

if (!isset($_SESSION['admin'])) {
	header('Location: login.php');
	exit;
}

$message = null;
if (isset($_POST['change'])) {
	$newPassword = $_POST['new'] ?? '';
	if (trim($newPassword) === '') {
		$message = ['type' => 'danger', 'text' => 'Password cannot be empty.'];
	} else {
		$hash = password_hash($newPassword, PASSWORD_DEFAULT);
		$id = $_SESSION['admin'];

		$stmt = $conn->prepare('UPDATE admins SET password = ? WHERE id = ?');
		$stmt->bind_param('si', $hash, $id);
		$stmt->execute();

		$message = ['type' => 'success', 'text' => 'Password updated successfully.'];
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
	<div class="card" style="padding: 18px; max-width: 520px; margin: 0 auto;">
		<h2 class="page-title">Change Password</h2>
		<p class="subtle">Set a new admin password.</p>

		<form method="POST" class="form">
			<input class="input" type="password" name="new" placeholder="New Password" required>
			<button class="btn btn-primary" name="change">Change Password</button>
		</form>

		<?php
		if ($message) {
			$cls = $message['type'] === 'success' ? '' : ' alert-danger';
			echo "<div class='alert{$cls}' style='margin-top: 12px;'>{$message['text']}</div>";
		}
		?>

		<div style="margin-top: 12px;">
			<a class="link" href="../dashboard.php">⬅ Back to Dashboard</a>
		</div>
	</div>
</div>

<script src="../assets/js/main.js"></script>
</body>
</html>