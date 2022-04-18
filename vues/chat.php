
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <title>Chat</title>
</head>
<body class="blue lighten-4">
    <nav class="blue row">
        <!--Affichage de quel utilisateur est connecté-->
        <h5 class="col s5">
        <?php
            if (session_start()) {
                echo "Connecté en tant que : " . $_SESSION["speudo"] . " #" . $_SESSION["idUtilisateur"];
            } else {
                echo "La session n'a pas démarrer. Quelle enculée, elle pourrait faire un effort quand meme !";
            }
        ?>
        </h5>
        <div class="col s6 right-align">
            <?php 
                require("deconnection.php");
            ?>
        </div>
    </nav>
    <!--Les interfaces de l'application-->
    <div class="container">
        <div id="chat" style="margin: 2%;">
            <!--Formulaire pour écrire un message-->
            <?php require("vues/ecrireMessage.php"); ?>
            <!--Vue d'affichage des messages-->
            <?php require("vues/affichageMessages.php"); ?>
        </div>
    </div>
</body>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
</html>

