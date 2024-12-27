<?php

require('./db.php');

if (!isset($_SESSION['statut'])) {

    header('location: ./index.php');

}

?>