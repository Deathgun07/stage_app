<?php

require('./db.php');

function uploadFile($file, $targetDir) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = uniqid() . '_' . basename($file['name']);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $targetFile;
    }

    return null;
}

if (isset($_GET['update'])) {
    $update = $_GET['update'];
}

if(isset($_POST['submit'])){

    $email = htmlspecialchars($_POST['email']);
    $commune = htmlspecialchars($_POST['commune']);
    $quartier = htmlspecialchars($_POST['quartier']);
    $phone = htmlspecialchars($_POST['phone']);
    $phone2 = htmlspecialchars($_POST['phone2']);
    $diplome = htmlspecialchars($_POST['diplome']);
    $date_diplome = htmlspecialchars($_POST['date_diplome']);
    $etablissement_diplome = htmlspecialchars($_POST['etablissement_diplome']);
    $commune_1 = htmlentities($_POST['commune_1']);
    $commune_2 = htmlentities($_POST['commune_2']);
    $commune_3 = htmlentities($_POST['commune_3']);

    $uploadDir = 'upload/';
    $photo = uploadFile($_FILES['photo'], $uploadDir . 'photo/');
    $cv = uploadFile($_FILES['cv'], $uploadDir . 'pdf/');

    $updateStudent = $bd->prepare('UPDATE etudiant SET email = ?, commune = ?, quartier = ?, phone = ?, phone_2 = ?, commune_1 = ?, commune_2 = ?, commune_3 = ?, photo = ?, cv = ?, diplome = ?, date_diplome = ?, etablissement = ? WHERE id = ?');
    $updateStudent->execute(array($email, $commune, $quartier, $phone, $phone2, $commune_1, $commune_2, $commune_3, $photo, $cv, $diplome, $date_diplome, $etablissement_diplome, $_SESSION['id']));

    $checkCandidate = $bd->prepare('SELECT * FROM candidature WHERE id_etudiant = ?');
    $checkCandidate->execute(array($_SESSION['id']));

    if ($checkCandidate->rowCount() == 0) {

        $insertCandidate = $bd->prepare('INSERT INTO candidature(id_etudiant) VALUES (?)');
        $insertCandidate->execute(array($_SESSION['id']));
    }
    
    if (isset($update)) {
        header('location: ./ask.php?update=1');
    }else {
        header('location: ./ask.php?success=1');
    }
    
}




?>