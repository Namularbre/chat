<!--Formulaire de redaction des messages-->
<div id="ecrireMessage">
    <h5 class="black-text center-align">Envoyer un message :</h5>
    <form class="white-text white lighten-4 form center-align" id="formulaireEnvoiMsg" method="post" onsubmit="return empecherAutoEnvoi()" action="controlleurs/messages/ajouterMessageControlleur.php" style="margin: 3% 0;">
        <div class="center-align">
            <label class="black-text center-align" for="Destinataire" style="margin: 1% 0;">Entrez le speudo du destinataire :</label>
            <input class="black-text white input-field" type="text" name="pseudo" id="pseudo" data-length="20" placeholder="Nom du destinataire" required style="margin: 1% 0;">
        </div>
        <div class="center-align">
            <label class="black-text center-align" for="message">Votre message :</label>
            <textarea class="black-text white materialize-textarea" name="message" id="message" data-length="500" placeholder="Votre message" required></textarea>
        </div>
        <button class="btn waves-effect waves-light blue white-text z-depth-4" type="submit" name="submit" id="submit" style="margin: 1% 0;">
            Envoyer
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>
<script type="text/javascript">
    <?php echo "
    function empecherAutoEnvoi() {
        //On récupère le destinataire saisi par l'utilisateur
        let destinataire = document.getElementById('pseudo').value;
        //On regarde si le speudo rentré est différent de celui de l'utilisateur
        if(destinataire != '" . $_SESSION["speudo"] ."'){
            return true;
        }
        alert('Vous ne pouvez pas vous envoyez un message !');
        return false;
    }";
    ?>
</script>