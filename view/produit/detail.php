<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail des produits</title>
</head>
<body>
<?php
var_dump($v);
echo  'Produit: '.$v->get("idProduit").' libelle: ' . $v->get("libelle") . ' prix: '.$v->get("prix") . ' stock: '.$v->get("stock") . ' description: ' . $v->get("description");

?>
</body>
</html>