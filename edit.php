<?php
require 'includes/db.php';

$success = '';
$error = '';

if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET['id'];

// Haal het gerecht op
$stmt = $connect->prepare("SELECT * FROM food WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    $error = "Item niet gevonden!";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image_name = $_POST["image_name"];

    try {
        $stmt = $connect->prepare("UPDATE food SET title = ?, description = ?, price = ?, image_name = ? WHERE id = ?");
        $stmt->execute([$title, $description, $price, $image_name, $id]);
        $success = "Gerecht succesvol bijgewerkt!";
    } catch (PDOException $e) {
        $error = "Fout bij bijwerken: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Wijzig Gerecht</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="edit-page">
    <div class="edit-container">
        <h1 class="edit-title">Wijzig gerecht</h1>

        <?php if ($success): ?>
            <p class="edit-success"><?= $success ?></p>
        <?php elseif ($error): ?>
            <p class="edit-error"><?= $error ?></p>
        <?php endif; ?>

        <form method="post" class="edit-form">
            <label class="edit-label" for="title">Titel</label>
            <input class="edit-input" type="text" name="title" id="title" value="<?= htmlspecialchars($item['title']) ?>" required>

            <label class="edit-label" for="description">Beschrijving</label>
            <input class="edit-input" type="text" name="description" id="description" value="<?= htmlspecialchars($item['description']) ?>" required>

            <label class="edit-label" for="price">Prijs (€)</label>
            <input class="edit-input" type="number" step="0.01" name="price" id="price" value="<?= htmlspecialchars($item['price']) ?>" required>

            <label class="edit-label" for="image_name">Afbeeldingsnaam</label>
            <input class="edit-input" type="text" name="image_name" id="image_name" value="<?= htmlspecialchars($item['image_name']) ?>" required>

            <button class="edit-button" type="submit">Opslaan</button>
        </form>

        <a class="edit-back" href="dashboard.php">← Terug naar Dashboard</a>
    </div>
</body>
</html>




