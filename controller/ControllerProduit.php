<?php

// chargement du modèle
require_once(File::build_path(array("model", "ModelProduit.php")));

Class ControllerProduit {

    public static $object = "produit";

    public static function readAll() {
        $listCat = ModelProduit::getListCat();
        //var_dump($listCat);
        $tab_result = ModelProduit::selectAll();     //appel au modèle pour gerer la BD
        $controller = 'produit';
        $view = 'list';
        $pagetitle = 'Liste des produits';
        require(File::build_path(array("view", "view.php")));
    }

//redirige vers la vue

    public static function read() {
        $v = ModelProduit::select($_GET['idprod']);
        if (empty($v)) {
            $view = 'error';
            require(File::build_path(array("view", "view.php")));
        } else {
            $view = 'detail';
            require(File::build_path(array("view", "view.php")));
        }
    }

    public static function create() {
        require(File::build_path(array("view", "produit", "create.php")));
    }

    public static function created() {

        $lib = $_GET['lib'];
        $prixprod = $_GET['prixprod'];
        $stock = $_GET['stock'];
        $desc = $_GET['desc'];

        $prod = new ModelProduit($lib, $prixprod, $stock, $desc);
        $v = $prod->save();
        if ($v == false) {
            echo 'erreur duplication';
        } else {
            self::readAll();
        }
    }

    public static function delete() {

        $idprod = $_GET['idprod'];
        $v = ModelProduit::delete($idprod);

        if ($v) {
            echo 'le produit à été supprimé avec succés';
        } else {
            require(File::build_path(array("view", "produit", "error.php")));
        }
    }

    public static function addPanier() {
        ModelProduit::ajoutProduitPanier($_POST['idproduit'], $_POST['quantite']);
        self::filter();
    }

    public static function readPanier() {
        $controller = 'produit';
        $view = 'panier';
        $pagetitle = 'Liste des produits';
        require(File::build_path(array("view", "view.php")));
    }

    public static function modify() {
        ModelProduit::modifierQuantite($_POST['key'], $_POST['qte']);
        $controller = 'produit';
        $view = 'panier';
        $pagetitle = 'Liste des produits';
        require(File::build_path(array("view", "view.php")));
    }

    public static function deleteProduct() {
        ModelProduit::supprimerProduit($_POST['key']);
        $controller = 'produit';
        $view = 'panier';
        $pagetitle = 'Liste des produits';
        require(File::build_path(array("view", "view.php")));
    }

    public static function filter() {
        //var_dump($_COOKIE['filtre']);
        //var_dump($_REQUEST['filtre']);
        //var_dump($_POST['filtre']);
        if (!isset($_REQUEST['filtre']) || $_REQUEST['filtre'] == trim("Tous")) {
            self::readAll();
        } else {
            $listCat = ModelProduit::getListCat();
            $filtre = ModelProduit::getProduitByCat($_REQUEST['filtre']);
            $controller = 'produit';
            $view = 'list';
            $pagetitle = 'Liste des produits';
            require(File::build_path(array("view", "view.php")));
        }
    }

}

?>
