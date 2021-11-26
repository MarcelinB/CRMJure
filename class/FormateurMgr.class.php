<?php
//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°//
//°°°°°°°°°°°°°°°°°°°°°°°°°°° MANAGER FORMATEURS °°°°°°°°°°°°°°°°°°°°°°°°°°°°//
//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°//
require_once('../class/Crmjure.class.php');
require_once('../class/Formateur.class.php');
require_once('../class/Contact.class.php');


class FormateurMgr {
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getListContacts()//
//  Retourne un tableau de la liste complète des contacts.
    public static function getListFormateurs() : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT fm.ID_Formateur, ct.ID_Contact, ct.Nom, ct.Prénom, 
        ct.Adresse, ct.Téléphone, ct.Portable, fm.Libéllé_Métier, ct.Mail 
        FROM `formateur` fm
        INNER JOIN contact ct ON ct.ID_Contact = fm.ID_Contact';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->query($sqlRequest);
    //  Lit le retour de la requête. 
        $launchRequest->setFetchMode(PDO::FETCH_ASSOC);
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
    public static function getFormateurById(int $paramId) : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM formateur WHERE ID_Formateur = ?';
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
    public static function getFormateursByName($paramNom) : array {
        //  Prépare requête SQL.
        $sqlRequest = ' SELECT fm.ID_Formateur, ct.ID_Contact, ct.Nom, fm.Libéllé_Métier, ct.Prénom, ct.Mail, ct.Adresse, ct.Téléphone, ct.Portable 
        FROM formateur fm
        INNER JOIN contact ct ON fm.ID_Contact = ct.ID_Contact
        WHERE ct.Nom LIKE "%"?"%"';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramNom));
    //  Lit le retour de la requête. 
        $displayRequest = $launchRequest->fetchAll();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    //  Retourne le tableau.
        return $displayRequest;
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°addFormateur()//
//  Ajoute un contact puis un formateur.
    public static function addFormateur($paramNomContact, 
                                        $paramPrenomContact, $paramAdresseContact,
                                        $paramTelContact, $paramPortContact, 
                                        $paramMailContact, $paramLibelle_metier) {
    //  Exécute la fonction addContact depuis la classe parente Contact.
        require_once('../class/ContactMgr.class.php');
        ContactMgr::addContact( $paramNomContact, 
                                $paramPrenomContact, $paramAdresseContact,
                                $paramTelContact, $paramPortContact, 
                                $paramMailContact);
        $connexionPDO = Crmjure::getConnexion();
    //  Prépare requête SQL.
        $sqlRequest = 'INSERT INTO formateur    (Libéllé_Métier, ID_Contact) VALUES 
                                                (:newMetier, (SELECT MAX(ID_Contact) from contact))';
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array(':newMetier'=>$paramLibelle_metier));
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    }    
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°deleteFormateurById()//
//  Supprime le formateur dont l'identifiant est donné en paramètre.
    public static function deleteFormateurByID(int $paramIdContact) {
    //  Prépare requête SQL.
        $sqlRequest = 'DELETE FROM `formateur` WHERE ID_Formateur=?';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramIdContact));
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°updateFormateur()//
//  Modifie un contact puis un formateur.
    public static function updateFormateur( $idContactToUpd, $paramUpdNom, 
                                            $paramUpdPrenom, $paramUpdAdresse,
                                            $paramUpdTéléphone, $paramUpdPortable, 
                                            $paramUpdMail, $idFormateurToUpd, $paramLibelle_metier) {
    //  Exécute la fonction addContact depuis la classe parente Contact.
    require_once('../class/ContactMgr.class.php');
    ContactMgr::updateContact(  $idContactToUpd, $paramUpdNom, 
                                $paramUpdPrenom, $paramUpdAdresse, 
                                $paramUpdTéléphone, $paramUpdPortable, 
                                $paramUpdMail);
    $connexionPDO = Crmjure::getConnexion(); 
    //  Prépare requête SQL.
    $sqlRequest = 'UPDATE formateur SET 
        Libéllé_Métier=:newMetier WHERE ID_Formateur=:oldFormateurId';
    //  Lance la requête.
    $launchRequest = $connexionPDO->prepare($sqlRequest);
    $launchRequest->execute(array(':newMetier'=>$paramLibelle_metier, ':oldFormateurId'=>$idFormateurToUpd));
    //  Réinitialise le curseur.
    $launchRequest->closeCursor();
    //  Ferme la connexion.
    Crmjure::disconnect();
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°deleteFormateurById()//
//  Supprime le formateur avec l'id donné en paramètre.
    public static function deleteFormaById($paramIdFormateur) {
    //  Prépare requête SQL.
        $sqlRequest = 'DELETE FROM `formateur` WHERE ID_Formateur=?';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramIdFormateur));
    //  Compte le nombre de contacts supprimés. 
        $count = $launchRequest->rowCount();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    }
    //  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°controlDoublon()//
//  Contrôle et refuse les doublons dans la table contact 
    public static function controlDoublon($paramMail) : int {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM contact WHERE Mail=?';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramMail));
    //  Compte le nombre de retours de la requêtes. 
        $count = $launchRequest->rowCount();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
        return $count;
    }
}


?>