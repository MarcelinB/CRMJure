<?php
// Fonction permettant la deconnexion. Revoie sur l'index et
//ecrase les données en $_POST
session_start();
session_destroy();
header('location: ../Index.php');
exit;
?>