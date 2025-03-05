<?php 
include 'PDO.php';
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_favorite'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $stmt = $pdo->prepare("INSERT INTO favorites (user_id, book_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $book_id]);
    echo "votre livre a bien été ajouté en favoris !";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_favorite'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $stmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND book_id = ?");
    $stmt->execute([$user_id, $book_id]);
    echo "votre livre a bien été supprimé de vos favoris !";
}
?>
<!--formulaire d'ajout de livre en favoris-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter un livre en favoris</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="index.js"></script>
</head>
<body>
    <main>
    <form action="index.php" method="post">
        <input type="hidden" name="book_id" value="ID_DU_LIVRE">
        <button type = "submit" name="add_favorite">Ajouter en favoris</button>
    </form>
    </main>
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input{
            margin-bottom: 10px;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</body>
</html>

<!--formulaire de suppression de livre en favoris-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>supprimer un livre en favoris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="post">
        <input type="hidden" name="book_id" value="ID_DU_LIVRE">
        <button type = "submit" name="delete_favorite">Supprimer des favoris</button>
    </form>
</body>
</html>