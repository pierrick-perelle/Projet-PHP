<?php
    session_start();
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
    }
    if(!isset($_SESSION['prix'])){
        $_SESSION['prix'] = 0;
    }
    $DS = DIRECTORY_SEPARATOR;
    require_once __DIR__.$DS.'lib'.$DS.'File.php';
    require_once File::build_path(array("controller","routeur.php"));
    if(isset($_SESSION['panier'])){
        foreach($_SESSION['panier'] as $product){
            $object = ModelProduit::getProduitById($product[0]);
            $_SESSION['prix'] += $object->getPrixProduit();
            echo "$object->getPrixProduit()";
        }
    }
    echo $_SESSION['prix'];
//    $s = __DIR__.$DS.'lib'.$DS.'file.php';
//    echo $s;

?>

