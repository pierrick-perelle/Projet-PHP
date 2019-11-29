<?php
    session_start();
    #unset($_SESSION['panier']);
    #unset($_SESSION['prix']);
    #$prixTotal=0;
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
    }
    if(!isset($_SESSION['prix'])){
        $_SESSION['prix'] = 0;
    }
    $DS = DIRECTORY_SEPARATOR;
    require_once __DIR__.$DS.'lib'.$DS.'File.php';
    require_once File::build_path(array("controller","routeur.php"));
    
    /*if(isset($_SESSION['panier'])){
    #    foreach($_SESSION['panier'] as $product){
    #        $object = ModelProduit::getProduitById($product[0]);
    #        $prixTotal += $object->get("prix") * $product[1];
    #        }
    #    var_dump($_SESSION['panier']);
    #    $_SESSION['prix'] = $prixTotal;
    #    }
    #echo $_SESSION['prix'];
//    $s = __DIR__.$DS.'lib'.$DS.'file.php';
//    echo $s;*/

?>

