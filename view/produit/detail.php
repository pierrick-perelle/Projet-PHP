
<?php

echo 'Produit: ' . $v->get("idProduit") . ' libelle: ' . $v->get("libelle") . ' prix: ' . $v->get("prix") . ' stock: ' . $v->get("stock") . ' description: ' . $v->get("description");
?>
    <form method="post" name="formProduit" action="?action=addPanier&controller=Produit">
      <input class="form-control" type="number" placeholder="Quantité" min="0" max="<?php echo $v->get('stock'); ?>" name="quantite" id="quantite" value="1" required/>
      <input type="hidden" name="idproduit" id="idproduit" value="<?php echo $v->get("idProduit") ?>" />

        <div class="center">
          <button class="btn btn-info my-4 btn-block orange accent-4" type="submit">
            Ajouter au panier
          </button>
        </div>
      <div class="center">
          <button class="btn btn-info my-4 btn-block orange accent-4 directOrder" type="submit">
            Acheter en un clic
          </button>
    </div>
       </form>
    
</body>
</html>
