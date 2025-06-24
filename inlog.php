<?php

require 'includes/db.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $connect->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sakana Sushi - Login</title>
      <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php include 'includes/header.php'; ?>


<main>
    <div class="register-box">
        <form method="post">
            <label for="username">usernaam</label>
            <input type="text" id="username" name="username" required>

            <label for="password">wachtwoord</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">registreren</button>

            <?php if ($error): ?>
                <p style="color: red; margin-top: 20px;"><?= $error ?></p>
            <?php endif; ?>

            <?php if ($success): ?>
                <p style="color: green; margin-top: 20px;"><?= $success ?></p>
            <?php endif; ?>
        </form>
    </div>
</main>
</body>
</html>
