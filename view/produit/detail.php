<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail des produits</title>
</head>
<body>
<?php

echo  'Produit: '.$v->getIdProduit().' libelle: ' . $v->getLibelle() . ' prix: '.$v->getPrixProduit() . ' stock: '.$v->getStock() . ' description: ' . $v->getDescription() ;

?>
</body>
</html>