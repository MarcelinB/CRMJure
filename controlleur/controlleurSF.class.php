<?php
session_start();
// var_dump($_SESSION);

if ($_SESSION['droit'] == 1)
{

spl_autoload_register(function($classe){
    include "../class/" . $classe . ".class.php";
}); 
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
else $action = 'afficheSessionForm';

// $action = 'afficheSessionForm';
// echo $action;
switch($action){
    case 'afficheSessionForm' :
        require('../vues/SessionFormation.vues.php');
        break;
    case 'rechercher' :
        require('../vues\UniqueSessionFormation.vues.php');
        $idSession = $_POST['recherche'];
        break;
    case 'delSessionForm' :
        
        $infoID = $_POST['idsession'];
        Formation_Session_Manager::deleteSessionFormation($infoID);
        require('../vues/deleteSession.vue.php');
        break;
    case 'modSessionForm' :
// var_dump($_POST);
        $infoID = $_POST['idsession'];
        $infoLib = $_POST['Libéllé_Session_de_Formation'];
        $infometier = $_POST['libsession'];
        $infodeb = $_POST['datedeb'];
        $infofin = $_POST['datefin'];
        require('../vues/modSession.vue.php');
        break;
    case 'ajouter' : 
        require('../vues\ajouterSession.vue.php');
        break;
    case 'ajout2' :
        require('../vues\ajouterSession2.vue.php');
        break;
    case 'ajout3' :
        require('../vues\ajouterSession3.vue.php');
        break;
    case 'modifier2' :
    require('../vues\modSession2.vue.php');
    break;
        }
    } else header("Location: ../Index.php");
?>