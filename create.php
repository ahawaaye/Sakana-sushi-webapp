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
        $stmt = $connect->prepare("INSERT INTO food (title, description, price, image_name, featured, active) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $price, $image_name, 0, 1]); 

        $success = "Gerecht succesvol toegevoegd!";
    } catch (PDOException $e) {
        $error = "Fout bij toevoegen: " . $e->getMessage();
    }
}

$stmt = $connect->query("SELECT * FROM food ORDER BY id DESC");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuw gerecht toevoegen</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="admin-form-page">
    <div class="admin-form-container">
        <h1 class="admin-form-title">Nieuw gerecht toevoegen</h1>

        <?php if (!empty($success)): ?>
            <p class="admin-form-success"><?= $success ?></p>
        <?php elseif (!empty($error)): ?>
            <p class="admin-form-error"><?= $error ?></p>
        <?php endif; ?>

        <form method="post" class="admin-form">
            <label for="title" class="admin-label">Titel</label>
            <input type="text" name="title" id="title" class="admin-input" required>

            <label for="description" class="admin-label">Beschrijving</label>
            <input type="text" name="description" id="description" class="admin-input" required>

            <label for="price" class="admin-label">Prijs (€)</label>
            <input type="number" step="0.01" name="price" id="price" class="admin-input" required>

            <label for="image_name" class="admin-label">Afbeeldingsnaam</label>
            <input type="text" name="image_name" id="image_name" class="admin-input" required>

            <button type="submit" class="admin-submit-button">Toevoegen</button>
        </form>

        <a href="dashboard.php" class="admin-back-link">← Terug naar Dashboard</a>
    </div>
</body>
</html>
