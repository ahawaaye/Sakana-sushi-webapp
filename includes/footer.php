
<?
require 'includes/db.php';
?>


<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Sakana Sushi</h3>
            <p>Authentieke sushi met liefde bereid in Nijmegen.</p>
        </div>

        <div class="footer-section">
            <h4>Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php">Menu</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="inlog.php">Inloggen</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Contact</h4>
            <p>Email: info@sakanasushi.nl</p>
            <p>Telefoon: 024-1234567</p>
            <p>Adres: Sushiweg 8, Nijmegen</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?= date("Y") ?> Sakana Sushi. Alle rechten voorbehouden.</p>
    </div>
</footer>
