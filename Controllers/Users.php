<?php

namespace Controllers;

class Users extends Controller
{
    public static function connexion()
    {
        $errMsg = "";
        // Pour vérifier si le formulaire a été soumis nous pouvons utiliser la super globale $_SERVER (cette méthode ne fonctionne qu'avec un formulaire en POST)
        // var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo 'le formulaire est soumis';
            // Il faut toujours sécuriser les saisies utilisateurs
            // https://www.php.net/manual/fr/function.htmlspecialchars.php
            $login = htmlspecialchars(trim($_POST['login']));
            // On vérifi si le login est présent en BDD
            $user = \Models\Users::findByLogin($login);
            // var_dump($user);
            if (!$user) {
                $errMsg = "Le login et / ou le mot de passe est incorrect";
            } else {
                $pass = htmlspecialchars(trim($_POST['password']));
                if (password_verify($pass, $user['password'])) {
                    // L'utilisateur est correcte
                    $_SESSION['user'] = [
                        'role' => $user['role'],
                        'id' => $user['idUser'],
                        'firstName' => $user['firstName']
                    ];
                    $_SESSION['message'] = "Salut, content de vous revoir";
                    // Quand l'utilisateur est connecté on le redirige ver la route de notre choix
                    header('Location: /');
                } else {
                    $errMsg = "Le login et / ou le mot de passe est incorrect";
                }
            }
        }

        self::render('users/connexion', [
            'title' => 'Vous pouvez vous connecter',
            'messageErreur' => $errMsg
        ]);
    }

    public static function deconnexion()
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = "A bientôt";
        header('Location: /');
    }

    public static function inscription()
    {
        $errMsg = "";
        // Regex du mot de passe (minimum 8 caractères)
        $pattern = '/^.{8,}$/';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // On vérifie que tous les champs soient remplis
            if (empty($_POST['login']) || !filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                $errMsg .= "Merci de saisir votre email valide<br>";
            }
            if (empty($_POST['firstName'])) {
                $errMsg .= "Merci de saisir votre prénom<br>";
            }
            if (empty($_POST['lastName'])) {
                $errMsg .= "Merci de saisir votre Nom<br>";
            }
            if (empty($_POST['address'])) {
                $errMsg .= "Merci de saisir votre adresse<br>";
            }
            if (empty($_POST['cp'])) {
                $errMsg .= "Merci de saisir votre code postal<br>";
            }
            if (empty($_POST['city'])) {
                $errMsg .= "Merci de saisir votre ville<br>";
            }
            if (empty($_POST['password'])) {
                $errMsg .= "Merci de saisir un mot de passe<br>";
            }
            if (empty($_POST['confirm'])) {
                $errMsg .= "Merci de confirmer le mot de passe<br>";
            }
            // On vérifie que les deux password correspondent et min 8caractères
            if ($_POST['password'] == $_POST['confirm'] && preg_match($pattern, $_POST['password'])) {
                // Je securise les saisies
                self::security();
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT );
                // var_dump($_POST);
                // Je crée un tableau qui contient les infos du user
                $dataUser = [];
                foreach ($_POST as $key => $value) {
                    if ($key != 'confirm') {
                       $dataUser[]= $value;
                    }
                }
                // On enregistre en BDD
                \Models\Users::create($dataUser);
                $_SESSION['message'] = "Votre compte est crée, vous pouvez vous connecter";
                header('Location: /connexion');
            } else {
                $errMsg = "Les deux mots de passe sont diférents ou ne contiennent pas 8 caractères";
            }
        }

        self::render('users/inscription', [
            'title' => 'Merci de remplir ce formulaire pour vous inscrire',
            'erreurMessage' => $errMsg
        ]);
    }
}
