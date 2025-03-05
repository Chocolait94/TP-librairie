<?php
session_start();

include 'PDO.php';
//include 'header.php';

/*if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    echo "Vous devez être connecté pour accéder à cette page.";
    exit();
}*/


try {
    $dsn = "mysql:dbname=eshop;host=localhost";
    $db_user = "root";
    $db_password = "";
    $option = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $pdo = new PDO($dsn, $db_user, $db_password, $option);
    echo "Connexion du BDD réussie";
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
}

$user_id = $_SESSION['user_id'];
$query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$query->bindParam(':id', $user_id, PDO::PARAM_INT);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}
?>
<!-- page de profil -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script defer src="index.js"></script>
</head>
<body>
    <main>
        <h1>Profil de <?= htmlspecialchars($user['username']) ?></h1>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>Date de création: <?= htmlspecialchars($user['created_at']) ?></p>
    </main>
</body>
</html>
