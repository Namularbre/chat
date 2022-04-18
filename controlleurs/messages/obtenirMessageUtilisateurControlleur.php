<?php

require_once("bdd/bdd.php");

$bdd = new BDD();

$requeteObtenirMessagesUtilisateur = "SELECT m.messageUti, dateEnvoi, u.speudo AS 'destinataire', u2.speudo AS 'expediteur' 
                                    FROM message m INNER JOIN utilisateur u ON (m.idDestinataire=u.idUtilisateur)
                                    INNER JOIN utilisateur u2 ON (m.idExpediteur=u2.idUtilisateur)
                                    WHERE m.idDestinataire = " . $_SESSION["idUtilisateur"] . " OR m.idExpediteur = " . $_SESSION["idUtilisateur"] . "
                                    ORDER BY dateEnvoi DESC";

                                    /*"SELECT m.messageUti, dateEnvoi, u.speudo AS 'destinataire', u2.speudo AS 'expediteur' 
                                    FROM message m INNER JOIN utilisateur u ON (m.idDestinataire=u.idUtilisateur)
                                    INNER JOIN utilisateur u2 ON (m.idExpediteur=u2.idUtilisateur)
                                    WHERE u.idUtilisateur =" . $_SESSION["idUtilisateur"] . 
                                    " ORDER BY dateEnvoi";*/

$resultats = $bdd->faireRequete($requeteObtenirMessagesUtilisateur);

$bdd->deconnecterBDD();

return $resultats;