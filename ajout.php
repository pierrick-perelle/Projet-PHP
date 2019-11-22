<?php
  //$panier = serialize(array($_GET['idproduit'],$_GET['quantite']));
  $panier = array($_GET['idproduit'],$_GET['quantite']);
  if(isset($_SESSION['panier'])){
    array_push($_SESSION['panier'],$panier);
  }
  else{
      $_SESSION['panier'] = array();
      array_push($_SESSION['panier'],$panier);
  }
  header('Location: File::build_path(array("index.php")');
  exit();
?>

