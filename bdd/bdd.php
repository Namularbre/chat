<?php

class BDD
{
    /*
     * Comment faire une requête ?
     * Dans un contrôleur, créer une constante avec une requête SQL à l'intérieur
     * On prépare la requête ainsi : $requete = $bdd->prepare($sql);
     * On l'exécute : $requete->execute();
     * On récup le résultat : $resultatReq = $requete->fetchAll(PDO::FETCH_ASSOC);
    */

    /*
     * Comment afficher les résultats de ma requête ?
     * Dans une vue, faire :
     * foreach($resultat as $leTypeQueJutiliseDansMonCode) { //quelque chose }
     *
     * plus d'info : https://nouvelle-techno.fr/articles/live-coding-creer-un-crud-en-php
    */
    private PDO $connexion;

    //initialise une nouvelle connexion à la base de données
    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:" . "localhost" . ";" . "chat", "chat", "chat");
            $requeteSQL = $this->connexion->prepare("use " . "chat" . ";");
            $requeteSQL->execute();
        }
        catch (PDOException $erreurSQL) {
            //on arrête le programme en affichant le message d'erreur
            die($erreurSQL->getMessage());
        }
    }
    //Détruit la connexion à la BDD.
    public function deconnecterBDD(){
        unset($this->connexion);
    }

    public function faireRequete($requete){
        //on prépare la requête SQL
        $ressource = $this->connexion->prepare($requete);
        //On exécute la requête SQL
        $ressource->execute();
        //On retourne le résultat dans un tableau associatif.
        return $ressource->fetchAll(PDO::FETCH_ASSOC);
    }
}

