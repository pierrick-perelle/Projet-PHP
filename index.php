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
?>
