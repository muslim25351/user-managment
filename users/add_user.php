<?php
include '../config/config.php';

if (!isset($_SESSION['admin'])) {
	header('Location: ../auth/login.php');
	exit;
}

if (isset($_POST['save'])) {
	$stmt = $conn->prepare(
		"INSERT INTO users(alias, first_name, last_name, email, phone, address, city, country)
		 VALUES (?,?,?,?,?,?,?,?)"
	);
	$stmt->bind_param(
		"ssssssss",
		$_POST['alias'],
		$_POST['first'],
		$_POST['last'],
		$_POST['email'],
		$_POST['phone'],
		$_POST['address'],
		$_POST['city'],
		$_POST['country']
	);
	$stmt->execute();
	header('Location: ../dashboard.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
	<div class="card" style="padding: 18px; max-width: 760px; margin: 0 auto;">
		<h2 class="page-title">Add User</h2>
		<p class="subtle">Create a new user record.</p>

		<form method="POST" class="form">
			<input class="input" name="alias" placeholder="Alias">
			<input class="input" name="first" placeholder="First Name">
			<input class="input" name="last" placeholder="Last Name">
			<input class="input" name="email" placeholder="Email">
			<input class="input" name="phone" placeholder="Phone">
			<input class="input" name="address" placeholder="Address">
			<input class="input" name="city" placeholder="City">
			<input class="input" name="country" placeholder="Country">
			<button class="btn btn-primary" name="save">Save</button>
		</form>

		<div style="margin-top: 12px;">
			<a class="link" href="../dashboard.php">⬅ Back to Dashboard</a>
		</div>
	</div>
</div>
<script src="../assets/js/main.js"></script>

</body>
</html>