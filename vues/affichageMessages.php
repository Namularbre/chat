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
                Cette fonction détermine si le speudo passé en paramètre est celui de l'utilisateur
            */
            function estSpeudoUtilisateurCourant($speudo){
                return $speudo == $_SESSION["speudo"];
            }
        ?>
    </ul>
    <script type="text/javascript">
    const DELAY = 3000;
    /*
            Cette fonction sert à mettre à jour le chat automatiquement
    */
    /*function mettreAJourChat() {
        //On récupère la balise contenant la vue
        let affichageMessages = document.getElementById("affichageMessages");

        //On créé une requète HTTP
        let requeteHttp = new XMLHttpRequest();
        //On lui donne le type GET et on vas chercher cette page
        requeteHttp.open('GET', 'index.php?p=affichageMessages');
        requeteHttp.onload = function() {
            //Si la requête fonctionne
            if (requeteHttp.status === 200) {
                //On récup l'html obtenu
                htmlObtenu = requeteHttp.responseText;
                affichageMessages = htmlObtenu;
            }
            else {
                alert('Echec du rafraichissement de la page. Erreur HTTP : ' + requeteHttp.status);
            }
        };
        //On lance la requête HTTP
        requeteHttp.send();
    }*/
    /*
        Toutes les "DELAY" miliseconde, on met à jour le chat
    */
    setInterval(() => {
        console.log("Mise à jour des messages...");
        //mettreAJourChat();
    }, DELAY);
</script>
</div>