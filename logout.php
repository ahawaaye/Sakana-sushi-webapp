<?php
require 'includes/db.php';
session_start();
session_unset(); 
session_destroy(); 

header("Location: /inlog.php"); // <-- gebruik absoluut pad als test
exit;
?>
