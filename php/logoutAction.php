<?php

session_start();

require('../db.php');

$_SESSION = [];

session_destroy();



header('location: ../index.php');

?>