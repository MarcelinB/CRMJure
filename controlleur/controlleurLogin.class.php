<?php
spl_autoload_register(function($classe){
    include "../class/" . $classe . ".class.php";
}); 
if ((isset($_POST['identifiant'])) AND isset($_POST['mdp'])) {
    $identifiant = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
}

$connexion = 0;

$util = Utilisateur_Manager::getListUtilisateur();
// var_dump($util);
for ($i = 0; $i<count($util); $i++)
{
    if (($_POST['identifiant'] == $util[$i]['Identifiant'])AND ($_POST['mdp'] ==$util[$i]['Mot_de_passe']))
    {
        $connexion = $util[$i]['Droit'];
    }
    else header("Location: ../Index.php");
    
}


switch($connexion){
    case 1 :
        
        session_start();
        $_SESSION['log'] = $_POST['identifiant'];
        $_SESSION['droit'] = 1;
        header("Location: ../Acceuil.php");
        break;
    case 2 : 
        session_start();
        $_SESSION['log'] = $_POST['identifiant'];
        $_SESSION['droit'] = 2;
        header("Location: ../vues\accform.vues.php");
        break;
        
}

?>