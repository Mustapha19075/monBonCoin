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

    public static function findById($id) {
        $request = 'SELECT * FROM users WHERE idUser = :id';
        $response = self::getDb()->prepare($request);
        $response->bindValue(':id', $id, PDO::PARAM_INT);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    
    //  3 - Méthode pour trouver un user par son login

    public static function findByLogin($login){
        $request = 'SELECT * FROM users WHERE login = :login';
        $response = self::getDb()->prepare($request);
        $response->bindValue(':login', $login, PDO::PARAM_STR);
        $response->execute();

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    ///////////// Méthode d'écriture
    // 1 / Méthode pour créer un user
    public static function create($data){
    // Syntaxe sans les bindValue utilisation du "?"
    // avec cette syntaxe $data doit etre un tableau qui contient toutes les valeurs à enregistrer en BDD
        $request = "INSERT INTO users (login, password, firstName, lastName, address, cp, city) VALUE (?, ?, ?, ?, ?, ?, ?)";
        $response = self::getDb()->prepare($request);
        return $response->execute($data);

}

// 2 / Méthode pour modifier un user

public static function update(array $data){
    $request = "UPDATE users SET login = ?, password = ?, firstName = ?, lastName = ?, address = ?, cp = ?, city = ? WHERE idUser = ?";
    $response = self::getDb()->prepare($request);
    return $response->execute($data);
}

// 3 / Méthode de suppression
public static function delete($id){
    $request = "DELETE FROM users WHERE idUser = :id";
    $response = self::getDb()->prepare($request);
    $response->bindValue(':id', $id, PDO::PARAM_INT);
    return $response->execute();
}
}