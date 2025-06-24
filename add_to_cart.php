<?php
session_start();
require 'includes/db.php';

// Verwijder item als 'remove' is meegegeven
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $removeId = (int) $_GET['remove'];
    $stmt = $connect->prepare("DELETE FROM cart_items WHERE food_id = ? AND session_id = ?");
    $stmt->execute([$removeId, session_id()]);
    header("Location: add_to_cart.php");
    exit;
}

// Haal alle items uit de winkelwagen
$stmt = $connect->prepare("
    SELECT food.title, food.image_name, food.price, cart_items.quantity, cart_items.food_id
    FROM cart_items
    JOIN food ON cart_items.food_id = food.id
    WHERE cart_items.session_id = ?
");
$stmt->execute([session_id()]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen – Sakana Sushi</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="cart-container">
        <h1>🛒 Jouw Winkelwagen</h1>

        <?php if (count($cartItems) === 0): ?>
            <p>Je winkelwagen is leeg.</p>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Gerecht</th>
                        <th>Afbeelding</th>
                        <th>Prijs</th>
                        <th>Aantal</th>
                        <th>Totaal</th>
                        <th>Actie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $grandTotal = 0;
                    foreach ($cartItems as $item): 
                        $itemTotal = $item['price'] * $item['quantity'];
                        $grandTotal += $itemTotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($item['title']) ?></td>
                        <td><img src="images/<?= htmlspecialchars($item['image_name']) ?>.png" alt="" width="60"></td>
                        <td>€<?= number_format($item['price'], 2) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>€<?= number_format($itemTotal, 2) ?></td>
                        <td>
                            <a class="remove-btn" href="add_to_cart.php?remove=<?= $item['food_id'] ?>" onclick="return confirm('Weet je zeker dat je dit wilt verwijderen?')">🗑️ Verwijder</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total-box">
                <strong>Totaalbedrag: €<?= number_format($grandTotal, 2) ?></strong>
            </div>
        <?php endif; ?>
        <a href="index.php">← Verder winkelen</a>
    </div>
</body>
</html>

