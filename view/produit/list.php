<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>
<body>
<?php
foreach ($tab_v as $v)
    echo 'Produit: '.'<a href ="routeur.php?action=read&idprod='.$v->getIdProduit().'">'.$v->getIdProduit() .'</a> || '.'<a href="routeur.php?action=delete&idprod='.$v->getIdProduit().'">'.'Supprimer'.'</a>';
?>
</body>
</html>