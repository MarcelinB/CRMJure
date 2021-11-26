<?php
    require ('class\Crmjure.class.php');

    class Date_Manager
    {
        public static function addDate($datedebut, $datefin)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'INSERT INTO d_ate(Date_Début, Date_Fin) VALUES (:debut, :fin)';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':debut'=>$datedebut, ':fin'=>$datefin));
            echo 'Date ajoutée ';
        }
        public static function updateDate($id, $datedebut, $datefin)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'UPDATE d_ate SET Date_Début = :debut, Date_Fin = :fin WHERE id_Date = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id, ':debut'=>$datedebut, ':fin'=>$datefin));

            echo 'Modification effectuée !';
        }
    }

?>