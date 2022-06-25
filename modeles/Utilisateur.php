<?php


require_once("Connectable.php");

if (file_exists("../../bdd/bdd.php")){
    require_once("../../bdd/bdd.php");
}
else{
    require_once("bdd/bdd.php");
}

class Utilisateur implements Connectable
{
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
    //Cette fonction cherche un utilisateur en base de données, et si elle le trouve, elle retourne vrai.
    public function connecterUtilisateur(string $pseudo, string $mdp) : bool{
        $requeteTrouverUtilisateur = "SELECT count(*) AS 'existe' FROM utilisateur WHERE speudo = '" . $pseudo . "' AND mdp = '" . $mdp . "'";

        $resultat = $this->bdd->faireRequete($requeteTrouverUtilisateur);

        if (isset($resultat[0]["existe"])){
            //On regarde si on a un utilisateur correspondant dans le résultat de la requête.
            return $resultat[0]["existe"] == "1";
        }
        else {
            throw new InvalidArgumentException("Le pseudo ou le mot de passe génère une erreur SQL");
        }

    }
    //Cette méthode ajoute un utilisateur en base de données. ATTENTION, L'UTILISATEUR DOIT AVOIR UN PSEUDO UNIQUE
    public function ajouterUtilisateur(string $pseudo){
        $requeteAjouterUtilisateur = "INSERT INTO utilisateur (speudo) VALUES ('" . $pseudo . "');";

        $this->bdd->faireRequete($requeteAjouterUtilisateur);
    }
    //Cette méthode sert à vérifier que l'utilisateur n'est pas déjà en base de données
    public function utilisateurExiste(string $pseudo) : bool{
        $pasDeCorrespondance = "0";
        $requeteTrouveUtilisateur = "SELECT count(speudo) FROM utilisateur WHERE speudo = " . $pseudo . ";";
        //Si le résultat de la requête donne 0, càd qu'il n'y a pas d'utilisateur dans la base avec le pseudo, on renvoie vrai.
        return $pasDeCorrespondance == $this->bdd->faireRequete($requeteTrouveUtilisateur);
    }
    //Cette méthode modifie le pseudo d'un utilisateur
    public function modifierPseudoUtilisateur(string $ancienPseudo, string $nouveauPseudo){
        $requeteModifierUtilisateur = "UPDATE utilisateur 
                                       SET speudo = '" . $nouveauPseudo . "' 
                                       WHERE speudo = '" . $ancienPseudo . "'";

        $this->bdd->faireRequete($requeteModifierUtilisateur);
    }
    //Cette méthode modifie le mot de passe d'un utilisateur
    public function modifierMdpUtilisateur(string $pseudo, string $ancienMdp, string $nouveauMdp){
        $requeteModifierMdp = "UPDATE utilisateur
                               SET mdp = '" . $nouveauMdp . "'
                               WHERE speudo = '" . $pseudo . "' AND mdp = '" . $ancienMdp . "'";

        $this->bdd->faireRequete($requeteModifierMdp);
    }
    //Cette méthode supprime un utilisateur. ATTENTION, VOUS DEVEZ SUPPRIMER CES MESSAGES AVANT !
    public function supprimerUtilisateur(string $pseudo, string $mdp){
        $requeteSupprimerUtilisateur = "DELETE FROM utilisateur WHERE speudo = '" . $pseudo . "'" . $mdp . "'";

        $this->bdd->faireRequete($requeteSupprimerUtilisateur);
    }
    //Cette méthode retourne l'id de l'utilisateur
    public function trouverIdUtilisateur(string $pseudo, string $mdp) : int
    {
        $requeteTrouverId = "SELECT idUtilisateur 
                             FROM utilisateur 
                             WHERE speudo = '" . $pseudo . "' AND mdp = '" . $mdp . "'";

        if(isset($this->bdd->faireRequete($requeteTrouverId)[0]["idUtilisateur"])){
            return $this->bdd->faireRequete($requeteTrouverId)[0]["idUtilisateur"];
        }
        else {
            return -1;
        }
    }

}