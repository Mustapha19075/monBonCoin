<?php

namespace App;
use PDO;
use PDOException;

// Cete classe permet de se connecter à la BDD en utilisant le pattern Singleton
class Db{
    private static $db; // pour stocker mon objet PDO

    // Singleton
    static function getDb(){
        if(!self::$db){
            try {
                // Chemin vers config.json depuis le dossier public
                $config = file_get_contents('App/config.json');

                //var_dump($config);
                // pour pouvoir utiliser un fichier json il faut le decoder
                // chemin vers config.json depuis le dossier racine
                $config = json_decode($config);
                // On crée l'objet PDO
                self::$db = new PDO("mysql:host=" . $config->host . ";dbname=" . $config->dbName, $config->user, $config->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            } catch (PDOException $err){
                 echo 'erreur ' .$err->getMessage();
            }
        }
        return self::$db;
    }
}
// $test = new Db;
// $test::getDb();

