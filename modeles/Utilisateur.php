<?php

require_once("../../bdd/bdd.php");

class Utilisateur implements Connectable
{
    private BDD $bdd;

    public function __construct(){
        $this->bdd = $this->connecter();
    }

    public function connecter() : BDD{
        return new BDD();
    }

    public function deconnecter(){
        $this->bdd->deconnecterBDD();
    }
    //Cette fonction cherche un utilisateur en base de données, et si elle le trouve, elle retourne vrai.
    public function trouverUtilisateur(string $pseudo, string $mdp) : bool{
        $requeteTrouverUtilisateur = "SELECT count(*) FROM utilisateur WHERE speudo = '" . $pseudo . "' AND mdp = '" . $mdp . "'";

        $resultat = $this->bdd->faireRequete($requeteTrouverUtilisateur);
        //On regarde si on a un utilisateur correspondant dans le résultat de la requête.
        return $resultat == "1";
    }
}