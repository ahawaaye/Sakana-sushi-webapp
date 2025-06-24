<?php
require 'includes/db.php';

try {
    // Replace 'sushi_items' with your actual table name
    $stmt = $connect->prepare("SELECT * FROM food");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel – Sushi Sakura</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<?php include 'includes/header.php'; ?>
<body class="admin-page">

    <h1>Admin Panel – Sushi Gerechten Beheren</h1>

    <div class="top-bar">
        <a class="btn" href="create.php"> Nieuw gerecht toevoegen</a>
        <a class="btn" href="index.php"> Terug naar Home</a>
        <a class="btn" href="logout.php"> Uitloggen</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Prijs (€)</th>
                <th>Categorie</th>
                <th>Afbeelding</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['title']) ?></td>
            <td><?= htmlspecialchars($item['description']) ?></td>
            <td><?= number_format($item['price'], 2) ?></td>
            <td>–</td> 
            <td>
                <img src="images/<?= htmlspecialchars($item['image_name']) ?>.png" alt="<?= htmlspecialchars($item['title']) ?>" width="80">
            </td>
            <td>
                <a class="btn edit" href="edit.php?id=<?= $item['id'] ?>">✏️ Wijzig</a>
                <a class="btn delete" href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Weet je zeker dat je dit sushi-gerecht wilt verwijderen?');"> Verwijder</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="6">Geen gerechten gevonden.</td></tr>
<?php endif; ?>


</body>
</html>
