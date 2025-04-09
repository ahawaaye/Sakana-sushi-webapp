<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "your_database_name");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all sushi items
$sql = "SELECT * FROM food";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sushi Menu</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Sushi Menu</h1>
  <div class="menu-container">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="menu-item">
        <img src="images/<?php echo $row['image_name']; ?>.jpg" alt="<?php echo $row['title']; ?>">
        <h2><?php echo $row['title']; ?></h2>
        <p><?php echo $row['description']; ?></p>
        <strong>€<?php echo number_format($row['price'], 2); ?></strong>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
