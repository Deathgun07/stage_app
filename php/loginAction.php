<?php

require('./db.php');

if (isset($_POST['connect'])) {
    if (isset($_POST['mdp']) && !empty(isset($_POST['mdp']))) {
        # code...
        $email = htmlspecialchars($_POST['matricule']);
        $mdp = htmlspecialchars($_POST['mdp']);

        $checkAdmin = $bd->prepare('SELECT * FROM utilisateur WHERE email = ?');
        $checkAdmin->execute(array($email));

        if ($checkAdmin->rowCount() > 0) {
            while ($admin = $checkAdmin->fetch()) {

                if ($admin['mot_de_passe'] == $mdp) {

                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $admin['id'];
                    $_SESSION['email'] = $admin['email'];
                    $_SESSION['nom'] = $admin['nom'];
                    $_SESSION['prenom'] = $admin['prenom'];
                    $_SESSION['statut'] = $admin['statut'];

                    header('location: ./home.php');

                }else {
                    
                    $errormsg = "Mot de passe incorrecte";
                }

            }
        }else {
            $errormsg = "Email incorrecte";
        }


    }else {
        $matricule = htmlspecialchars($_POST['matricule']);

        $checkStudent = $bd->prepare('SELECT * FROM etudiant WHERE matricule = ?');
        $checkStudent->execute(array($matricule));

        if ($checkStudent->rowCount() > 0) {
            while ($student = $checkStudent->fetch()) {

            $_SESSION['auth'] = true;
            $_SESSION['id'] = $student['id'];
            $_SESSION['matricule'] = $student['matricule'];
            $_SESSION['nom'] = $student['nom'];
            $_SESSION['prenom'] = $student['prenom'];
            $_SESSION['statut'] = $student['statut'];
            $_SESSION['photo'] = $student['photo'];

            header('location: ./home.php');

            }
        }else {
            $errormsg = "Aucun etudiant n'a se matricule";
        }
    }

    
}




?>