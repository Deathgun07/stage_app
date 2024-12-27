<?php
session_start();
require('./php/security.php');
require('./php/select.php');
require('./php/formAction.php');

if ($_SESSION['statut'] == 'Etudiant(e)') {

    $checkStudents = $bd->prepare('SELECT * FROM etudiant WHERE id = ?');
    $checkStudents->execute(array($_SESSION['id']));

    $etudiant = $checkStudents->fetch();


    $checkCandidates = $bd->prepare('SELECT * FROM candidature WHERE statut = ?');
    $checkCandidates->execute(array('en cours de validation'));

}
if ($_SESSION['statut'] != 'Etudiant(e)') {

    $checkCandid = $bd->prepare('SELECT * FROM candidature WHERE statut = ?');
    $checkCandid->execute(array('en cours de validation'));

    if (isset($_GET['statut']) && !empty($_GET['statut'])) {

        if ($_GET['statut'] == "en_attente") {

            $checkCandidates = $bd->prepare('SELECT * FROM candidature WHERE statut = ?');
            $checkCandidates->execute(array('en attente'));
            $title = "VALIDEES";
        } else if ($_GET['statut'] == "suspendu") {

            $checkCandidates = $bd->prepare('SELECT * FROM candidature WHERE statut = ?');
            $checkCandidates->execute(array('suspendu'));
            $title = "SUSPENDUS";
        }else{
            $checkCandidates = $bd->prepare('SELECT * FROM candidature WHERE statut = ?');
            $checkCandidates->execute(array('en cours de validation'));
            $title = "EN ATTENTES";
        }
        
    }else{
        $checkCandidates = $bd->prepare('SELECT * FROM candidature WHERE statut = ?');
        $checkCandidates->execute(array('en cours de validation'));
        $title = "EN ATTENTES";
    }
    

    $checkusers = $bd->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $checkusers->execute(array($_SESSION['id']));

    $user = $checkusers->fetch();
}
    



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./image/bleu.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>
        <?php

            if ($_GET['statut'] == "en_attente") {

                echo 'Demandes validées';

            } else if ($_GET['statut'] == "suspendu") {

                echo 'Demandes suspendu';

            }else{
                echo 'Nouvelles demandes';
            }

        ?>
    </title>
</head>
<style>  
    .home .content .item .details .info:nth-child(1){
        background: url(../image/istockphoto-1214262700-612x612.jpg) no-repeat;
    }
    .col.other .photo{
        width: 200px;
        height: 200px;
        background: url(../image/istockphoto-1214262700-612x612.jpg) no-repeat;
        background-size: cover;
        background-position: center;
    }
    .col.other .cv{
        position: relative;
        width: 200px;
        height: 200px;
    }
    .col.other .cv p{
        position: absolute;
        font-size: 16px;
        padding-left: 20px;
        bottom: 0;
    }
    .col.other .cv svg{
        color: var(--blue);
        width: 150px;
        height: 150px;
    }
    .btn{
        width: fit-content;
        margin-left: auto;
    }
    thead, thead tr{
        width: 100%;
    }
    thead tr td{
        color: var(--white);
        background: var(--grey);
        padding: 5px 10px;
    }
    .filter{
        display: flex;
        width: 100%;
        justify-content: space-between;
        flex-direction: row;
    }
    .filter .check{
        width: fit-content;
        gap: 10px;
    }
    .filter .check .other{
        display: flex;
        width: fit-content;
        gap: 10px;
    }
    #col{
        padding: 10px 20px;
        background: var(--lightgrey);
        width: 300px;
        border: 0;
        outline: none;
        transition: var(--transition);
    }
    .btn.gold{
        display: flex;
        color: var(--white);
        width: fit-content;
        height: fit-content;
        padding: 0;
        padding: 5px 20px;
        background: var(--gold);
        border: 1px solid var(--gold);
        transition: var(--transition);
        align-items: center;
        gap: 8px;
    }
    .btn.gold p{
        padding: 0;
        margin: 0;
    }
    .btn.gold:hover{
        color: var(--gold);
        background: transparent;
        border: 1px solid var(--gold);
        transform: translateY(0px);
    }
    body{
        font-size: 14px;
    }
    h2{
        font-size: 18px;
    }
    ul{
        padding:0;
    }
    
</style>
<body>
    <section class="home section">
    <div class="navbar">
            <div class="text">
                <svg xmlns="http://www.w3.org/2000/svg" id="hamburger" width="20" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                  </svg>
                <h2><span style="color: var(--blue); text-transform: capitalize;"><?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></span></span></h2>
            </div>
            <div id="statut"><?= $_SESSION['statut'] ?></span></div>
            <div class="profile">
               <div class="img-profile">
                    <?php

                        if ($_SESSION['statut'] == 'Etudiant(e)') {

                            ?>
                                <img src="<?= $etudiant['photo'] ?>" alt="">
                            <?php
                        }else {
                            ?>
                                <img src="<?= $user['photo'] ?>" alt="">
                            <?php
                        }

                    ?>
               </div>
            </div>
        </div>
        <div class="menu-lateral">
            <div class="bar">
                <svg id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1099.14 363.9">
                <defs>
                    <style>
                    .cls-2 {
                        fill: #36aad0;
                    }
                    @media screen and (max-width: 420px){
                        .cls-2 {
                            fill: #ffffff;
                        }
                    }
                    </style>
                </defs>
                <g id="Calque_1-2" data-name="Calque 1">
                    <g>
                    <path class="cls-2" d="M125.9,104.42v171.07h-45.33V132.18s17.94-23.89,45.33-27.76Z"/>
                    <path class="cls-2" d="M248.61,277.77c-46.95,0-83.21-24.61-83.86-67.35h48.57c1.29,18.13,13.28,30.11,34.32,30.11s34-11.33,34-27.52c0-48.89-116.56-19.43-116.24-101.34,0-40.8,33.03-65.4,79.65-65.4s78.03,23.64,80.95,64.43h-49.86c-.97-14.89-12.95-26.55-32.38-26.87-17.81-.65-31.08,8.09-31.08,26.55,0,45.33,115.91,20.07,115.91,99.73,0,35.62-28.49,67.67-79.97,67.67Z"/>
                    <path class="cls-2" d="M374.87,133.36h-21.37v-37.23h21.37V51.77h45.66v44.36h40.15v37.23h-40.15v86.77c0,11.98,4.86,17.16,19.1,17.16h21.05v38.21h-28.49c-34.32,0-57.31-14.57-57.31-55.69v-86.45Z"/>
                    <path class="cls-2" d="M563.63,93.21c28.82,0,48.57,13.6,59.25,28.49v-25.58h45.66v179.38h-45.66v-26.23c-10.68,15.54-31.08,29.14-59.58,29.14-45.33,0-81.59-37.24-81.59-93.25s36.26-91.96,81.92-91.96Zm11.66,39.83c-24.28,0-47.27,18.13-47.27,52.13s22.99,53.42,47.27,53.42,47.6-18.78,47.6-52.78-22.66-52.78-47.6-52.78Z"/>
                    <path class="cls-2" d="M783.14,93.21c28.17,0,48.57,12.95,59.25,28.49v-25.58h45.66v180.67c0,48.57-29.79,87.1-88.72,87.1-50.51,0-85.8-25.25-90.34-66.38h45.01c4.53,16.19,21.37,26.87,44.03,26.87,24.93,0,44.36-14.24,44.36-47.6v-27.84c-10.68,15.54-31.08,29.46-59.25,29.46-45.65,0-81.92-37.24-81.92-93.25s36.26-91.96,81.92-91.96Zm11.66,39.83c-24.28,0-47.27,18.13-47.27,52.13s22.99,53.42,47.27,53.42,47.6-18.78,47.6-52.78-22.66-52.78-47.6-52.78Z"/>
                    <path class="cls-2" d="M1010.75,278.42c-52.13,0-90.01-36.26-90.01-92.6s36.91-92.6,90.01-92.6,88.39,35.29,88.39,88.72c0,5.83-.32,11.66-1.29,17.48h-131.13c2.27,26.55,20.4,41.44,43.06,41.44,19.43,0,30.11-9.71,35.94-21.69h48.89c-9.71,33.03-39.5,59.25-83.86,59.25Zm-43.71-109.44h85.16c-.65-23.64-19.43-38.53-42.74-38.53-21.69,0-38.85,13.92-42.42,38.53Z"/>
                    <path class="cls-2" d="M143.92,90.71c-42.1-10.52-78.93,36.83-78.93,36.83l-10.81-21.63-4.97-9.95v-.05l-1.21-.39-27.73,4.26v-5.47c0-.53-.45-.97-.97-.97h-.03c-.53,0-.97,.45-.97,.97v5.79l-9.58,1.47c-6.1,.95-10.71-5.45-7.84-10.95L46.23,4.05c1.58-3,5-4.6,8.31-3.87l75.06,16.65c4.66,1.03,7.21,6.1,5.24,10.45l-13.08,28.97-14.68-20.79s-52.62-7.89-63.15,49.99l3.6,7.21,2.16,.66c11.66-54.99,62.65-47.33,62.65-47.33l14.68,20.79,16.89,23.94Z"/>
                    <path class="cls-2" d="M18.29,100.11l1.97-.32v10.76c1.26,1.34,1.97,4.97,2.6,7.68,.74,3.82,1.34,6.26,1.66,12.97,.03,1.45-.05,2.87-.11,4.24h-.16c-.18-3.1-.24-6.03-.21-8.97,0-.05-.03-.08-.05-.05-.26,.13-.53,.26-.76,.37-.03,0-.05,.05-.05,.08-.05,2.47,.05,4.95,.45,7.81,.05,.42,0,.76-.13,.76s-.32-.37-.39-.79c-.55-2.95-.68-5.29-.61-7.58,0-.05-.03-.08-.05-.08-.21,.05-.42,.05-.61,.05-.03,0-.03,.03-.03,.08-.13,2.34,.05,4.79,.92,8.31h-.37c-.97-3.71-1.16-6.1-1-8.37,0-.05-.03-.08-.03-.08-.18-.05-.34-.11-.5-.16-.03-.03-.03,0-.03,.05-.18,2-.05,4.18,.79,7.6,.11,.5,.13,.95,0,.95s-.37-.47-.5-1c-.87-3.63-.95-5.84-.74-7.81,0-.03,0-.08-.03-.08-.13-.11-.26-.21-.39-.32t-.03,.03c-.24,1.92-.21,4.16,.63,7.92,.13,.66,.16,1.26,0,1.26s-.42-.63-.55-1.37c-.79-4-.79-6.31-.53-8.24,.03-.03,0-.08,0-.08-.11-.13-.24-.26-.34-.39t-.03,.03c-.29,1.95-.37,4.39,.37,8.63,.13,.74,.16,1.42,0,1.42s-.42-.71-.53-1.5c-.66-4.45-.55-7-.21-9v-.11c-.11-.13-.21-.24-.32-.37,0,0-.03,.03-.03,.05-.39,2.29-.55,5.34,.26,10.92h-.37c-.74-5.68-.55-8.84-.16-11.18v-.08c-.11-.11-.21-.21-.32-.29,0,0-.03,.03-.03,.08-.37,2.24-.61,5.18-.16,10.1,.05,.74,.03,1.37-.11,1.37s-.29-.63-.34-1.37c-.34-4.95-.11-7.97,.26-10.29v-.08c-.13-.05-.24-.08-.37-.11-.03,0-.03,.03-.03,.08-.34,2.39-.61,5.42-.39,10.16,.05,.87-.03,1.6-.18,1.6s-.32-.71-.34-1.53c-.13-4.6,.13-7.68,.42-10.16,.03-.05,0-.08,0-.08-.16,.05-.29,.11-.45,.21-.03,0-.05,.05-.05,.11-.26,2.55-.5,5.66-.42,10,.03,.79-.08,1.45-.24,1.45s-.29-.61-.32-1.32c0-3.95,.18-7,.37-9.66,0-.05,0-.08-.03-.05-.18,.16-.37,.37-.58,.61-.03,.03-.03,.08-.05,.13-.11,3.03-.24,6.34-.21,10.29h-.45c0-.18-.03-.37-.03-.53-.05-1.21-.08-2.45-.08-3.71,.45-11.6,2.74-17.47,4.37-20.02-.08-.11-.11-.26-.11-.39v-10.68Z"/>
                    <path class="cls-2" d="M20.26,94.32v5.47l-1.97,.32v-5.79c0-.53,.45-.97,.97-.97h.03c.53,0,.97,.45,.97,.97Z"/>
                    <path class="cls-2" d="M20.26,94.32v5.47l-1.97,.32v-5.79c0-.53,.45-.97,.97-.97h.03c.53,0,.97,.45,.97,.97Z"/>
                    </g>
                </g>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" id="close" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
            </div>
            <h2 class="welcome"><span style="color: var(--blue); text-transform: capitalize;"><?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?></span></span></h2>
            <ul>
                <li>
                    <a href="./home.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                        </svg>
                        Tableau de bord
                    </a>
                </li><?php 
                    
                    if ( $_SESSION['statut'] == "Etudiant(e)" ) {
                        ?>
                        <li>
                            <a href="./ask.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                </svg>
                                Ma demande
                            </a>
                        </li>
                        <?php
                    }
                
                ?>
                
                <?php 
                    
                    if ( $_SESSION['statut'] == "Administrateur" ) {
                        ?>
                            <li>
                                <a href="./list.php?statut=en_cours" id="<?php if (isset($_GET['statut'])) { if ($_GET['statut'] == 'en_cours' && $_SESSION['statut'] != "Responsable") { echo 'active';}} ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-exclamation" viewBox="0 0 16 16">
                                        <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0z"/>
                                        <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z"/>
                                    </svg>
                                    Demande en attente
                                    <div id="notif">
                                        <?= $checkCandid->rowCount() ?>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="./list.php?statut=en_attente" id="<?php if (isset($_GET['statut'])) { if ($_GET['statut'] == 'en_attente' && $_SESSION['statut'] != "Responsable") { echo 'active';}} ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                    </svg>
                                    Demande Validée
                                </a>
                            </li>
                            <li>
                                <a href="./list.php?statut=suspendu" id="<?php if (isset($_GET['statut'])) { if ($_GET['statut'] == 'suspendu' && $_SESSION['statut'] != "Responsable") { echo 'active';}} ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                                        <path d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293z"/>
                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                                    </svg>
                                    Demande suspendue
                                </a>
                            </li>
                            <li>
                                <a href="./import.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                    </svg>
                                    Importation
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                    </svg>
                                    Paramètres
                                </a>
                            </li>
                        <?php
                    }
                
                ?>

                <?php 
                    
                    if ( $_SESSION['statut'] == "Commercial(e)" || $_SESSION['statut'] == "Responsable") {
                        ?>
                            <li>
                                <a href="./list.php?statut=en_attente" id="<?php if ($_SESSION['statut'] == "Responsable") { echo 'active';} ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                    Demande de stage
                                </a>
                            </li>
                            <li>
                                <a href="./job.php">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                                    </svg>
                                    Offres
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                    </svg>
                                    Paramètres
                                </a>
                            </li>
                        <?php
                    }
                
                ?>
                
            </ul>
            <a href="./php/logoutAction.php" id="deconnect">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
                Deconnexion
            </a>
        </div>
        <div class="content">
            <div class="item">
                <div class="label">
                    <div class="text">
                        <h3>DEMANDES <?php if (isset($title)) { echo $title;} else { echo ' ';} ?></h3>
                        <p>
                            Lorem ipsum dolor sit amet, 
                            consectetuer adipiscing elit, 
                            sed diam nonummy nibh euismod 
                            tincidunt ut laoreet 
                        </p>
                    </div>
                </div>
                <form class="filter" method="get">
                    <div class="check">    
                        <input type="hidden" name="statut" id="" value="<?php if (isset($_GET['statut'])) { echo $_GET['statut'];}?>">
                        <div class="other">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="bts">
                                <label class="form-check-label" for="flexSwitchCheckDefault">BTS</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="fq" name="fq">
                                <label class="form-check-label" for="fq">Formation qualifiante</label>
                            </div>
                        </div>
                        <div class="group">
                            <select name="classe" class="form-select" aria-label="Default select example" style="font-size: 12px;">

                                <option value="">Veuillez selectionez la classe</option>

                                <?php

                                    while ($classe = $selectClasse->fetch()) {
                                        ?>
                                            <option value="<?= $classe['code'] ?>"><?= $classe['nom'] ?> (<?= $classe['code'] ?>)</option>
                                        <?php
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="group">
                            <input name="matricule" class="form-control" placeholder="Entrez le matricule de l'étudiant(e)" style="font-size: 12px; margin-top: 5px;">
                        </div>
                    </div>
                    <button type="submit" class="btn gold" id="importation" name="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16">
                            <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                        </svg>
                        <p>Filtrer</p>
                    </button>
                </form>
                <?php 
                
                if (isset($_GET['success'])) {
                    ?>
                        <div class="msg">Votre demande a été bien enregistrée !</div>
                    <?php
                }
                
                ?>
                <div class="bootstrap-table">
                <table class="table table-striped table-bordered">
                <?php

                if ($checkCandidates->rowCount() > 0) {

                    ?>

                <thead>
                    <tr>
                        <td>
                            Matricule
                        </td>
                        <td>
                            Nom
                        </td>
                        <td>
                            Prénoms
                        </td>
                        <td>
                            Classe
                        </td>
                        <td>
                            Date de poste
                        </td>
                        <td  style="text-align: end;">
                            Action
                        </td>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php

                        while ($poste = $checkCandidates->fetch()) {

                            $checkStudents = $bd->prepare('SELECT * FROM etudiant WHERE id = ?');
                            $checkStudents->execute(array($poste['id_etudiant']));

                            $etudiant = $checkStudents->fetch();
                            ?>
                            
                        <tr>
                            <td>
                                <?= $etudiant['matricule'] ?> 
                            </td>
                            <td>
                                <?= $etudiant['nom'] ?> 
                            </td>
                            <td>
                                <?= $etudiant['prenom'] ?> 
                            </td>
                            <td>
                                <?= $etudiant['classe'] ?> 
                            </td>
                            <td>
                                <?= $poste['date'] ?>
                            </td>
                            <td  style="text-align: end;">
                                <?php
                                
                                    if ($_SESSION['statut'] != "Responsable") {
                                        ?>
                                            <a href="./validate.php?id=<?= $etudiant['id'] ?>" class="btn">Valider la demande</a>
                                        <?php
                                    }else{
                                        ?>
                                            <a href="./validate.php?id=<?= $etudiant['id'] ?>" class="btn">Attribuer</a>
                                        <?php
                                    }

                                ?>
                            </td>
                            
                        </tr>
                        
                    
                        <?php

                        }
                    ?>

                </tbody>
                <?php
                        
                    }else {
                        ?>
                            <tbody>
                                <tr>
                                    <td>
                                        Aucunes demandes Validées
                                    </td>
                                    <td style="text-align: end;">
                                         
                                    </td>
                                </tr>
                            </tbody>
                        <?php
                    }

                ?>
                </table>
                </div>
            </div>
            <div class="item foot">
                <div class="text">
                    <div class="">
                        <h2>Contacts</h2>
                        <strong>Téléphone:</strong> (+225) 22 01 94 58 / 07 57 25 15 42 <br>
                        <strong>Email:</strong> infos@ifsm.ci <br>
                        <strong>Adresse:</strong> IFSM COCODY <br>
                        <strong>Adresse postale:</strong> IFSM COCODY, Ilot 18, Abidajn, Côte d'ivoire
                    </div>
                    <div class="">
                        <h2>À propos</h2>
                        L’institut de Formation Sainte Marie est un établissement 
                        d’enseignement supérieur et professionnel agréé par 
                        l’État de Côte d’ivoire à qui appartient iStage, application
                        utilisée pour la gestion de ses stages.
                    </div>
                    <div class="">
                        <h2>Partenaires</h2>
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, 
                        sed diam nonummy nibh euismod tincidunt ut laoreet dolore 
                        magna aliquam erat volutpat. Ut wisi enim ad 
                    </div>
                </div>
                <p>Copyright2024 created by IFSM</p>
            </div>
        </div>
    </section>
    <script src="./js/app.js"></script>
    <script>
        const button = document.querySelector('button#importation');
        button.addEventListener('click', () => {
            button.blur(); // Supprime le focus du bouton après le clic
        });
    </script>
</body>
</html>