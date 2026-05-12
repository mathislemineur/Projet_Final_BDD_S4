<?php

session_start();

// ca devient vide
$_SESSION = array();

session_destroy();

header("Location: ../index.php");
exit();
?>