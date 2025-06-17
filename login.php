<?php
require 'db.php';
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Connexion</h2>
  <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">Se connecter</button>
  </form>
  <p>Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
</body>
</html>
