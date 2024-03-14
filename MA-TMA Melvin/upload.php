<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php include 'header.php'; ?>
        <button class="btn-back"><a href="index.php">Retour</a><br></button>
        <?php
        session_start();

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx');
            if(in_array($imageFileType, $allowed_types)) {
                $uploadOk = 1;
            } else {
                echo "Désolé, seuls les fichiers JPG, JPEG, PNG, GIF, PDF, DOC et DOCX sont autorisés.";
                $uploadOk = 0;
            }
        }


if (file_exists($target_file)) {
    echo "Désolé, fichiers déjà existants.";  // verif pour le fichier deja existant ou pas
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 1500000) {  // verif pour la taille du fichier
    echo "Désolé, fichiers trop grands.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" // verif pour le type de fichier
&& $imageFileType != "gif" && $imageFileType != "pdf"  ) {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG, GIF, PDF, DOC et DOCX sont autorisés.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas été upload.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION['uploaded_file'] = $target_file;
        echo "Le fichier ". basename( $_FILES["fileToUpload"]["name"]). " a bien été téléchargé.";
    } else {
        echo "Désolé, erreur .";
    }
}

if (isset($_SESSION['uploaded_file']) && file_exists($_SESSION['uploaded_file'])) {    
    if ($imageFileType == "pdf") {
        echo '<embed src="'.$_SESSION['uploaded_file'].'" type="application/pdf" width="100%" height="600px" />';
    } else {
        echo '<img src="'.$_SESSION['uploaded_file'].'" alt="Uploaded Image" style="max-width:100%;">';
    }
} else {
    echo 'Aucun fichier a était upload';
}

?>
</div>
</body>
</html>
