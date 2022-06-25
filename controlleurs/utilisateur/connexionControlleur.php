<?php

require_once("../../modeles/utilisateur.php");


$utilisateur = new utilisateur();

if (isset($_GET["submit"])) {
    $pseudo = $_GET["speudo"];
    $mdp = $_GET["mdp"];
    //Si on n'arrive pas à connecter l'utilisateur, on reste sur la même page et on affiche un message d'erreur.
    if ($utilisateur->connecterUtilisateur($pseudo, $mdp)) {
        //TODO : faire une page d'erreur, un copier coller de l'ancienne mais avec du texte
        echo "<script>alert('Nom d\'utilisateur ou/et mot de passe incorrect(s)');</script>";
        return;
    }
    //TODO : voir si ça ne serai pas plus judicieux d'utiliser des cookies ?
    if(session_start()){
        $_SESSION["speudo"] = $_GET["speudo"];
        $_SESSION["mdp"] = $_GET["mdp"];
        //TODO : supprimer l'utilisation de l'idUtilisateur, ça n'a pas de sens. Les speudos sont uniques.
        $idUtilisateur = $utilisateur->trouverIdUtilisateur($pseudo, $mdp);

        if($idUtilisateur != -1){
            $_SESSION["idUtilisateur"] = $idUtilisateur;
        }
        else {
            echo "<script>alert('Impossible de récupérer votre id.');</script>";
            return;
        }
    }
}
header("Location:" . "/index.php?p=chat");