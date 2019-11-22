<?php
    session_start();
    $DS = DIRECTORY_SEPARATOR;
    require_once __DIR__.$DS.'lib'.$DS.'File.php';
    require_once File::build_path(array("controller","routeur.php"));
    if(isset($_SESSION['panier'])){
        var_dump($_SESSION['panier']);
        foreach($_SESSION['panier'] as $product){
            $object = ModelProduit::getProduitById($product[0]);
            $_SESSION['prix'] += $object->getPrixProduit();
        }
    }
//    $s = __DIR__.$DS.'lib'.$DS.'file.php';
//    echo $s;

?>

