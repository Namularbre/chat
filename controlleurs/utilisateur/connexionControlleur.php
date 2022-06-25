<?php


if (file_exists("../../modeles/utilisateur.php")){
    require_once("../../modeles/utilisateur.php");
}
else{
    require_once("modeles/utilisateur.php");
}

$utilisateur = new utilisateur();

if (isset($_POST["submit"])) {
    $pseudo = $_POST["speudo"];
    $mdp = $_POST["mdp"];
    //Si on n'arrive pas à connecter l'utilisateur, on reste sur la même page et on affiche un message d'erreur.
    if (!$utilisateur->connecterUtilisateur($pseudo, $mdp)) {
        //TODO : faire une page d'erreur, un copier coller de l'ancienne mais avec du texte
        header("Location: index.php?p=connexionErr");
        echo "<script>alert('Nom d\'utilisateur ou/et mot de passe incorrect(s)');</script>";
        return;
    }
    //TODO : voir si ça ne serai pas plus judicieux d'utiliser des cookies ?
    if(session_start()){
        $_SESSION["speudo"] = $_POST["speudo"];
        $_SESSION["mdp"] = $_POST["mdp"];
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
//On vas sur la vue du chat.
header("Location:" . "/index.php?p=chat");