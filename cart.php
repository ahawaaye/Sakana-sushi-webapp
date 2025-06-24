<?php
require 'includes/db.php';

$session_id = session_id();

$stmt = $connect->prepare("
    SELECT c.quantity, f.title, f.price, f.image_name
    FROM cart_items c
    JOIN food f ON c.food_id = f.id
    WHERE c.session_id = ?
");
$stmt->execute([$session_id]);
$cart_items = $stmt->fetchAll();
?>

<h2>Jouw Winkelwagen</h2>
<?php if ($cart_items): ?>
    <ul>
        <?php foreach ($cart_items as $item): ?>
            <li>
                <?= htmlspecialchars($item['title']) ?> - <?= $item['quantity'] ?> x € <?= number_format($item['price'], 2) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Je winkelwagen is leeg.</p>
<?php endif; ?>
