<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Contact - Sakana Sushi</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

<main class="contact-main">
  <div class="contact-box">
    <h2>Neem contact op</h2>
    <p>Heb je vragen of opmerkingen? Vul het onderstaande formulier in en we nemen zo snel mogelijk contact met je op.</p>

    <form action="contact.php" method="post">
      <label for="name">Naam</label>
      <input type="text" id="name" name="name" required>

      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Bericht</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Verstuur</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<p style='color: green; margin-top: 20px;'>Bedankt voor je bericht, " . htmlspecialchars($_POST['name']) . "!</p>";
    }
    ?>
  </div>
</main>

</body>
</html>
