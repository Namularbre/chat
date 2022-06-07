<?php
/*
    Attention, dans l'application j'ai remplacé pseudo par speudo...
*/

const ROOT = "/chat/index.php";

//On récupère l'url demandée
$urlDemandeeBrute = $_SERVER["REQUEST_URI"];

//Cette fonction enlève les "/ et \" au URL.
function traiterUrl($urlBrute){
    //$urlBrute = str_replace(ROOT,"",$urlBrute);
    return trim($urlBrute, "/\\");
}

$url = traiterUrl($urlDemandeeBrute);

switch ($url) {
    case "":
        require("vues/connection.php");
        break;
        //A voir si c'est utile...
    case "index.php?p=connection":
        require("vues/connection.php");
        break;

    case 'index.php?p=chat':
        require("vues/chat.php");
        break;
    case "index.php?p=affichageMessages":
        require("vues/affichageMessages.php");
        break;
    default:
        echo "<h1>ERREUR 404</h1> <p>L'url " . $url . " ne mène à rien.</p>";
        break;
}