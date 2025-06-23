<?php
session_start();
require 'db.php';

$error = '';

try {
    $connect = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
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
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sakana Sushi - Login</title>
</head>
<body>
    <header>
    <div class="nav-container">
        <img src="logo.png" alt="Sushi Logo" class="logo">
        <nav>
            <a href="index.php">home</a>
            <a href="contact.php">contact</a>
            <a href="about.php">about us</a>
        </nav>
    </div>
</header>

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
