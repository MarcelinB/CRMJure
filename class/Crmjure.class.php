<?php

class Crmjure {
    private static $connexion;

    private static function connect()
    // Fonction permettant la connexion à la BDD. Elle utilise le fichier parametres.ini pouvant être modifié par l'utilisateur en 
    // cas de changement.
    {
        $file = '../param/parametres.ini';
        if (file_exists($file)) {
            $tParam = parse_ini_file($file);
            extract($tParam); // génère les variables dynamiquement

            $dsn = "mysql:host=".$host."; port=".$port."; dbname=".$bdd."; charset=utf8";
            
            $mysqlPDO = new PDO($dsn, $user, $password,
                            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            Crmjure::$connexion = $mysqlPDO;
            
            return Crmjure::$connexion;
        } else {
            throw new Exception("ERR:Fichier de paramètre inconnu");
        }
    }
    // fonction de 'déconnexion' de la BDD
    public static function disconnect(){
        Crmjure::$connexion = null;
    }

    // Pattern singleton
    public static function getConnexion() {
        if (Crmjure::$connexion != null) {
            return Crmjure::$connexion;
        } else {
            return Crmjure::connect();
        }
    }
}

?>