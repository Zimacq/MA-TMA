<?php
// Fonction pour gérer l'upload de fichiers
function handleUpload() {
    if (!empty($_POST['nom']) && !empty($_FILES['fichier']['name'])) {
        if ($_FILES['fichier']['error'] === 0) {
            // Définir le répertoire de destination
            $uploadDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR;
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true); // Créer le dossier si inexistant
            }

            // Récupérer l'extension du fichier
            $fileInfo = new SplFileInfo($_FILES['fichier']['name']);
            $extension = $fileInfo->getExtension();

            // Vérifier si l'extension est autorisée (PDF ou image)
            if (in_array($extension, array('pdf', 'jpg', 'jpeg', 'png', 'gif'))) {
                // Sécuriser le nom du fichier
                $nomFichierSecurise = preg_replace("/[^a-zA-Z0-9.]/", "_", $_POST['nom']);
                $nouveauFichier = $nomFichierSecurise . '.' . $extension;

                // Déplacer le fichier vers le répertoire de destination
                if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadDirectory . $nouveauFichier)) {
                    return true; // Succès de l'upload
                } else {
                    return false; // Erreur de déplacement du fichier
                }
            } else {
                return false; // Extension non autorisée
            }
        } else {
            return false; // Erreur d'upload
        }
    } else {
        return false; // Champs manquants
    }
}

// Fonction pour rediriger l'utilisateur vers une autre page
function redirectTo($type, $code) {
    header('Location: index.php?type=' . $type . '&code=' . $code);
    exit();
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['envoyer'])) {
    // Appeler la fonction pour gérer l'upload
    if (handleUpload()) {
        redirectTo('success', ''); // Rediriger en cas de succès
    } else {
        redirectTo('error', '1'); // Rediriger en cas d'erreur
    }
} else {
    redirectTo('error', '1'); // Rediriger si le formulaire n'a pas été soumis
}
?>
