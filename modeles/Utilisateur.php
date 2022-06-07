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
    //TODO : sécuriser
    public function connecterUtilisateur($speudo, $mdp){
        $requeteTrouverUtilisateur = "SELECT * FROM utilisateur WHERE speudo = '" . $speudo . "' AND mdp = '" . $mdp . "'";

        return $this->bdd->faireRequete($requeteTrouverUtilisateur);
    }

    public function deconnecter(){
        $this->bdd->deconnecterBDD();
    }
}