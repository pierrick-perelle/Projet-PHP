<?php
  //$panier = serialize(array($_GET['idproduit'],$_GET['quantite']));
  $panier = array($_GET['idproduit'],$_GET['quantite']);
  echo "A";
  var_dump($panier);
  echo "B";
  if(isset($_SESSION['panier'])){
    array_push($_SESSION['panier'],$panier);
  }
  else{
      $_SESSION['panier'] = array();
      array_push($_SESSION['panier'],$panier);
  }
  var_dump($_SESSION['panier']);
  #header('Location: http://webinfo/~perellep/Projet/index.php?action=readAll');
  #exit();
?>

