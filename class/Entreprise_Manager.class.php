<?php
    require ('class\Crmjure.class.php');

    class Entreprise_Manager
    {
        
        public static function addEntreprise($id, $nom, $adresse, $tel, $port, $mail)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'INSERT INTO `entreprise`(`ID_Entreprise`, 
            `Nom`, `Adresse`, `Téléphone`, `Portable`, `Mail`) 
            VALUES (:id, :nom, :adresse, :tel, :port, :mail)';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array( ':id'=>$id, ':nom'=>$nom, 
            ':adresse'=>$adresse, ':tel'=>$tel, ':port'=>$port, ':mail'=>$mail));
            echo 'Entreprise ' . $nom .' ajoutée';
        }
        public static function deleteEntreprise($id)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'DELETE FROM entreprise WHERE ID_Entreprise = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id));
            echo 'Supression réussie';

        }
        public static function updateEntreprise($id, $nom, $adresse, $tel, $port, $mail)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'UPDATE `entreprise` 
            SET Nom = :nom, Adresse = :adresse, Téléphone = :tel,  Portable = :port, Mail = :mail
            WHERE ID_Entreprise = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array( ':id'=>$id, ':nom'=>$nom, 
            ':adresse'=>$adresse, ':tel'=>$tel, ':port'=>$port, ':mail'=>$mail));

            echo 'Modification effectuée !';
        }
        
    }


?>