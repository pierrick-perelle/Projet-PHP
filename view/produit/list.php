
<?php

echo '<div style="display:flex;flex-direction:row;justify-content:center">';
echo <<< EOT
    <div style="margin-left:1vw;flex-grow:1;flex-shrink:1.1;" class="card blue-grey darken-1">
        <div class="card-content white-text">
            <span class="card-title center">
            <p> Catégories </p>
            </span>
            <p> _______________________________________________</p>
        </div>
        <div class="card-action">
        </div>
        <div class="card-action">
        </div>
        <div class="card-action">
        </div>
    </div>
EOT;
echo '<div style="flex-grow:4;flex-shrink:1;display:flex;flex-flow:row wrap;justify-content:center">';
foreach ($tab_result as $result) {
    $stock = htmlspecialchars($result->get("stock"));
    $id = htmlspecialchars($result->get("idProduit"));
    $lib = htmlspecialchars($result->get("libelle"));
    $prix = htmlspecialchars($result->get("prix"));
    echo <<< EOT
                <div style="margin-left:2vw;width:20vw;" class="card small">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="https://assets.afcdn.com/recipe/20190529/93153_w1024h768c1cx2220cy1728cxt0cyt0cxb4441cyb3456.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">$lib<i class="material-icons right">add_shopping_cart</i></span>
                        <p><a href="index.php?action=read&idprod=$id">En savoir plus</a></p>
                        <p class="right">
                        $prix €    
                        </p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">$lib<i class="material-icons right">close</i></span>
                        <p>
                            <form method="post" action="?action=addPanier&controller=Produit">
                                <label for="qte">Quantité</label>
                                <input type=number id="qte" name="quantite"  value="1" min="1" max="$stock"/>
                                <input type=hidden id="idproduit" name="idproduit" value="$id"/>
                                <input onclick="M.toast({html: 'Article ajouté !'})" class="btn waves-effect waves-light orange" type="submit" value="Ajouter au panier"/>
                            </form>
                            <div>
                                <h5 class="right">$prix €</h5>
                            </div>
                        </p>
                    </div>
                </div>
EOT;
}
echo '</div>';
?>