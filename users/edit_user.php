<?php
include '../config/config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../dashboard.php");
    exit;
}

/* Fetch existing user */
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    header("Location: ../dashboard.php");
    exit;
}

/* Update user */
if (isset($_POST['update'])) {
    $stmt = $conn->prepare("
        UPDATE users SET
            alias = ?,
            first_name = ?,
            last_name = ?,
            email = ?,
            phone = ?,
            address = ?,
            city = ?,
            country = ?
        WHERE id = ?
    ");

    $stmt->bind_param(
        "ssssssssi",
        $_POST['alias'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['city'],
        $_POST['country'],
        $id
    );

    $stmt->execute();
    header("Location: ../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <div class="card" style="padding: 18px; max-width: 760px; margin: 0 auto;">
        <h2 class="page-title">Edit User</h2>
        <p class="subtle">Update the user details below.</p>

        <form method="POST" class="form">
            <input class="input" name="alias" value="<?= htmlspecialchars($user['alias']) ?>" placeholder="Alias">
            <input class="input" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" placeholder="First Name">
            <input class="input" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" placeholder="Last Name">
            <input class="input" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email">
            <input class="input" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Phone">
            <input class="input" name="address" value="<?= htmlspecialchars($user['address']) ?>" placeholder="Address">
            <input class="input" name="city" value="<?= htmlspecialchars($user['city']) ?>" placeholder="City">
            <input class="input" name="country" value="<?= htmlspecialchars($user['country']) ?>" placeholder="Country">

            <button class="btn btn-primary" name="update">Update User</button>
        </form>

        <div style="margin-top: 12px;">
            <a class="link" href="../dashboard.php">⬅ Back to Dashboard</a>
        </div>
    </div>
</div>
<script src="../assets/js/main.js"></script>

</body>
</html>
