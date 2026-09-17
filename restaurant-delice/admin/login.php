<?php

session_start();

if (isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $identifiant = trim($_POST["identifiant"] ?? "");
    $mot_de_passe = $_POST["mot_de_passe"] ?? "";

    if ($identifiant === "admin" && $mot_de_passe === "admin123") {
        $_SESSION["admin"] = $identifiant;

        header("Location: index.php");
        exit;
    }

    $erreur = "Identifiant ou mot de passe incorrect.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Connexion Admin | Restaurant Délice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #212529, #dc3545);
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .2);
        }

        .logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #dc3545;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        .login-title {
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
        }

        .login-subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
        }

        .input-group-text {
            background: white;
        }

        .form-control {
            height: 50px;
        }

        .btn-login {
            height: 50px;
            width: 100%;
            border: none;
            border-radius: 10px;
            background: #dc3545;
            color: white;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            background: #bb2d3b;
            transform: translateY(-2px);
        }

        .back-site {
            text-align: center;
            margin-top: 25px;
        }

        .back-site a {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <div class="logo">
            <i class="bi bi-shop"></i>
        </div>

        <h2 class="login-title">Restaurant Délice</h2>

        <p class="login-subtitle">
            Espace administration
        </p>

        <?php if (!empty($erreur)): ?>

            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>
                <?= htmlspecialchars($erreur) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">

                <label for="identifiant" class="form-label">
                    Identifiant
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>

                    <input
                        type="text"
                        class="form-control"
                        id="identifiant"
                        name="identifiant"
                        placeholder="Votre identifiant"
                        required
                    >

                </div>

            </div>

            <div class="mb-4">

                <label for="mot_de_passe" class="form-label">
                    Mot de passe
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input
                        type="password"
                        class="form-control"
                        id="mot_de_passe"
                        name="mot_de_passe"
                        placeholder="Votre mot de passe"
                        required
                    >

                </div>

            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Se connecter
            </button>

        </form>

        <div class="back-site">

            <a href="../index.html">
                <i class="bi bi-arrow-left me-1"></i>
                Retour au site
            </a>

        </div>

    </div>

</div>

</body>
</html>