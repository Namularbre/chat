<?php

require_once("../bdd/bdd.php");

class Message implements Connectable {
    private BDD $bdd;
    //Lorsque l'on instancie ce modèle, on instancie une interface de connexion à la base de données.
    public function __construct(){
        $this->bdd = $this->connecter();
    }
    //Provient de Connectable. Cette méthode retourne une nouvelle liaison à la base de données.
    public function connecter() : BDD{
        return new BDD();
    }
    //Provient de Connectable. Cette méthode en appelle une autre qui vas détruire la connexion à la base.
    //On détruit ensuite l'interface de connexion.
    public function deconnecter(){
        $this->bdd->deconnecterBDD();
        unset($this->bdd);
    }
    //Ajoute un message dans la base de données, qui sera lu par les utilisateurs
    public function enregistrerMessage(int $idExpediteur, int $idDestinataire, string $message){
        $requeteEnregistrerMessage = "INSERT INTO message (idExpediteur, idDestinataire, message, dateEnvoi) 
                                      VALUES (" . $idExpediteur . "," . $idDestinataire . ",'" . $message . "', NOW());";

        $this->bdd->faireRequete($requeteEnregistrerMessage);
    }
    //Retourne les messages envoyés par et pour l'utilisateur
    public function avoirMessageUtilisateur(int $idUtilisateur): bool|array
    {
        $requeteAvoirMessageUtilisateur =  "SELECT m.messageUti, dateEnvoi, u.speudo AS 'destinataire', u2.speudo AS 'expediteur' 
                                            FROM message m INNER JOIN utilisateur u ON (m.idDestinataire=u.idUtilisateur)
                                            INNER JOIN utilisateur u2 ON (m.idExpediteur=u2.idUtilisateur)
                                            WHERE m.idDestinataire = " . $idUtilisateur . " OR m.idExpediteur = " . $idUtilisateur . "
                                            ORDER BY dateEnvoi DESC";

        return $this->bdd->faireRequete($requeteAvoirMessageUtilisateur);
    }
}