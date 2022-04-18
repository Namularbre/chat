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
    <title>Il est temps de se connecter !</title>
</head>
<body class="blue lighten-4">
    <div class="container">
        <form class="white center-align" method="GET" action="../controlleurs/utilisateur/connexionControlleur.php" style="margin: 1%">
            <label for="speudo">Votre speudo :</label>
            <input type="text" name="speudo" id="speudo" placeholder="Votre speudo" required>
            <label for="mdp">Votre mot de passe :</label>
            <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" required>
            <button type="submit" name="submit" class="btn waves-effect waves-light blue white-text z-depth-4 row" style="margin: 1% 0;">
                se connecter
            </button>
        </form>
    </div>
</body>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
</html>