<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require_once "../php/connexion.php";

$stmt = $pdo->query("SELECT * FROM reservations ORDER BY created_at DESC");
$reservations = $stmt->fetchAll();

$total = count($reservations);
$attente = 0;
$confirmees = 0;
$annulees = 0;

foreach ($reservations as $reservation) {
    if ($reservation["statut"] === "En attente") {
        $attente++;
    }

    if ($reservation["statut"] === "Confirmée") {
        $confirmees++;
    }

    if ($reservation["statut"] === "Annulée") {
        $annulees++;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration | Restaurant Délice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: #212529;
            color: white;
            padding: 25px 15px;
        }

        .sidebar h3 {
            font-weight: 700;
            margin-bottom: 35px;
        }

        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #dc3545;
        }

        .main-content {
            padding: 30px;
        }

        .topbar {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,.06);
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,.06);
            height: 100%;
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 25px;
            background: #f1f1f1;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
        }

        .reservation-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-top: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,.06);
        }

        .table {
            vertical-align: middle;
        }

        .badge-status {
            padding: 8px 12px;
            border-radius: 20px;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #777;
        }

        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }

            .main-content {
                padding: 15px;
            }

            .table-responsive {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <aside class="col-lg-2 sidebar">

            <h3>
                <i class="bi bi-shop"></i>
                Délice
            </h3>

            <a href="index.php" class="active">
                <i class="bi bi-speedometer2 me-2"></i>
                Tableau de bord
            </a>

            <a href="../index.html">
                <i class="bi bi-house me-2"></i>
                Voir le site
            </a>

            <a href="logout.php">
                <i class="bi bi-box-arrow-right me-2"></i>
                Déconnexion
            </a>

        </aside>

        <main class="col-lg-10 main-content">

            <div class="topbar d-flex justify-content-between align-items-center">

                <div>
                    <h2 class="mb-1">Tableau de bord</h2>
                    <p class="text-muted mb-0">
                        Gestion des réservations du Restaurant Délice
                    </p>
                </div>

                <div>
                    <i class="bi bi-person-circle fs-2"></i>
                </div>

            </div>

            <div class="row g-4">

                <div class="col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Total</p>
                                <div class="stat-number">
                                    <?= $total ?>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">En attente</p>
                                <div class="stat-number">
                                    <?= $attente ?>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Confirmées</p>
                                <div class="stat-number">
                                    <?= $confirmees ?>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Annulées</p>
                                <div class="stat-number">
                                    <?= $annulees ?>
                                </div>
                            </div>

                            <div class="stat-icon">
                                <i class="bi bi-x-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="reservation-card">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="mb-1">Réservations</h4>
                        <p class="text-muted mb-0">
                            Liste des réservations reçues
                        </p>
                    </div>

                    <button onclick="window.location.reload()" class="btn btn-dark">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        Actualiser
                    </button>

                </div>

                <?php if (empty($reservations)): ?>

                    <div class="empty">
                        <i class="bi bi-calendar-x fs-1"></i>
                        <h5 class="mt-3">Aucune réservation</h5>
                        <p>Les nouvelles réservations apparaîtront ici.</p>
                    </div>

                <?php else: ?>

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead class="table-dark">

                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Téléphone</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Personnes</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($reservations as $reservation): ?>

                                    <tr>

                                        <td>
                                            #<?= htmlspecialchars($reservation["id"]) ?>
                                        </td>

                                        <td>
                                            <strong>
                                                <?= htmlspecialchars($reservation["nom"]) ?>
                                            </strong>

                                            <?php if (!empty($reservation["email"])): ?>
                                                <br>
                                                <small class="text-muted">
                                                    <?= htmlspecialchars($reservation["email"]) ?>
                                                </small>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($reservation["telephone"]) ?>
                                        </td>

                                        <td>
                                            <?= date("d/m/Y", strtotime($reservation["date_reservation"])) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(substr($reservation["heure_reservation"], 0, 5)) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($reservation["nombre_personnes"]) ?>
                                        </td>

                                        <td>

                                            <?php if ($reservation["statut"] === "Confirmée"): ?>

                                                <span class="badge bg-success badge-status">
                                                    Confirmée
                                                </span>

                                            <?php elseif ($reservation["statut"] === "Annulée"): ?>

                                                <span class="badge bg-danger badge-status">
                                                    Annulée
                                                </span>

                                            <?php else: ?>

                                                <span class="badge bg-warning text-dark badge-status">
                                                    En attente
                                                </span>

                                            <?php endif; ?>

                                        </td>

                                        <td>

                                            <div class="btn-group">

                                                <a href="../php/confirmer.php?id=<?= $reservation["id"] ?>"
                                                   class="btn btn-sm btn-success"
                                                   title="Confirmer">
                                                    <i class="bi bi-check-lg"></i>
                                                </a>

                                                <a href="../php/annuler.php?id=<?= $reservation["id"] ?>"
                                                   class="btn btn-sm btn-warning"
                                                   title="Annuler">
                                                    <i class="bi bi-x-lg"></i>
                                                </a>

                                                <a href="../php/supprimer.php?id=<?= $reservation["id"] ?>"
                                                   class="btn btn-sm btn-danger"
                                                   title="Supprimer"
                                                   onclick="return confirm('Voulez-vous vraiment supprimer cette réservation ?');">
                                                    <i class="bi bi-trash"></i>
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php endif; ?>

            </div>

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>