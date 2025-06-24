<?php
require 'includes/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_name = $_POST['image_name'];

    try {
        $stmt = $connect->prepare("INSERT INTO food (title, description, price, image_name) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description, $price, $image_name]);
        $success = "Gerecht succesvol toegevoegd!";
    } catch (PDOException $e) {
        $error = "Fout bij toevoegen: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuw gerecht toevoegen</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="admin-form">
    <div class="form-container">
        <h1>Nieuw gerecht toevoegen</h1>

        <?php if ($success): ?>
            <p class="success-msg"><?= $success ?></p>
        <?php elseif ($error): ?>
            <p class="error-msg"><?= $error ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Beschrijving</label>
            <input type="text" name="description" id="description" required>

            <label for="price">Prijs (€)</label>
            <input type="number" step="0.01" name="price" id="price" required>

            <label for="image_name">Afbeeldingsnaam</label>
            <input type="text" name="image_name" id="image_name" required>

            <button type="submit">Toevoegen</button>
        </form>

        <a href="dashboard.php">← Terug naar Dashboard</a>
    </div>
</body>
</html>
