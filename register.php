<?php
require 'db.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!$username || !$password) {
        $errors[] = "Tous les champs sont requis.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $errors[] = "Nom d'utilisateur déjà pris.";
        } else {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed]);
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Inscription</h2>
  <?php foreach ($errors as $e) echo "<p style='color:red;'>$e</p>"; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">S'inscrire</button>
  </form>
  <p>Déjà inscrit ? <a href="login.php">Connecte-toi</a></p>
</body>
</html>
