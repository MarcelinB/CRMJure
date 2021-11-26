<?php

class Formation 
{
    private $ID_Formation;
    private $Libéllé_Formation;

    public function __construct($ID_Formation, $Libéllé_Formation)
    {
        $this->setId($ID_Formation);
        $this->setLibelle($Libéllé_Formation);
    }
    // Setters

    private function setId($Id)
    {
        $this->ID_Formation = $Id;
    }
    private function setLibelle($libelle)
    {
        $this->Libéllé_Formation = $libelle;
    }

    // Getters

    public function getID()
    {
        return $this->ID_Formation;
    }
    public function getLibelle()
    {
        return $this->Libéllé_Formation;
    }
}



?>