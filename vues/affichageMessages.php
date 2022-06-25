<div id="affichageMessages">
    <h5 class="black-text center-align">Vos messages :</h5>
    <ul class="white">
        <?php
            
            $messages = require("controlleurs/messages/obtenirMessageUtilisateurControlleur.php");    

            foreach ($messages as $message) {
                //On récupère le nom du destinataire et de l'expéditeur
                $speudoExpediteur = $message["expediteur"];
                $speudoDestinataire = $message["destinataire"];
                if (estSpeudoUtilisateurCourant($speudoExpediteur)) {
                    $speudoExpediteur = "Vous";
                }
                if (estSpeudoUtilisateurCourant($speudoDestinataire)) {
                    $speudoDestinataire = "Vous";
                }
                echo "<li class='row col s12'><p class='col s4 right-align'>(". $message["dateEnvoi"] . ") " .
                 $speudoExpediteur . "=>" . $speudoDestinataire . ":</p>" . 
                    "<p class='col s8 left-align'>" . $message["messageUti"] . "</p></li>";
            }
            /*
                Cette fonction détermine si le pseudo passé en paramètre est celui de l'utilisateur
            */
            function estSpeudoUtilisateurCourant($speudo){
                if (isset($_SESSION["speudo"])){
                    return $speudo == $_SESSION["speudo"];
                }
                else {
                    return $speudo == $nomUtilisateur;
                }
            }
        ?>
    </ul>
</div>
<script type="text/javascript">
    const DELAY = 3000;
    const URL_RAFRAICHIR_MESSAGE = 'index.php?p=affichageMessages';
    const METHODE_HTTP_POST = "POST";
    const ASYNCHRONE = true;
    const NOM_UTILISATEUR = <?php
        if(isset($_SESSION["speudo"])){
            echo $_SESSION["speudo"];
        }
        else {
            echo $nomUtilisateur;
        }
    ?>;

    /*
        Cette fonction sert à envoyer le nom utilisateur pour le rafraichissement des messages
    */
    function preparerNomUtilisateur(){
        let donneesEnvoyes = [encodeURIComponent("nomUtilisateur") + '=' + encodeURIComponent(NOM_UTILISATEUR)];
        return donneesEnvoyes.join('&').replace(/20%/g,'+');
    }
    /*
        Cette fonction sert à mettre à jour le chat automatiquement
    */
    function mettreAJourChat() {
        //On créé une requête HTTP
        let requeteHttp = new XMLHttpRequest();
        let donnees = preparerNomUtilisateur();

        requeteHttp.addEventListener('error', () => {
           alert("Il y a eu une erreur durant la requête de rafraichissement des messages");
        });

        requeteHttp.addEventListener('load', () => {
            let baliseMessage = document.getElementById('affichageMessages');
            baliseMessage.innerHTML = requeteHttp.responseText;
        });

        requeteHttp.open(METHODE_HTTP_POST, URL_RAFRAICHIR_MESSAGE, ASYNCHRONE);

        requeteHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //On lance la requête HTTP
        requeteHttp.send(donnees);
    }
    /*
        Toutes les "DELAY" millisecondes, on met à jour le chat
    */
    setInterval(() => {
        console.log("Mise à jour des messages...");
        mettreAJourChat();
        console.log(NOM_UTILISATEUR);
    }, DELAY);
</script>