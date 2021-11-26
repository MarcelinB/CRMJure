<?php
    require ('../class/Crmjure.class.php');

    class Formation_Session_Manager
    {
        public static function getListSessionFormations() 
        // Fonction permettant de retourner un tableau avec les différentes sessions de formation 
        // IN : 
        // OUT : Tableau associatif                                       
        {
            $PDOconnexion = Crmjure::getConnexion();
           
            $rqtSQL = 'SELECT sf.ID_Session, sf.ID_Formateur, sf.ID_Formation, sf.Libéllé_Session_de_Formation, f.Libéllé_Formation, ct.Prénom, ct.Nom, sf.date_debut, sf.date_fin
            FROM session_de_formation sf
            INNER JOIN formation f ON f.ID_Formation = sf.ID_Formation
            INNER JOIN formateur fm ON sf.ID_Formateur = fm.ID_Formateur
            INNER JOIN contact ct ON fm.ID_Contact = ct.ID_Contact';
            
            $repPDO = $PDOconnexion->query($rqtSQL);
            $repPDO->setFetchMode(PDO::FETCH_ASSOC);
            $records = $repPDO->fetchAll();
            return $records;
        }
        public static function getSessionByName($nom)
        // Fonction permettant de retourner un tableau avec les différentes sessions de formation en fonction d'une recherche par nom
        // IN : Le nom recherché par l'utilisateur
        // OUT : Tableau associatif
        {
            $PDOconnexion = Crmjure::getConnexion();
            
            $rqtSQL = 'SELECT sf.Libéllé_Session_de_Formation, f.Libéllé_Formation, ct.Prénom, ct.Nom, sf.date_debut, sf.date_fin
            FROM session_de_formation sf
            INNER JOIN formation f ON f.ID_Formation = sf.ID_Formation
            INNER JOIN formateur fm ON sf.ID_Formateur = fm.ID_Formateur
            INNER JOIN contact ct ON fm.ID_Contact = ct.ID_Contact
           
            WHERE sf.Libéllé_Session_de_Formation LIKE :nom';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':nom'=>'%' . $nom . '%'));
            $records = $repPDO->fetchAll();
            return $records;
        }
        public static function addSessionFormation($libéllé, $idformateur, $datedebut, $datefin, $idformation)
        // Fonction permettant d'ajouter une session de formation dans la BDD
        // IN : Le nouveau nom, l'id du formateur(clé primaire), la date de début, la date de fin, l'id du type de formation 
        //      correspondante(clé primaire)
        // OUT : 
        {
            $PDOconnexion = Crmjure::getConnexion();
            
            $rqtSQL = 'INSERT INTO `session_de_formation`(`Libéllé_Session_de_Formation`, 
            `ID_Formateur`, `date_debut`, `date_fin`, `ID_Formation`) 
            VALUES (:libsess, :idform, :datedebut, :datefin, :idform)';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':libsess'=>$libéllé, ':idform'=>$idformateur, 
            ':datedebut'=>$datedebut,':datefin'=>$datefin, 'idform'=>$idformation));
            
        }
        public static function deleteSessionFormation($id)
        // Fonction permettant de supprimer une session de formation dans la BDD
        // IN : l'ID de la session à supprimer
        // OUT : 
        {
            $PDOconnexion = Crmjure::getConnexion();
            $rqtSQL = 'DELETE FROM session_de_formation WHERE ID_Session = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id));
            echo 'Supression réussie';

        }
        public static function updateSessionFormation($id, $libéllé, $idformateur, $datdeb, $datefin, $idformation)
        {
            // Fonction permettant de modifier une session de formation dans la BDD
        // IN : L'ID de la session à modifier, le nouveau nom, l'id du formateur(clé primaire), la date de début, 
        //      la date de fin, l'id du type de formation correspondante(clé primaire)
        // OUT : 
            $PDOconnexion = Crmjure::getConnexion();
            $rqtSQL = 'UPDATE `session_de_formation` 
            SET Libéllé_Session_de_Formation = :lib, ID_Formateur = :idform, date_debut = :datedeb, date_fin = :datefin, 
            ID_Formation = :idformation WHERE ID_Session = :id';
            $repPDO = $PDOconnexion->prepare($rqtSQL);
            $repPDO->execute(array(':id'=>$id, ':lib'=>$libéllé, ':idform'=>$idformateur, ':datedeb'=> $datdeb, ':datefin'=> $datefin,
            ':idformation'=>$idformation));

            echo 'Modification effectuée !';
        }
        
    }


?>