<?php

require_once "connexion.php";

$id = intval($_GET["id"] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM reservations WHERE id = :id");
    $stmt->execute([":id" => $id]);
}

header("Location: ../admin/index.php");
exit;
?>