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
                return $speudo == $_SESSION["speudo"];
            }
        ?>
    </ul>
</div>
<script type="text/javascript">
    const DELAY = 3000;
    const URL_AFRAICHIR_MESSAGE = 'index.php?p=affichageMessages';
    const METHODE_HTTP_POST = "POST";
    const ASYNCHRONE = true;
    /*
            Cette fonction sert à mettre à jour le chat automatiquement
    */
    function mettreAJourChat() {
        //On créé une requète HTTP
        let requeteHttp = new XMLHttpRequest();

        requeteHttp.addEventListener('error', () => {
           alert("Il y a eu une erreur durant la requête de rafraichissement des messages");
        });

        requeteHttp.addEventListener('load', () => {
            let baliseMessage = document.getElementById('affichageMessages');
            baliseMessage.innerHTML = requeteHttp.responseText;
        });

        requeteHttp.open(METHODE_HTTP_POST, URL_AFRAICHIR_MESSAGE, ASYNCHRONE);

        requeteHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //On lance la requête HTTP
        requeteHttp.send();
    }

    function prepareDonnees(){
        let pairesDeDonnees = [];

        return pairesDeDonnees.join('&').replace(/%20/,'+');
    }
    /*
        Toutes les "DELAY" miliseconde, on met à jour le chat
    */
    setInterval(() => {
        console.log("Mise à jour des messages...");
        mettreAJourChat();
    }, DELAY);
</script>