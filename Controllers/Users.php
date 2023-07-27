<?php
namespace Controllers;
class Users extends Controller{
    public static function connexion(){
        $errMsg = "";
        // pour verifier si le formulaire a été soumis nous puvons utiliser la super global $_SERVER (cette méthode ne fonctionne qu'avec un formulaire en POST)
        //var_dump($_SERVER);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //echo "le formulaire est soumis";
            // il faut toujours sécuriser les saisies utilisateurs
            //https://www.php.net/manual/fr/function.htmlspecialchars.php
            $login = htmlspecialchars(trim($_POST['login']));
            // on verifi si le login présent en BDD
            $user = \Models\Users::findByLogin($login);
            var_dump($user);
            if(!$user){
                $errMsg = "Le login et / ou le mot de passe est incorrect";
            }else{
                $pass = htmlspecialchars(trim($_POST['password']));
                if(password_verify($pass, $user['password'])){
                    echo 'ok';
                }else{
                    $errMsg = "Le login et / ou le mot de passe est incorrect";
                }

            }
        }

        self::render('users/connexion',[
            'title' => 'Vous pouvez vous connecter',
            'messageErreur' => $errMsg
        ]);
    }
}