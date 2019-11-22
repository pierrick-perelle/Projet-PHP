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
    echo 'Produit: '.'<a href ="?action=read&idprod='.$v->getIdProduit().'">'.$v->getLibelle() .'</a> || '.'<a href="?action=delete&idprod='.$v->getIdProduit().'">'.'Supprimer'.'</a>';
    echo <<< EOT
                <form method="get" action="index.php">
                    <label for="qte">Quantité</label>
                    <input type=number id="qte" name="quantite"  value="1" min="1" max="$stock"/>
<<<<<<< HEAD
                    <input type=hidden id="idproduit" name="idproduit" value="$id"/>
                    <input type=hidden name="action" value="addPanier"/>
                    <input type=hidden name="controller" value="Produit"/>
=======
                    <input type=hidden id="idproduit" value="$id"/>
                    <input type=hidden name="action" value="readAll"/>
>>>>>>> Viala
                    <input type="submit" value="Ajouter au panier"/>
                </form>
EOT;
}
?>
</body>
</html>