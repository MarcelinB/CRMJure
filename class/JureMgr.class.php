<?php
//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°//
//°°°°°°°°°°°°°°°°°°°°°°°°°°° CONTROLEUR FORMATEURS °°°°°°°°°°°°°°°°°°°°°°°°°°°//
//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°//
require_once('modele/Crmjure.class.php');
require_once('modele/Jure.class.php');
require_once('modele/Contact.class.php');

class JureMgr {
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getListJures()//
//  Retourne un tableau de la liste complète des contacts.
    public static function getListJures() : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM jure ORDER BY ID_Juré ASC';
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
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getJureById()//
//  Retourne un contact avec l'identifiant donné en paramètre.
    public static function getJureById(int $paramId) : array {
    //  Prépare requête SQL.
        $sqlRequest = 'SELECT * FROM jure WHERE ID_Juré = ?';
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
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°getJuresByName()//
//  Retourne un tableau de contact(s) avec le nom donné en paramètre.
    public static function getJuresByName($paramNom) : array {
    //  Prépare requête SQL.
        $sqlRequest = ' SELECT jr.Libéllé_Profession, ct.Nom, ct.Prénom FROM jure jr
                        INNER JOIN contact ct ON jr.ID_Contact = ct.ID_Contact
                        WHERE ct.Nom LIKE :paramNom';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array(':paramNom'=>$paramNom));
    //  Lit le retour de la requête. 
        $displayRequest = $launchRequest->fetchAll();
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    //  Retourne le tableau.
        return $displayRequest;
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°addJure()//
//  Ajoute le contact donné en paramètre.
    public static function addJure( $paramNomContact, 
                                    $paramPrenomContact, $paramAdresseContact,
                                    $paramTelContact, $paramPortContact, 
                                    $paramMailContact, $paramLibelle_profession, $paramIdEntreprise){
    //  Exécute la fonction addContact depuis la classe parente Contact.
        require_once('modele/ContactMgr.class.php');
        ContactMgr::addContact( $paramNomContact, $paramPrenomContact, 
                                $paramAdresseContact,$paramTelContact, 
                                $paramPortContact, $paramMailContact);
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Prépare requête SQL.
        $sqlRequest = ' INSERT INTO jure  (Libéllé_Profession, ID_entreprise, ID_Contact) 
                        VALUES (:newProfession, :newEntreprise ,(SELECT MAX(ID_Contact) from contact))';
    //  Lance la requête.                                       
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array(':newProfession'=>$paramLibelle_profession, ':newEntreprise'=>$paramIdEntreprise));
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°deleteJureById()//
//  Supprime le contact dont l'identifiant est donné en paramètre.
    public static function deleteJureByID(int $paramIdJure) {
    //  Prépare requête SQL.
        $sqlRequest = 'DELETE FROM `jure` WHERE ID_Juré=?';
    //  Génère la connexion à la base de données.
        $connexionPDO = Crmjure::getConnexion();
    //  Lance la requête.
        $launchRequest = $connexionPDO->prepare($sqlRequest);
        $launchRequest->execute(array($paramIdJure));
    //  Réinitialise le curseur.
        $launchRequest->closeCursor();
    //  Ferme la connexion.
        Crmjure::disconnect();
    }
//  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°updateContact()//
//  Modifie le contact donné en paramètre.
    public static function updateJure(  $idContactToUpd, $paramUpdNom, 
                                        $paramUpdPrenom, $paramUpdAdresse,
                                        $paramUpdTéléphone, $paramUpdPortable, 
                                        $paramUpdMail, $idJureToUpd, $paramLibelle_metier, $paramIdEntreprise) {
    //  Exécute la fonction addContact depuis la classe parente Contact.
        require_once('modele/ContactMgr.class.php');
        ContactMgr::updateContact(  $idContactToUpd, $paramUpdNom, 
                                    $paramUpdPrenom, $paramUpdAdresse, 
                                    $paramUpdTéléphone, $paramUpdPortable, 
                                    $paramUpdMail);
        $connexionPDO = Crmjure::getConnexion(); 
        //  Prépare requête SQL.
        $sqlRequest = 'UPDATE jure SET 
            Libéllé_Profession=:newMetier, ID_Entreprise=:newEntreprise WHERE ID_Juré=:oldJureId';
        $launchRequest = $connexionPDO->prepare($sqlRequest);

        $launchRequest->execute(array(':newMetier'=>$paramLibelle_metier, ':newEntreprise'=>$paramIdEntreprise, ':oldJureId'=>$idJureToUpd));
        $launchRequest->closeCursor();
        Crmjure::disconnect();
    }
    //  °°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°deleteFormateurById()//
    public static function deleteFormaById(int $paramIdFormateur) : int {
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
        //  Retourne le tableau.
            return $count;
    }

}


?>