<?php
require 'includes/db.php'; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $connect->prepare("DELETE FROM food WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: dashboard.php");
exit;
?>
