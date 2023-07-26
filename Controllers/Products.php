<?php
namespace Controllers;

class Products extends Controller{
    public static function accueil(){
        // echo "Vous etes sur la méthode accueil";
        // On fait appelle à la méthode findAll du modele products pour récuperer les produits
        $products = \Models\Products::findAll("date DESC", 2);
        // On utilise la méthode render du controller principal pour afficher la bonne vue avec les bonnes infos



        self::render('Products/accueil', [
            'title' => 'les deux derniers produits',
            'products' => $products
        ]);
    }

    // Méthode pour récuperer un produit par son id et l'envoyer à la vue detailproduct
    public static function detailProduct(){
        if(isset($_GET['id'])){
            $idProduct = $_GET['id'];
            echo $idProduct;
            $product = \Models\Products::findById($idProduct);
            $err = !$product ? "le produit n'existe pas" : null;
            // echo $err;

            // Apres avoir récuperer le produit je recupere le user proprietaire du produit
            // pour pouvoir utiliser son adress
            $idUser = $product['idUser'];
            $userProduct = \Models\Users::findById($idUser);
            
            // j'utilise le render
            self::render('products/detailProduct', [
                'title' => "détail du produit", 
                'product' => $product,
                'user' => $userProduct,
                'erreur' => $err
            ]);
        } 
    }
}