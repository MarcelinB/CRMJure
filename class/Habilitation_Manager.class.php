<?php
    require ('class\Crmjure.class.php');

    class Habilitation_Manager
    {
        
        public static function addHabilitation($debut, $fin, $valce, $ceres, $idjure, $idform)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'INSERT INTO `habilitation`(`Date_de_début`, 
            `Date_de_fin`, `VALCE_`, `CERES`, `ID_Juré`, `ID_Formation`) 
            VALUES (:debut, :fin, :valce, :ceres, :idjure, :idform)';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array( ':debut'=>$debut, ':fin'=>$fin, 
            ':valce'=>$valce, ':ceres'=>$ceres, ':idjure'=>$idjure, ':idform'=>$idform));
            echo 'Habilitation ajoutée ';
        }
        public static function deleteHabilitation($id)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'DELETE FROM habilitation WHERE ID_Habilitation = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id));
            echo 'Supression réussie';

        }
        public static function updateSessionExamen($id, $debut, $fin, $valce, $ceres, $idjure, $idform)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'UPDATE `habilitation` 
            SET Date_de_début = :debut, Date_de_fin = :fin, VALCE_ = :valce, CERES = :ceres, ID_Juré = :idjure, ID_Formation = :idform
            WHERE ID_Habilitation = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id, ':debut'=>$debut, ':fin'=>$fin, ':valce'=> $valce, ':ceres'=>$ceres, ':idjure'=>$idjure, ':idform'=>$idform));

            echo 'Modification effectuée !';
        }
        
    }


?>