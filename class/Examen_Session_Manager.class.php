<?php
    require ('../class/Crmjure.class.php');

    class Examen_Session_Manager
    {
        public static function getListSessionExamens()
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'SELECT sd.Libéllé_Session_Examen, sf.Libéllé_Session_de_Formation, dt.Date_Début, dt.Date_Fin FROM session_d_examen sd 
            INNER JOIN session_de_formation sf ON sd.ID_Session = sf.ID_Session
            INNER JOIN d_ate dt ON sd.ID_Session = dt.id_Date';
            $repPDO = $PDOconnexion->query($rqtSQL);
            $repPDO->setFetchMode(PDO::FETCH_ASSOC);
            $records = $repPDO->fetchAll();
            return $records;
        }
        public static function getSessionByName($nom)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'SELECT sd.Libéllé_Session_Examen, sf.Libéllé_Session_de_Formation, dt.Date_Début, dt.Date_Fin FROM session_d_examen sd 
            INNER JOIN session_de_formation sf ON sd.ID_Session = sf.ID_Session
            INNER JOIN d_ate dt ON sd.ID_Session = dt.id_Date
            WHERE :nom LIKE Libéllé_Session_Examen';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':nom'=>$nom));
            $records = $repPDO->fetchAll();
            return $records;
        }
        public static function addSessionExamen($libéllé, $idsess, $iddate)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'INSERT INTO `session_d_examen`(`Libéllé_Session_Examen`, 
            `ID_Session`, `id_Date`) 
            VALUES (:libexam, :idsess, :iddate)';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array( ':libexam'=>$libéllé, ':idsess'=>$idsess, 
            ':iddate'=>$iddate));
            echo 'Examen ' . $libéllé .' ajouté';
        }
        public static function deleteSessionExamen($id)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'DELETE FROM session_d_examen WHERE ID_Session_Examen = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id));
            echo 'Supression réussie';

        }
        public static function updateSessionExamen($id, $libéllé, $idsession, $iddate)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'UPDATE `session_d_examen` 
            SET Libéllé_Session_Examen = :lib, ID_Session = :idsess, id_Date = :iddate 
            WHERE ID_Session_Examen = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id, ':lib'=>$libéllé, ':idsess'=>$idsession, ':iddate'=> $iddate));

            echo 'Modification effectuée !';
        }
        
    }


?>