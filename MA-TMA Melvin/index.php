<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.5">
    <title>upload</title>
</head>
<body>
<div class="container">
    <?php include 'header.php'; ?>
    <form class="formulaire" action="upload.php" method="post" enctype="multipart/form-data">
        <input class="input-upload" type="file" name="fileToUpload" id="fileToUpload">
        <button type="submit" name="submit">Upload File</button>
    </form>
    <a href="./telo/index.php" class="upload-button">Allez sur le projet de Telo</a>
</div>
</body>
</html>
