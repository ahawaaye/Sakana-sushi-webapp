<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
