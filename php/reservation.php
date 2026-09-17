<?php

require_once "connexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/reservation.html");
    exit;
}

$nom = trim($_POST["nom"] ?? "");
$telephone = trim($_POST["telephone"] ?? "");
$email = trim($_POST["email"] ?? "");
$date = trim($_POST["date"] ?? "");
$heure = trim($_POST["heure"] ?? "");
$nombre_personnes = intval($_POST["nombre_personnes"] ?? 0);
$message = trim($_POST["message"] ?? "");

if (
    empty($nom) ||
    empty($telephone) ||
    empty($date) ||
    empty($heure) ||
    $nombre_personnes < 1
) {
    header("Location: ../pages/reservation.html?error=champs");
    exit;
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../pages/reservation.html?error=email");
    exit;
}

try {
    $sql = "INSERT INTO reservations
            (nom, telephone, email, date_reservation, heure_reservation, nombre_personnes, message)
            VALUES
            (:nom, :telephone, :email, :date_reservation, :heure_reservation, :nombre_personnes, :message)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":telephone" => $telephone,
        ":email" => $email,
        ":date_reservation" => $date,
        ":heure_reservation" => $heure,
        ":nombre_personnes" => $nombre_personnes,
        ":message" => $message
    ]);

    header("Location: ../pages/reservation.html?success=1");
    exit;

} catch (PDOException $e) {
    header("Location: ../pages/reservation.html?error=database");
    exit;
}
?>