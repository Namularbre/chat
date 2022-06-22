<?php

require_once("../../bdd/bdd.php");
require_once("../../modeles/utilisateur.php");

$bdd = new BDD();
$utilisateur = new utilisateur();

if (isset($_GET["submit"])) {
    $pseudo = $_GET["speudo"];
    $mdp = $_GET["mdp"];

    $utilisateur->trouverUtilisateur($pseudo, $mdp);

    $requeteTrouverUtilisateur = "SELECT * FROM utilisateur WHERE speudo = '" . $speudo . "' AND mdp = '" . $mdp . "'";

    $resultat = $bdd->faireRequete($requeteTrouverUtilisateur);
    //Si l'utilisateur n'éxiste pas, on annule
    if ($resultat == []) {
        echo "Nom d'utilisateur ou/et mot de passe incorrect(s)";
        header("Location:" . $_SERVER["HTTP_REFERER"]);
        return;
    }

    if(session_start()){
        $_SESSION["speudo"] = $resultat[0]["speudo"];
        $_SESSION["mdp"] = $resultat[0]["mdp"];
        $_SESSION["idUtilisateur"] = $resultat[0]["idUtilisateur"];
    }
}
header("Location:" . "/index.php?p=chat");