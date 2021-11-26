<?php
    require ('../class/Crmjure.class.php');

    class Utilisateur_Manager
    {
        public static function getListUtilisateur()
        {
            $PDOconnexion = Crmjure::getConnexion();
           
            $rqtSQL = 'SELECT * FROM utilisateur';
            
            $repPDO = $PDOconnexion->query($rqtSQL);
            $repPDO->setFetchMode(PDO::FETCH_ASSOC);
            $records = $repPDO->fetchAll();
            return $records;
        }
    }
?>