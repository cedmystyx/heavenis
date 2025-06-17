<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Accueil - Zephyros</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Bienvenue sur Zephyros</h1>
  <?php if (isset($_SESSION['username'])): ?>
    <p>Connecté en tant que <?= htmlspecialchars($_SESSION['username']) ?></p>
    <a href="logout.php">Déconnexion</a>
  <?php else: ?>
    <a href="login.php">Connexion</a> | <a href="register.php">Inscription</a>
  <?php endif; ?>
</body>
</html>