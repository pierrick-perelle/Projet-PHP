
<?php
echo <<< EOT
    <div style="display:flex;flex-direction:row;justify-content:center">
    <div style="margin-left:1vw;flex-grow:1;flex-shrink:1.1;min-width:18vw;" class="card blue-grey darken-1">
        <div class="card-content white-text">
            <span class="card-title center">
            <p> Catégories </p>
            </span>
            <hr>
            <form method="post" action="index.php">
EOT;
foreach ($listCat as $cat) {
    echo <<< EOT
                <div class="card-action">
                <p>
                    <label>
                      <input name="filtre" type="radio" class="filled-in" value="$cat[0]" />
                      <span class="white-text">$cat[0]</span>
                    </label>
                  </p>
                </div>
EOT;
}
echo <<< EOT
        <div class="card-action">
                <p>
                    <label>
                      <input name="filtre" type="radio" class="filled-in" value="Tous" />
                      <span class="white-text">Tous</span>
                    </label>
                  </p>
                </div>
        <div class="center">
        <input type=hidden name="action" value="filter"/>
        <input type=hidden name="controller" value="Produit"/>
        <button class="white-text orange waves-effect waves-light btn" type="submit">Filtrer</button>
        </div>
        </form>
        </div>
    </div>
<div style="flex-grow:4;flex-shrink:1;display:flex;flex-flow:row wrap;justify-content:center">
EOT;
if(isset($filtre)){
    $tab_result = $filtre;
}
if(isset($_REQUEST['filtre']) && !empty($_REQUEST['filtre'])){
    $p_filtre = htmlspecialchars($_POST['filtre']);
}
foreach ($tab_result as $result) {
    $stock = htmlspecialchars($result->get("stock"));
    $id = htmlspecialchars($result->get("idProduit"));
    $lib = htmlspecialchars($result->get("libelle"));
    $prix = htmlspecialchars($result->get("prix"));
    echo <<< EOT
                <div style="margin-left:2vw;width:20vw;" class="card small">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" alt="hmmmmm.. cookie..." src="https://assets.afcdn.com/recipe/20190529/93153_w1024h768c1cx2220cy1728cxt0cyt0cxb4441cyb3456.jpg">
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
                            <form method="post" action="index.php">
                                <label for="qte">Quantité</label>
                                <input type=number id="qte" name="quantite"  value="1" min="1" max="$stock"/>
                                <input type=hidden id="idproduit" name="idproduit" value="$id"/>
                                <input type=hidden name="action" value="addPanier"/>
                                <input type=hidden name="controller" value="Produit"/>
EOT;
    if (isset($p_filtre)) {
        echo <<< EOT
        <input type=hidden name="filtre" value="$p_filtre"/>
EOT;
    }
    echo <<< EOT
                                <input type=hidden name="filtre" value="$p_filtre"/>
                                <input type=hidden id="idproduit" value="$id"/>
                                <button onclick="M.toast({html: 'Article ajouté !'})" class="btn waves-effect waves-light orange" type="submit">Ajouter au panier</button>
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