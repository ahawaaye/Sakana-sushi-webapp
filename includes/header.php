
<?
require 'includes/db.php';
?>

<header>
    <div class="container-for-width header-container">
        <div class="logo">
            <a href="index.php">
                <img src="images/sakana-logo.png" alt="Sakana Sushi Logo" height="40">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <?php if (!empty($_SESSION["loggedin"])): ?>
                    <li><a href="admin.php">ADMIN</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                <?php else: ?>
                    <li><a href="inlog.php">LOGIN</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
