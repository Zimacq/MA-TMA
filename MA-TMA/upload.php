<?php

// Vérifier si le bouton d'envoi a été pressé
if (isset($_POST['envoyer'])) {
    // Vérifier si le nom du fichier et le fichier lui-même ont bien été reçus
    if (!empty($_POST['nom']) && !empty($_FILES['fichier']['name'])) {
        // Vérifier s'il n'y a pas d'erreur avec le fichier uploadé
        if ($_FILES['fichier']['error'] === 0) {
            $uploadDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR;
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true); // Crée le dossier avec les droits de lecture/écriture
            }

            $fileInfo = new SplFileInfo($_FILES['fichier']['name']);
            $extension = $fileInfo->getExtension();
            $nomFichierSecurise = preg_replace("/[^a-zA-Z0-9.]/", "_", $_POST['nom']); // Sécurisation du nom du fichier
            $nouveauFichier = $nomFichierSecurise . '.' . $extension;

            // Déplacement du fichier uploadé
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadDirectory . $nouveauFichier)) {
                header('Location: index.php?type=success');
                exit();
            } else {
                // Erreur de déplacement du fichier
                header('Location: index.php?type=error&code=4');
                exit();
            }
        } else {
            // Erreur upload
            header('Location: index.php?type=error&code=3');
            exit();
        }
    } else {
        // Champs manquants
        header('Location: index.php?type=error&code=2');
        exit();
    }
} else {
    // Accès non autorisé (pas via le formulaire)
    header('Location: index.php?type=error&code=1');
    exit();
}
