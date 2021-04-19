<?php
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadDir = 'public/assets/';
    $file_uniq_id = uniqid();
    $uploadFile = $uploadDir . $file_uniq_id . basename($_FILES['avatar']['name']);

    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg', 'webp', 'png'];
    $maxFileSize = 1000000;
    if ((!in_array($extension, $extensions_ok))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Png ou Webp !';
    }
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label for="imageUpload">Upload an profile image</label>
    <input type="file" name="avatar" id="imageUpload" />
    <p>Homer J.Simpson</p>
    <p> 25 ans </p><br>
    <button name="send">Send</button>
    <img src="<?= $uploadFile ?>"/>
</form>
</body>
</html>
