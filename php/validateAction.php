<?php

if(isset($_POST['submit'])){

    $id = $_GET['id'];
    $solde = htmlspecialchars($_POST['solde']);

    $updateStudent = $bd->prepare('UPDATE etudiant SET solde = ? WHERE id = ?');
    $updateStudent->execute(array($solde, $id));

    $checkInfos = $bd->prepare('SELECT * FROM etudiant WHERE id = ?');
    $checkInfos->execute(array($id));

    $infos = $checkInfos->fetch();

    if ($infos['solde'] == 0) {

        $updateCandidate = $bd->prepare('UPDATE candidature SET statut = ? WHERE id_etudiant = ?');
        $updateCandidate->execute(array('en attente', $id));
        header('location: ./list.php?statut=en_attente&idEtudiant='.$id);

    }else {
        $updateCandidate = $bd->prepare('UPDATE candidature SET statut = ? WHERE id_etudiant = ?');
        $updateCandidate->execute(array('suspendu', $id));
        header('location: ./list.php?statut=suspendu&idEtudiant='.$id);
    }

    
    
    
}




?>