<?php
require 'includes/db.php';



$stmt = $connect->query("SELECT * FROM food");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel – Sakana Sushi</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body class="admin-page">
    <h1>Admin Panel – Gerechten beheren</h1>

    <div class="top-bar">
        <a class="btn add" href="create.php"> Nieuw gerecht toevoegen</a>
        <a class="btn home" href="index.php"> Terug naar Home</a>
        <a class="btn logout" href="logout.php"> Uitloggen</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Beschrijving</th>
                <th>Prijs (€)</th>
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
                        <td>€<?= number_format($item['price'], 2) ?></td>
                        <td><img src="images/<?= htmlspecialchars($item['image_name']) ?>.png" width="70" alt=""></td>
                        <td>
                            <a class="btn edit" href="edit.php?id=<?= $item['id'] ?>">✏️ Wijzig</a>
                            <a class="btn delete" href="delete.php?id=<?= $item['id'] ?>" onclick="return confirm('Weet je zeker dat je dit gerecht wilt verwijderen?')">🗑️ Verwijder</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Geen gerechten gevonden.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
