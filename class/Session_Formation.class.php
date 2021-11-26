<?php

class Session_Formation 
{
    private $ID_Session;
    private $Libéllé_Session_de_Formation;

    public function __construct($ID_Session, $Libéllé_Session_de_Formation)
    {
        $this->setId($ID_Session);
        $this->setLibelle($Libéllé_Session_de_Formation);
    }
    // Setters

    private function setId($Id)
    {
        $this->ID_Session = $Id;
    }
    private function setLibelle($libelle)
    {
        $this->Libéllé_Session_de_Formation = $libelle;
    }

    // Getters

    public function getID()
    {
        return $this->ID_Session;
    }
    public function getLibelle()
    {
        return $this->Libéllé_Session_de_Formation;
    }
}



?>