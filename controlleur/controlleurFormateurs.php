<?php
session_start();
if ($_SESSION['droit'] == 1)
{
spl_autoload_register(function($classe){
    include "../class/" . $classe . ".class.php";
}); 

if (isset($_POST['action'])) {
    $action = $_POST['action'];
}
// echo $action;

switch($action) {
//  AFFICHE LA PAGE PRINCIPALE CONTENANT LA LISTE DES FORMATEURS
    case 'afficheListeFormateurs' :
        require('../vues/ListeFormateurs.vue.php');
    break;
//  AFFICHE LA PAGE DE VALIDATION DE SUPPRESION D'UN FORMATEUR
    case 'deleteFormateur' :
        $idForm = $_POST['idFormateur'];
        FormateurMgr::deleteFormateurByID($idForm);
        require('../vues/deleteFormateur.vue.php');
    break;
//  AFFICHE LA PAGE DE MODIFICATION D'UN FORMATEUR
    case 'modifierFormateur' :
        require('../vues/modFormateur.vue.php');
    break;
//  AFFICHE LA PAGE DE VALIDATION DE MODIFICATION D'UN FORMATEUR
    case 'validationModif' :
        $idContactToUpd = $_POST['idContact'];
        $paramUpdNom = $_POST['nouveauNom'];
        $paramUpdPrenom = $_POST['nouveauPrenom'];
        $paramUpdAdresse = $_POST['nouvelleAdresse'];
        $paramUpdTéléphone = $_POST['nouveauTel'];
        $paramUpdPortable = $_POST['nouveauPort'];
        $paramUpdMail = $_POST['nouveauMail'];
        $idFormateurToUpd = $_POST['idFormateur'];
        $paramLibelle_metier = $_POST['formationSelected'];
        if ((FormateurMgr::controlDoublon($paramUpdMail) > 0) AND ($paramUpdMail <> $_POST['oldMailContact'])) {
            require('../vues/erreurDoublonAjout.vue.php');
        } else {
            FormateurMgr::updateFormateur(  $idContactToUpd, $paramUpdNom,
                                            $paramUpdPrenom, $paramUpdAdresse, 
                                            $paramUpdTéléphone, $paramUpdPortable, 
                                            $paramUpdMail, $idFormateurToUpd, 
                                            $paramLibelle_metier);
                                            require('../vues/validationModif.vue.php');
        }
    break;
//  AFFICHE LA PAGE D'AJOUT D'UN FORMATEUR
    case 'ajouterFormateur' :
        require('../vues/addFormateur.vue.php');
    break;
//  AFFICHE LA PAGE DE VALIDATION D'AJOUT D'UN FORMATEUR OU REDIRIGE VERS UNE PAGE D'ERREUR
    case 'validationAjout' :
        $paramNomContact = $_POST['nouveauNom'];
        $paramPrenomContact = $_POST['nouveauPrenom'];
        $paramAdresseContact = $_POST['nouvelleAdresse'];
        $paramTelContact = $_POST['nouveauTel'];
        $paramPortContact = $_POST['nouveauPort'];
        $paramMailContact = $_POST['nouveauMail'];
        $paramLibelle_metier = $_POST['formationSelected'];
        if (FormateurMgr::controlDoublon($paramMailContact) > 0) {
            header('location:../vues/erreurDoublonAjout.vue.php');
        } else {
            FormateurMgr::addFormateur( $paramNomContact, $paramPrenomContact, 
                                        $paramAdresseContact, $paramTelContact, 
                                        $paramPortContact, $paramMailContact, 
                                        $paramLibelle_metier);
        }
        require('../vues/validationAjoutFormateur.vue.php');
    break;
//  AFFICHE LA PAGE DE RESULTAT(S) D'UNE RECHERCHE D'UN FORMATEUR PAR NOM
    case 'rechercherFormateur' :
        require('../vues/rechercherFormateur.vue.php');
    break;
}




}else header("Location: ../Index.php");
?>