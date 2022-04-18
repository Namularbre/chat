<?php
//On détruit les informations de l'utilisateur garder dans la session
session_unset();
//On retourne sur la page de login
header("Location: " . "/");