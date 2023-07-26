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
    // Méthode qui gere la récuperation et l'affichage de tous les produits
    public static function AffichageProducts(){
        // je recupere tous les produits
        $products = \Models\Products::findAll();

        // pour mon formulaire de tri, je recupere toutes les categorie
        $categories =\Models\Categories::findAll();

        // je recupere tous les produits avec ou san filtre
        if(isset($_GET['idCat']) && $_GET['idCat'] != ""){
            $idCat = $_GET['idCat'];
            $products = \Models\Products::findByCat($idCat);
        }else{
            $products = \Models\Products::findAll();
        }

        // j'utilise render() pour envoyer ces produits à la bonne vue
        self::render('Products/accueil', [
            'title' => 'tous les produits de mon bon coin',
            'products' => $products,
            'categories' => $categories
        ]);

    }
}