<?php
    require ('../class\Crmjure.class.php');

    class Formation_Manager
    {
        public static function getListFormations()
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'SELECT * FROM formation';
            $repPDO = $PDOconnexion->query($rqtSQL);
            $repPDO->setFetchMode(PDO::FETCH_ASSOC);
            $records = $repPDO->fetchAll();
            return $records;
        }
        public static function getFormationByName($nom)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'SELECT * FROM formation WHERE Libéllé_Formation LIKE :nom';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':nom'=> '%' . $nom . '%'));
            $records = $repPDO->fetchAll();
            return $records;
        }
        public static function addFormation($id, $libéllé)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'INSERT INTO formation(ID_Formation, Libéllé_Formation) VALUES (:id, :libelle)';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id, ':libelle'=>$libéllé));
            echo 'Formation ' . $libéllé . ' ID : ' . $id . ' ajoutée';
        }

        public static function deleteFormation($id)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'DELETE FROM formation WHERE ID_FORMATION = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id));
            echo 'Supression réussie';

        }
        public static function updateFormation($id, $libéllé)
        {
            $PDOconnexion = Crmjure::getConnexion();
            echo 'Connexion réussie !';
            $rqtSQL = 'UPDATE formation SET Libéllé_Formation = :libelle WHERE ID_FORMATION = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id, ':libelle'=>$libéllé));

            echo 'Modification effectuée !';
        }
    }


?>