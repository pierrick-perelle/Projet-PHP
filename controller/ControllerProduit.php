<?php
// chargement du modèle
require_once(File::build_path(array("model","ModelProduit.php")));

Class ControllerProduit{
    public static function readAll(){
        $tab_v = ModelProduit::getAllProduits();     //appel au modèle pour gerer la BD
        require(File::build_path(array("view","produit","list.php")));
    } //redirige vers la vue

    public static function read(){
        $v = ModelProduit::getProduitById($_GET['idprod']);
        if(empty($v)){
            require(File::build_path(array("view","produit","error.php")));
        }
        else{
            require(File::build_path(array("view","produit","detail.php")));
        }
    }
    public static function create(){
        require(File::build_path(array("view","produit","create.php")));
    }

    public static function created(){

        $idprod = $_GET['idProduit'];
        $lib = $_GET['libelle'];
        $prixprod = $_GET['prixProduit'];
        $stock = $_GET['stock'];
        $desc = $_GET['desc'];

        $prod = new ModelProduit($idprod,$lib,$prixprod,$stock,$desc);
        $v = $prod->save();
        if($v==false){
            echo 'erreur duplication';
        }
        else{
            self::readAll();
        }
    }

    public static function delete(){

        $idprod = $_GET['idprod'];
        $v = ModelProduit::delete($idprod);

        if($v){
            echo 'le produit à été supprimé avec succés';
        }
        else{
            require(File::build_path(array("view","produit","error.php")));
        }
    }
}

?>