<?php
// Démarrer la session
session_start();
include 'header.php';
include 'PDO.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Librairie</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assurez-vous d'avoir un fichier CSS pour le style -->
    <script defer src="index.js"></script>
</head>
<body>
    <header>
        <h1>Bienvenue à la Librairie</h1>
    </header>

    <main>
        <section class="search-bar">
            <form action="recherche.php" method="get">
                <input type="text" name="query" placeholder="Rechercher un livre...">
                <button type="submit">Rechercher</button>
            </form>
        </section>

        <section class="featured-books">
            <h2>Livres en vedette</h2>
            <!-- Ajoutez ici du code PHP pour afficher les livres en vedette -->
            <?php
            // Exemple de code pour afficher des livres en vedette
            $books = [
                ["title" => "Livre 1", "author" => "Auteur 1"],
                ["title" => "Livre 2", "author" => "Auteur 2"],
                ["title" => "Livre 3", "author" => "Auteur 3"]
            ];

            foreach ($books as $book) {
                echo "<div class='book'>";
                echo "<h3>" . $book['title'] . "</h3>";
                echo "<p>par " . $book['author'] . "</p>";
                echo "</div>";
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Librairie. Tous droits réservés.</p>
    </footer>
</body>
</html>
