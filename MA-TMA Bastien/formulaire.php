<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="index.css" rel="stylesheet">
    <title>Formulaire</title>
</head>
<body>
    <div class="background">
        <div class="text">
            <?php include 'header.php'; ?>
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="file" name="fichier" accept="image/*, .pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                <input type="submit" name="upload" value="Uploader">
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
