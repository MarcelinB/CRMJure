<?php
//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°//
//°°°°°°°°°°°°°°°°°°°°°°°°°°° CONTROLEUR CONTACTS °°°°°°°°°°°°°°°°°°°°°°°°°°°//
//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°//
require_once('../class/Crmjure.class.php');
require_once('../class/Contact.class.php');
class ContactMgr {
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getListContacts()//
//  Retourne un tableau de la liste complète des contacts.
    public static function getListContacts() : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM contact ORDER BY ID_Contact ASC';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->query($sqlRequest);
    //  Lit le retour de la requête. 
        $displayRequest = $launchRequest->fetchAll();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    //  Retourne le tableau.
        return $displayRequest;
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getContactById()//
//  Retourne un contact avec l'identifiant donné en paramètre.
    public static function getContactById($paramId) : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM contact WHERE ID_Contact = ?';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramId));
    //  Lit le retour de la requête. 
        $displayRequest = $launchRequest->fetch();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    //  Retourne le tableau.
        return $displayRequest;
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getContactsByName()//
//  Retourne un tableau de contact(s) avec le nom donné en paramètre.
    public static function getContactsByName($paramNom) : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM contact WHERE Nom LIKE :nom';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array(':nom'=>'%'.$paramNom.'%'));
    //  Lit le retour de la requête. 
        $displayRequest = $launchRequest->fetchAll();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    //  Retourne le tableau.
        return $displayRequest;
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°addContact()//
//  Ajoute le contact donné en paramètre.
    public static function addContact(  $paramNewNom, $paramNewPrenom, 
                                        $paramNewAdresse, $paramNewTelephone, 
                                        $paramNewPortable, $paramNewMail) {
    //  Prépare requête SQL.
        $sqlRequest = 'INSERT INTO `contact`
                (`Nom`, `Prénom`, `Adresse`, `Téléphone`, `Portable`, `Mail`) 
        VALUES  (:nom, :prenom, :adresse, :tel, :port, :mail)';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array( 
                ':nom'=>$paramNewNom, ':prenom'=>$paramNewPrenom, 
                ':adresse'=> $paramNewAdresse, ':tel'=>$paramNewTelephone, 
                ':port'=>$paramNewPortable, ':mail'=> $paramNewMail));
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°deleteContactById()//
//  Supprime le contact dont l'identifiant est donné en paramètre.
    public static function deleteContactById(int $paramIdContact) : int {
    //  Prépare requête SQL.
        $sqlRequest = 'DELETE FROM `contact` WHERE ID_Contact=?';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramIdContact));
    //  Compte le nombre de contacts supprimés. 
        $count = $launchRequest->rowCount();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    //  Retourne le tableau.
        return $count;
    }

//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°updateContact()//
//  Modifie le contact donné en paramètre.
    public static function updateContact(   $idContactToUpd, $paramUpdNom, 
                                            $paramUpdPrenom, $paramUpdAdresse, 
                                            $paramUpdTéléphone, $paramUpdPortable, 
                                            $paramUpdMail) {
    //  Prépare requête SQL.
        $sqlRequest = 'UPDATE contact SET 
            Nom=:newNom, Prénom=:newPrenom, Adresse=:newAdresse, 
            Téléphone=:newTelephone, Portable=:newPortable, 
            Mail=:newMail WHERE ID_Contact=:oldContactId';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array(
                                ':newNom'=>$paramUpdNom, ':newPrenom'=>$paramUpdPrenom, 
                                ':newAdresse'=>$paramUpdAdresse, ':newTelephone'=>$paramUpdTéléphone, 
                                ':newPortable'=>$paramUpdPortable, ':newMail'=>$paramUpdMail, 
                                ':oldContactId'=>$idContactToUpd));
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
        Crmjure::disconnect();
    }
}








?>