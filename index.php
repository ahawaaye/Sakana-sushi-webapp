<?php
// === DATABASE CONNECTION ===
$host = 'db';
$db = 'mydatabase';
$user = 'user';
$pass = 'password';
$charset = 'utf8mb4';


$dsn ="mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false, 

];



try {
    $connect = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// === FETCH FOOD DATA ===
$stmt = $connect->query("SELECT * FROM food");
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sakana Sushi</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php include 'includes/header.php'?>
<div class="container-for-width">

    <section class="hero">
        <img src="images/sushi-platter.png" alt="Sushi platter">
    </section>

    <section class="menu">
        <div class="menu-content">
            <h2>MENU'S <span>Sakana Sushi</span></h2>
            <p>メニュー</p>
            <p>Ontdek de diverse menu’s van SUMO Nijmegen. Van sushi tot grillgerechten, er is voor elk wat wils!</p>
            <div class="menu-buttons">
                <button>nigiri</button>
                <button>gunkan</button>
                <button>maki</button>
                <button>sashimi</button>
                <button>temaki</button>
                <button>rice and noodles</button>
            </div>
        </div>
    </section>

    <main>
        <h1>Nigiri</h1>
        <div class="food-menu">
            <?php foreach ($items as $item): ?>
                <div class="food-item">
                    <h2><?= htmlspecialchars($item['title']) ?></h2>
                    <p><?= htmlspecialchars($item['description']) ?></p>
                    <img src="images/<?= htmlspecialchars($item['image_name']) ?>.png" alt="<?= htmlspecialchars($item['title']) ?>">
                    <button>&euro; <?= number_format($item['price'], 2) ?> +</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

