<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>
<body>
<?php
foreach ($tab_v as $v){
    $stock = htmlspecialchars($v->getStock());
    $id = htmlspecialchars($v->getIdProduit());
    echo 'Produit: '.'<a href ="routeur.php?action=read&idprod='.$v->getIdProduit().'">'.$v->getLibelle() .'</a> || '.'<a href="routeur.php?action=delete&idprod='.$v->getIdProduit().'">'.'Supprimer'.'</a>';
    echo <<< EOT
                <form method="get" action="ajout.php">
                    <label for="qte">Quantité</label>
                    <input type=number id="qte" name="quantite"  value="1" min="1" max="$stock"/>
                    <input type=hidden id="idproduit" value="$id"/>
                    <input type="submit" value="Ajouter au panier"/>
                </form>
EOT;
}
?>
</body>
</html>