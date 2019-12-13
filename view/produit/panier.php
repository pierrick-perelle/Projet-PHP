
<?php

if (!isset($_SESSION['prix'])) {
    $_SESSION['prix'] = 0;
}
$prix_total = $_SESSION['prix'];

foreach ($_SESSION['panier'] as $key => $article) {
    if (is_numeric($article[1])) {
        $produit = ModelProduit::select($article[0]);
        $idp_html = htmlspecialchars($produit->get("idProduit"));
        $libelle_html = htmlspecialchars($produit->get("libelle"));
        $prix_html = htmlspecialchars($produit->get("prix"));
        $stock_html = htmlspecialchars($produit->get("stock"));
        $desc_html = htmlspecialchars($produit->get("description"));
        $prix_pile = $prix_html * $article[1];
    } else {
        break;
    }
    echo <<< EOT
                  <div class="row">
                    <div class="col s9 m9">
                      <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                          <span class="card-title">$libelle_html</span><span class="right">Prix unitaire : $prix_html €
                                Quantité : $article[1]</span>
                          <p>$desc_html</p>
                        </div>
                      </div>
                    </div>
                    <div class="col s3 m3">
                      <div class="card blue-grey darken-1">
                        <div class="center card-content white-text">
                          <form method="post" action="index.php?action=modify">
                                <label for="qte">Modifer la quantité</label>
                                <input type=number id="qte" name="qte" min="1" value="$article[1]" max="$stock_html"/>
                                <input type=hidden name="controller" value="Produit"/>
                                <input type=hidden name="key" value="$key"/>
                                <input class="btn orange wave-light" type="submit" value="Modifier"/>
                          </form>
                          <hr>
                          <form method="post" action="index.php?action=deleteProduct">
                                <input type="hidden" name="controller" value="Produit"/>
                                <input type=hidden name="key" value="$key"/>
                                <input class="btn orange wave-light" type="submit" value="Supprimer"/>
                          </form>
                                <p class="center">Prix de la pile : $prix_pile €</p>
                        </div>
                      </div>
                    </div>
                  </div>
EOT;
}
    echo <<< EOT
                <hr width="90%"></hr>
                <h4 class="center">$prix_total €</h4>
EOT;
    if ($_SESSION['prix']!=0) {
        echo <<< EOT
                <hr width="15%"></hr>
                <div class="center">
                <a class="btn orange wave-light center" href="?action=checkLogged&controller=Commande" >Commander</a>
                </div>';    
                <hr width="15%"></hr>
                <div class="center">
                <a class="btn orange wave-light center" href="?action=viderPanier&controller=Produit"/>Vider le panier</a>
                </div>
EOT;
    }
?>

