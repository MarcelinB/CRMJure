<?php
//***************************************************************************//
//*************************** CLASSE CONTACTS *******************************//
//***************************************************************************//
abstract class Contact {
//  DONNEES MEMBRES *********************************************************// 
    protected $nom;
    protected $prenom;
    protected $adresse;
    protected $telephone;
    protected $portable;
    protected $mail;
//  CONSTRUCTEUR ************************************************************// 
    public function __construct(
                                string $paramNom,
                                string $paramPrenom,
                                string $paramAdresse,
                                string $paramTelephone,
                                string $paramPortable,
                                string $paramMail) {
        $this->setNomContact($paramNom);
        $this->setPrenomContact($paramPrenom);
        $this->setAdresseContact($paramAdresse);
        $this->setTelephoneContact($paramTelephone);
        $this->setPortableContact($paramPortable);
        $this->setMailContact($paramMail);
    }
//  SETTERS *****************************************************************// 
    public function setNomContact($paramNom) {
        $this->nom = $paramNom;
    }
    public function setPrenomContact($paramPrenom) {
        $this->prenom = $paramPrenom;
    }
    public function setAdresseContact($paramAdresse) {
        $this->adresse = $paramAdresse;
    }
    public function setTelephoneContact($paramTelephone) {
        $this->telephone = $paramTelephone;
    }
    public function setPortableContact($paramPortable) {
        $this->portable = $paramPortable;
    }
    public function setMailContact($paramMail) {
        $this->mail = $paramMail;
    }
//  GETTERS *****************************************************************// 
    public function getNomContact() {
        return $this->nom;
    }
    public function getPrenomContact() {
        return $this->prenom;
    }
    public function getAdresseContact() {
        return $this->adresse;
    }
    public function getTelephoneContact() {
        return $this->telephone;
    }
    public function getPortableContact() {
        return $this->portable;
    }
    public function getMailContact() {
        return $this->mail;
    }
//  METHODES ****************************************************************// 
    public function __toString() {
        return 
            'Nom : ' . $this->nom . '<br />' . 
            'Prénom : ' . $this->prenom . '<br />' . 
            'Adresse : ' . $this->adresse . '<br />' . 
            'Téléphone : ' . $this->telephone . '<br />' . 
            'Portable : ' . $this->portable . '<br />' . 
            'Mail : ' . $this->mail . '<br /><br />';
    }
}
?>