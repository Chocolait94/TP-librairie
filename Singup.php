<?php

//include 'header.php';
include 'PDO.php';
// 1) On vérifie que le form ait été soumis avec la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    // 2) On vérifie que les champs soient tous remplis
    if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm-password"])) {
  
      // 3) On vérirife que les mdp soient les memes (sinon on affiche une erreur)
      if ($_POST["password"] === $_POST["confirm-password"]) {
  
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password_confirm = $_POST["confirm-password"];
  
        // 4) Vérification de la forme de l'email 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
  
            // 5) On annule les potentiels caractères spéciaux liés au HTML
            $username = htmlspecialchars($username);        
  
            // 6) On vient vérifier que le user n'existe pas déjà, via son email
            $sql = "SELECT * FROM users WHERE email = ?";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch();
  
            // Si il existe déjà un user avec cet email on affiche un message d'erreur 
            // Sinon on enregistre le nouveau user en BDD 
            if ($user) {
              $error = "Il semble que l'email existe déjà en BDD";
            } else {
              // On crée le hash avant d'enregistrer les infos en BDD
              $hash = password_hash($password, PASSWORD_DEFAULT);
  
              $sql = "INSERT INTO users(email, username, password_hash) VALUES(?, ?, ?)";
  
              $stmt = $pdo->prepare($sql);
              $stmt->execute([$email, $username, $hash]);
              echo "Utilisateur ajouté avec succès !";
            }
        } else {
          $error = "Email au mauvais format";
        }
      } else {
        $error = "Attention les mdp sont différents";
      }
    } else {
      $error = "Veuillez remplir tous les champs";
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="index.js"></script>
    <!--<link rel="stylesheet" href="style.css">-->
    <title>S'incrire</title>
    <script defer src="index.js"></script>
</head>
<body>
    <main>
    <form action="index.php" method="post">
        <label for="username">Username :</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password :</label> 
        <input type="password" name="password" id="password" required><br>
        <label for="confirm-password">Confirm Password :</label> 
        <input type="password" name="confirm-password" id="confirm-password" required><br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br>
        <button type = "submit">S'inscrire</button>
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

form {
  background-color: #fff;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 400px;
}
main{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
}

input[type="text"],
input[type="password"],
input[type="email"] {
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
  width: 100%;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}
    </style>
</body>
</html>