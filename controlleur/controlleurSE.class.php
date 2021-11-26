<?php

spl_autoload_register(function($classe){
    include "../class/" . $classe . ".class.php";
}); 
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
// $action = 'afficheSessionForm';
echo $action;
switch($action){
    case 'afficheExamForm' :
        require('../vues/SessionExamen.vues.php');
        break;
        }
?>