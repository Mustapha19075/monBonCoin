<?php
namespace Models;
use PDO;
use App\Db;

class Users extends Db{
    ////////////// CRUD ///////////////////
    /////////// Méthode de lecture
    //  1 - Méthode pour trouver tous les users
    public static function findAll(){
        $request = 'SELECT * FROM users';
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }


    //  2 - Méthode pour trouver un user par son id
    //  3 - Méthode pour trouver un user par son login


}
