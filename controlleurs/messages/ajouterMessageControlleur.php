<?php

require_once("../../bdd/bdd.php");

session_start();

if (isset($_POST["submit"])) {
    $bdd = new BDD();
    
    /*
        On traite le message saisi par l'utilisateur pour qu'il soit compatible avec la requête MySQL.
    */
    $message = traiterTexte($_POST["message"]);
    $destinataire = trouverDestinataire();
    /*
        Cette requête envoie le message à quelqu'un d'autre.
    */
    $requeteInsertionMessage = "INSERT INTO message (idExpediteur,idDestinataire,messageUti,dateEnvoi)
                                VALUES (". $_SESSION["idUtilisateur"] ."," . $destinataire . ", '" .
                                         $message . "', NOW() );";
    /*
        Cette requête sert à envoyer un message à nous-même, pour que l'on puisse voir les messages que l'on envoi sans
        à avoir à refresh la page.
    */
    /*$requeteInsertionMessagePourNous = "INSERT INTO message (idExpediteur,idDestinataire,messageUti,dateEnvoi)
    VALUES (" . $_SESSION["idUtilisateur"] ."," . $_SESSION["idUtilisateur"] . ", '" .
                                         $message . "', NOW() );";;*/
    if ($destinataire != null) {
        $bdd->faireRequete($requeteInsertionMessage);
    }
    else {
        echo "Utilisateur introuvable";
    }

    /*$bdd->faireRequete($requeteInsertionMessagePourNous);*/

    $bdd->deconnecterBDD();
}
//On retourne à la page précédante
header("Location: " . $_SERVER["HTTP_REFERER"]);
/*
    Cette fonction retourne l'id de la personne à qui on envoie le message.
*/
function trouverDestinataire(){

    $pseudoDestinataire = $_POST["pseudo"];
    
    $bdd = new BDD();
    
    $requeteTrouverUtilisateur = "SELECT idUtilisateur FROM utilisateur WHERE speudo = '" . traiterTexte($pseudoDestinataire) . "'";
    
    $resultat = $bdd->faireRequete($requeteTrouverUtilisateur);
    //Si on obtient rien, on ne retourne rien
    if ($resultat == []) {
        return null;
    }
    $bdd->deconnecterBDD();
    //On récupère l'id du destinataire
    return $resultat[0]["idUtilisateur"];
}
/*
    Cette fonction permet de protéger l'application contre les insertions impossible à cause de caractères tel que '\...
    On enlève les \ et on double les ' pour qu'il puisse se conserver en BDD sans tout casser.
*/
function traiterTexte($messageBrute){
    return str_replace("'","''",trim($messageBrute,"\\"));
}