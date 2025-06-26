<?php
// === DATABASE CONNECTION ===
$host = 'db';
$db = 'mydatabase';
$user = 'user';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $connect = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// === FETCH FOOD DATA WITH SEARCH ===
$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $stmt = $connect->prepare("SELECT * FROM food WHERE title LIKE ? OR description LIKE ? ORDER BY id DESC");
    $stmt->execute(["%$search%", "%$search%"]);
} else {
    $stmt = $connect->query("SELECT * FROM food ORDER BY id DESC");
}
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Sakana Sushi</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container-for-width">

        <!-- Hero Section -->
        <section class="hero-section">
            <img src="images/pngtree-sushi-plate-gourmet-lunch-png-image_11648836.png" alt="Sushi platter" class="hero-image">
        </section>

        <!-- Menu Section -->
        <section class="menu-section">
            <div class="menu-box">
                <h2 class="menu-title">MENU'S <span>Sakana Sushi</span></h2>
                <p class="menu-japanese">メニュー</p>
                <p class="menu-description">Ontdek de diverse menu’s van SUMO Nijmegen. Van sushi tot grillgerechten, er is voor elk wat wils!</p>
                <div class="menu-buttons">
                    <button class="menu-button">nigiri</button>
                    <button class="menu-button">gunkan</button>
                    <button class="menu-button">maki</button>
                    <button class="menu-button">sashimi</button>
                    <button class="menu-button">temaki</button>
                    <button class="menu-button">rice and noodles</button>
                </div>
            </div>
        </section>

        <!-- Search Form -->
        <section class="search-section">
            <form method="get" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Zoek een gerecht..." value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit" class="search-button">Zoeken</button>
            </form>
        </section>

        <!-- Food Menu Display -->
        <main class="main-menu">
            <h1 class="menu-heading">Nigiri</h1>
            <div class="food-grid">
                <?php if (count($items) === 0): ?>
                    <p class="no-items">Geen gerechten gevonden.</p>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                        <div class="food-card">
                            <h2 class="food-title"><?= htmlspecialchars($item['title']) ?></h2>
                            <p class="food-description"><?= htmlspecialchars($item['description']) ?></p>
                            <img src="images/<?= htmlspecialchars($item['image_name']) ?>.png" alt="<?= htmlspecialchars($item['title']) ?>" class="food-image">
                            <button class="price-button">&euro; <?= number_format($item['price'], 2) ?> +</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
