<?php

require_once "connexion.php";

$id = intval($_GET["id"] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare("UPDATE reservations SET statut = 'Annulée' WHERE id = :id");
    $stmt->execute([":id" => $id]);
}

header("Location: ../admin/index.php");
exit;
?>