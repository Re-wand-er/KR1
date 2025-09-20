<?php
include 'config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("
    UPDATE products 
    SET status= 
        CASE 
            WHEN status = 'в наличии' THEN 'использован' 
            WHEN status = 'использован' THEN  'в наличии'
            ELSE status = 'использован'
        END
    WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: index.php");
exit;
