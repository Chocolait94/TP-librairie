<?php


//include 'header.php';
include 'PDO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_username'])) {
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$login_username]);
    $user = $stmt->fetch();

    if ($user && password_verify($login_password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo "Connexion réussie";
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>
<!--formulaire de connexion-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="index.js"></script>
</head>
<body>
    <main>
    <form action="index.php" method="post">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required><br>
        <button type = "submit">Se connecter</button>

    </form>
    </main>
    <style>
        /* Variables de couleurs et de polices */
:root {
  --couleur-primaire: #007bff;
  --couleur-secondaire: #6c757d;
  --couleur-fond: #f8f9fa;
  --couleur-texte: #343a40;
  --police-principale: sans-serif;
}
main {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

form {
  background-color: #fff;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 400px;
}

label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ced4da;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 1rem;
}

button[type="submit"] {
  background-color: var(--couleur-primaire);
  color: #fff;
  padding: 1rem 1.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 1rem;
  width: 100%; /* Le bouton prend toute la largeur */
}

button[type="submit"]:hover {
  background-color: #0056b3;
}
  </style>
</body>
</html> 