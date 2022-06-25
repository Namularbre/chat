<?php
//L'hôte qui héberge le serveur de base de données
const HOTE = "localhost";
//Le nom de la base de données
const NOM_BDD = "chat";
//L'utilisateur de la base de données
const UTILISATEUR = "chat";
//Le mot de passe de l'utilisateur
const MDP = "chat";

class BDD
{
    //TODO : mettre à jour la documentation
    //COMMENT AGIR SUR LA BDD ?

    /*
     * Comment afficher des données ?
     *
     * Pour afficher des données, rien de plus simple. Il vous faut d'abord créer un modèle, qui est en faite une classe.
     * Ajouter lui un attribut ayant le type BDD, afin de lui accorder la possibilité d'agir dans la base de données.
     * Ensuite, faite une méthode contenant une variable qui est une requête SQL. Il ne vous reste plus qu'a utiliser
     * l'attribut pour l'exécuter et retourner le résultat de la requête.
     * Ensuite, il vous faut un contrôleur faisant appel à cette méthode, qui importera une vue avec un foreach afin
     * d'afficher les résultats du tableau.
     * Dans le contrôleur, vous pouvez faire quelques vérifications majeures sur les données ressorties
     *
     * plus d'info : https://nouvelle-techno.fr/articles/live-coding-creer-un-crud-en-php
     */

    //La connexion à la base de données.
    private PDO $connexion;

    //Initialise une nouvelle connexion à la base de données
    public function __construct()
    {
        //On essaye de se connecter à la base, si on échoue on affiche un message d'erreur
        try {
            $this->connexion = new PDO("mysql:" . HOTE . ";" . NOM_BDD, UTILISATEUR, MDP);
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
    //Cette méthode exécute une requête SQL et retourne son résultat sous forme de tableau
    public function faireRequete($requete): bool|array
    {
        //on prépare la requête SQL
        $ressource = $this->connexion->prepare($requete);
        //On exécute la requête SQL
        $ressource->execute();
        //On retourne le résultat dans un tableau associatif.
        return $ressource->fetchAll(PDO::FETCH_ASSOC);
    }
}