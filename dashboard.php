<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
    require 'includes/db.php';
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel – Sushi Sakura</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="admin-page">

    <h1>Admin Panel – Sushi Gerechten Beheren</h1>

    <div class="top-bar">
        <a href="add.item.php">➕ Nieuw gerecht toevoegen</a>
        <a href="index.php">🏠 Terug naar Home</a>
        <a href="logout.php">🚪 Uitloggen</a>
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
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['naam']) ?></td>
                    <td><?= htmlspecialchars($item['beschrijving']) ?></td>
                    <td><?= number_format($item['prijs'], 2) ?></td>
                    <td><?= htmlspecialchars($item['categorie']) ?></td>
                    <td>
                        <img src="images/<?= htmlspecialchars($item['afbeelding']) ?>" alt="<?= htmlspecialchars($item['naam']) ?>" width="80">
                    </td>
                    <td>
                        <a class="btn edit" href="edit.item.php?id=<?= $item['id'] ?>">✏️ Wijzig</a>
                        <a class="btn delete" href="delete.item.php?id=<?= $item['id'] ?>" onclick="return confirm('Weet je zeker dat je dit sushi-gerecht wilt verwijderen?');">🗑️ Verwijder</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>