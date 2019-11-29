<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des produits</title>
</head>
<body>
<?php
foreach ($tab_result as $result){
    $stock = htmlspecialchars($result->get("stock"));
    $id = htmlspecialchars($result->get("idProduit"));
    echo 'Produit: '.'<a href ="?action=read&idprod='.$result->get("idProduit").'">'.$result->get("libelle") .'</a> || '.'<a href="?action=delete&idprod='.$result->get("idProduit").'">'.'Supprimer'.'</a>';
    echo <<< EOT
                <form method="get" action="index.php">
                    <label for="qte">Quantité</label>
                    <input type=number id="qte" name="quantite"  value="1" min="1" max="$stock"/>
                    <input type=hidden id="idproduit" name="idproduit" value="$id"/>
                    <input type=hidden name="action" value="addPanier"/>
                    <input type=hidden name="controller" value="Produit"/>
                    <input type=hidden id="idproduit" value="$id"/>
                    <input type="submit" value="Ajouter au panier"/>
                </form>
EOT;
}
?>
</body>
</html>