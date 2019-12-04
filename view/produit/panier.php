
<?php
foreach ($_SESSION['panier'] as $key => $article){
    $produit = ModelProduit::select($article[0]);
    $idp_html = htmlspecialchars($produit->get("idProduit"));
    $libelle_html = htmlspecialchars($produit->get("libelle"));
    $prix_html = htmlspecialchars($produit->get("prix"));
    $stock_html = htmlspecialchars($produit->get("stock"));
    $desc_html = htmlspecialchars($produit->get("description"));
    $prix_pile =  $prix_html * $article[1];
    echo <<< EOT
                <div>
                <fieldset>
                    <div style="display:flex;wrap:nowrap;flex-direction:row;height:10vh;">
                        <div style="width:70vw;">
                            <p><b>$libelle_html</b></br></br>
                            $desc_html </p>
                        </div>
                        <div style="width:30vw;">
                            <p> Prix unitaire : $prix_html
                                Quantité : $article[1]
                                <form method="post" action="index.php?action=modify">
                                <label for="qte">Modifer la quantité</label>
                                <input type=number id="qte" name="qte" min="1" max="$stock_html"/>
                                <input type=hidden name="controller" value="Produit"/>
                                <input type=hidden name="key" value="$key"/>
                                <input type="submit" value="Modifier"/>
                                </form>
                                Prix de la pile : $prix_pile
                        </div>
                    </div>
                    
                </fieldset>
                </div>
EOT;
}
?>

