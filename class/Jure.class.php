<?php
//***************************************************************************//
//*************************** CLASSE FORMATEURS *****************************//
//***************************************************************************//
class Jure extends Contact {
//  DONNEES MEMBRES *********************************************************// 
    public $libelle_profession;
    public $entreprise;
//  CONSTRUCTEUR ************************************************************// 
    public function __construct(string $paramNom,
                                string $paramPrenom,
                                string $paramAdresse,
                                string $paramTelephone,
                                string $paramPortable,
                                string $paramMail, 
                                string $paramLibelle_profession, 
                                string $paramEntreprise) {
        parent::__construct($paramNom, $paramPrenom, $paramAdresse,
                            $paramTelephone, $paramPortable,
                            $paramMail);

        $this->setLibelleProfession($paramLibelle_profession);
        $this->setEntreprise($paramEntreprise);
    }
//  SETTERS *****************************************************************// 
    public function setLibelleProfession($paramLibelle_profession) {
        $this->libelle_profession = $paramLibelle_profession;
    }
    public function setEntreprise($paramEntreprise) {
        $this->entreprise = $paramEntreprise;
    }

//  GETTERS *****************************************************************// 
    public function getLibelleProfession() {
        return $this->libelle_profession;
    }
    public function getEntreprise() {
        return $this->entreprise;
    }

//  METHODES ****************************************************************// 
    public function __toString() {
        return parent::__toString() . 
                    'Profession : ' . $this->libelle_profession . '<br /><br />';
    }
}
?>