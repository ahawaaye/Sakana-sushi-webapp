<?php
require 'includes/db.php';

$id = $_GET['id'];
$stmt = $connect->prepare("SELECT * FROM sushi_items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($item) {
    // Insert into deleted log
    $log = $connect->prepare("INSERT INTO sushi_deleted_log 
        (original_id, naam, beschrijving, prijs, categorie, afbeelding) 
        VALUES (?, ?, ?, ?, ?, ?)");
    $log->execute([
        $item['id'],
        $item['naam'],
        $item['beschrijving'],
        $item['prijs'],
        $item['categorie'],
        $item['afbeelding']
    ]);

    // Now delete the original
    $delete = $connect->prepare("DELETE FROM sushi_items WHERE id = ?");
    $delete->execute([$id]);

    header("Location: admin.php");
    exit;
}

header("Location: admin.php");
exit;
?>
