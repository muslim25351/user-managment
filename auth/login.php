<?php
require_once '../config/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="auth-container">
    <div class="card auth-card">
        <h2 class="page-title">Admin Login</h2>
        <p class="subtle">Sign in to manage users.</p>

        <form method="POST" class="form">
            <input class="input" type="text" name="username" placeholder="Username" required>
            <input class="input" type="password" name="password" placeholder="Password" required>

            <button class="btn btn-primary" type="submit" name="login">Login</button>
        </form>

<?php
if (isset($_POST['login'])) {

    $u = $_POST['username'];
    $p = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $u);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $row = $res->fetch_assoc();

        // Support both legacy plaintext and modern password_hash().
        $stored = $row['password'] ?? '';
        $isValid = ($p === $stored) || (is_string($stored) && password_verify($p, $stored));

        if ($isValid) {
            $_SESSION['admin'] = $row['id'];
            // Use a relative redirect so this works whether the project is hosted at
            // http://localhost/ or http://localhost/<folder>/.
            header("Location: ../dashboard.php");
            exit;

        }
    }

    echo "<div class='alert alert-danger'>Invalid login</div>";
}
?>

    </div>
</div>

</body>
</html>
