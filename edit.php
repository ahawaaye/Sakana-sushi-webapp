<?php
require 'includes/db.php';
$pdo = new PDO("mysql:host=mysql_db;dbname=mydatabase", "root", "rootpassword");


if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM menu_items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    echo "Item niet gevonden!";
    exit;
}

// UPDATE na submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $naam = $_POST["naam"];
    $beschrijving = $_POST["beschrijving"];
    $prijs = $_POST["prijs"];
    $afbeelding = $_POST["afbeelding"];
    $categorie = $_POST["categorie"];

    $stmt = $pdo->prepare("UPDATE menu_items SET naam=?, beschrijving=?, prijs=?, afbeelding=?, categorie=? WHERE id=?");
    $stmt->execute([$naam, $beschrijving, $prijs, $afbeelding, $categorie, $id]);

    header("Location: admin.php");
    exit;
}
?>
