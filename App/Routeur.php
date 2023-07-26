<?php
namespace App;

use Controllers\Controller;

class Routeur{

    private $routes = [
        '/' => ['controller' => 'Products', 'action' => 'accueil'],
        '/products' => ['controller' => 'Products', 'action' => 'AffichageProducts'],
        '/detailProduct' => ['controller' => 'Products', 'action' => 'detailProduct'],
        '/inscription' => ['controller' => 'Users', 'action' => 'inscription'],
        '/connexion' => ['controller' => 'Users', 'action' => 'connexion'],
        '/deconnexion' => ['controller' => 'Users', 'action' => 'deconnexion'],
        '/ajoutProduct' => ['controller' => 'Products', 'action' => 'ajoutProduct'],
        '/modifProduct' => ['controller' => 'Products', 'action' => 'modifProduct'],
        '/suppProduct' => ['controller' => 'Products', 'action' => 'suppProduct'],
        '/panier' => ['controller' => 'Panier', 'action' => 'gestionPanier']
    ];
    // Je crée une méthode app qui est la méthode centrale de mon site le fichier index.php

    public function app(){
        // On test le routeur
        echo "Le routeur fonction";
        // On doit récuperer l'url
        $request = $_SERVER['REQUEST_URI'];
           //echo $request;
        // je ne veux pas recuperer les parametres dans mes routes
        // donc je casse la chaine de caractere en prenant "?" comme séparateur
        $request = explode("?", $request);
          //var_dump($request);
        $request = $request [0];

        // On vérifi si la route ($request) est bien présente dans le tableau de routes
        if(array_key_exists($request, $this->routes)){
            $controller = "Controllers\\" . $this->routes[$request]['controller'];
            $action = $this->routes[$request]['action'];
            $controller::$action();
        }else
            echo "la page que vous demandez n'existe pas";
    }
    
}