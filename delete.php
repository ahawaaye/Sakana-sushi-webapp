<?php
$pdo = new PDO("mysql:host=mysql_db;dbname=mydatabase", "root", "rootpassword");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: admin.php");
exit;
?>
