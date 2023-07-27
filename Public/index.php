<?php

// Ce fichier est le point d'entrée de notre site

use App\Routeur;

// Pour gerer les connexions on utilise la session
session_start();
// j'ai maintenant accés à $_session dans toute mon app

// echo "point d'entrée";

// Pour rester sur le fichier index.php quoi qu'il arrive je dois faire une réecriture d'url
// une des possibilités est d'utiliser un fichier de config du serveur apache qui s'appelle .htaccess
// Nous allons créer ce fichier dans le repertoire "public"
// Nous allons aussi créer un virtualHost

// On importe l'autoloader
require_once('../autoloader.php');

// On crée un routeur pour gérer les routes
// on appelle la méthode app()

define('ROOT', dirname(__DIR__));
// echo ROOT;
 $routeur = new Routeur;
 $routeur->app();