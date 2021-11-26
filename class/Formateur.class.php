<?php
//***************************************************************************//
//*************************** CLASSE FORMATEURS *****************************//
//***************************************************************************//
class Formateur extends Contact {
//  DONNEES MEMBRES *********************************************************// 
    public $libelle_metier;
//  CONSTRUCTEUR ************************************************************// 
    public function __construct(
                                string $paramNom,
                                string $paramPrenom,
                                string $paramAdresse,
                                string $paramTelephone,
                                string $paramPortable,
                                string $paramMail, 
                                string $paramLibelle_metier) {
        parent::__construct($paramNom, $paramPrenom, $paramAdresse,
                            $paramTelephone, $paramPortable,
                            $paramMail);

        $this->setLibelleMetier($paramLibelle_metier);
    }
//  SETTERS *****************************************************************// 
    public function setLibelleMetier($paramLibelle_metier) {
        $this->libelle_metier = $paramLibelle_metier;
    }

//  GETTERS *****************************************************************// 
    public function getLibelleMetier() {
        return $this->libelle_metier;
    }

//  METHODES ****************************************************************// 
    public function __toString() {
        return parent::__toString() . 
                    'Métier : ' . $this->libelle_metier . '<br /><br />';
    }
}
?>