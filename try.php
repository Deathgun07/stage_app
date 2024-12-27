<?php
    session_start();

    if (isset($_POST['submit'])) {

        $uploadDir = 'image/profile/';
        uploadFile($_FILES['file']['tmp_name'], $uploadDir);

        $_SESSION['file'] = basename($_FILES['file']['name']);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    if (isset($_SESSION['file'])) {
        echo $_SESSION['file'];
    }

?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Téléchargez un fichier PDF :</label>
        <input type="file" id="file" name="file" required>
        <button type="submit" name="submit">Envoyer</button>
    </form>
</body>
</html>