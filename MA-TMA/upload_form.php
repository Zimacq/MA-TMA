<?php
// Inclure le header
include 'header.php';

// Fonction pour afficher un message
function displayMessage($message) {
    if (!empty($message)) {
        echo '<p class="message">' . htmlspecialchars($message) . '</p>';
    }
}

// Fonction pour afficher la liste des fichiers uploadés
function displayFileList() {
    $uploadedFiles = scandir(__DIR__ . DIRECTORY_SEPARATOR . 'files');
    echo '<ul>';
    foreach ($uploadedFiles as $file) {
        if ($file !== '.' && $file !== '..') {
            echo '<li><a href="./files/' . htmlspecialchars($file) . '">' . htmlspecialchars($file) . '</a></li>';
        }
    }
    echo '</ul>';
}
?>

<!doctype html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="utf-8">
    <title>Système d'upload de fichiers</title>
</head>
<body>
    <div class="container">
        <header>
            <h1>Système d'upload de fichier</h1>
        </header>
        
        <?php displayMessage($message); ?>
        
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="upload-form">
            <input type="text" name="nom" id="nom" placeholder="Nom du fichier" required>
            <input type="file" name="fichier" accept=".pdf, image/*" required> <!-- Restreindre les types de fichiers -->
            <input type="submit" name="envoyer" value="Envoyer le fichier">
        </form>
        
        <div class="file-list">
            <?php displayFileList(); ?>
        </div>

        <div class="center-button">
            <a href="index.php" class="back-accueil">Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>
