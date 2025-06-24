<?php
require 'includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Geen ID opgegeven.";
    exit;
}

// Ophalen gerecht
$stmt = $connect->prepare("SELECT * FROM food WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    echo "Gerecht niet gevonden.";
    exit;
}

// Als er is gepost, update uitvoeren
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image_name'];

    $update = $connect->prepare("UPDATE food SET title = ?, description = ?, price = ?, image_name = ? WHERE id = ?");
    $update->execute([$title, $description, $price, $image, $id]);

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="edit-page">

    <h1 class="edit-title">Wijzig gerecht</h1>

    <form method="post" class="edit-form">
        <div class="form-group">
            <label for="title">Titel</label>
            <input type="text" id="title" name="title" class="form-input" value="<?= htmlspecialchars($item['title']) ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Beschrijving</label>
            <input type="text" id="description" name="description" class="form-input" value="<?= htmlspecialchars($item['description']) ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Prijs (€)</label>
            <input type="number" step="0.01" id="price" name="price" class="form-input" value="<?= htmlspecialchars($item['price']) ?>" required>
        </div>

        <div class="form-group">
            <label for="image_name">Afbeeldingsnaam</label>
            <input type="text" id="image_name" name="image_name" class="form-input" value="<?= htmlspecialchars($item['image_name']) ?>" required>
        </div>

        <button type="submit" class="btn-save">Opslaan</button>
    </form>

</body>
</html>
