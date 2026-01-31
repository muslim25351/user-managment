<?php
include 'config/config.php';
if (!isset($_SESSION['admin'])) {
	header('Location: auth/login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
	<div class="topbar">
		<div>
			<h1 class="page-title" style="margin-bottom: 6px;">User Management</h1>
			<p class="subtle" style="margin: 0;">Manage users and admin settings.</p>
		</div>
		<div class="nav">
			<a class="btn btn-primary" href="users/add_user.php">Add User</a>
			<a class="btn btn-secondary" href="auth/change_password.php">Change Password</a>
			<a class="btn btn-danger" href="auth/logout.php">Logout</a>
		</div>
	</div>

	<div class="card table-card">
		<table>
		<tr>
		<th>Alias</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th>
		</tr>
<?php
$res = $conn->query("SELECT * FROM users");
while ($u = $res->fetch_assoc()) {
echo "<tr>
<td>{$u['alias']}</td>
<td>{$u['first_name']} {$u['last_name']}</td>
<td>{$u['email']}</td>
<td>{$u['phone']}</td>
<td class='row-actions'>
<a class='link' href='users/edit_user.php?id={$u['id']}'>Edit</a>
<a class='link' href='users/delete_user.php?id={$u['id']}'>Delete</a>
</td>
</tr>";
}
?>
		</table>
	</div>
</div>
<script src="assets/js/main.js"></script>

</body>
</html>