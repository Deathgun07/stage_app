<?php

require('./db.php');

$selectSection = $bd->query('SELECT * FROM section');
$selectClasse = $bd->query('SELECT * FROM classe');

?>