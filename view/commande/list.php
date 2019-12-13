<div class="mx-5 py-4">
    <table class="table product-table">

        <!-- Table head -->
        <thead class="mdb-color lighten-5">
            <tr>
                <th class="font-weight-bold">
                    <strong>Nom</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Produit</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Quantité</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Date</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Prix</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Action</strong>
                </th>
            </tr>
        </thead>
        <!-- /.Table head -->

        <tbody>
            <?php
            foreach ($tab_Commande as $Commande) {
                $cli = ModelClient::select($Commande->get("idClient"));
                echo '<tr> <th> ' . $cli->get('nomClient') . '</th> ';
                echo '<td> ' . htmlspecialchars($Commande->get("idCommande")) . '</td> ';
                echo '<td> ' . htmlspecialchars($Commande->get("dateCommande")) . '</td> ';
                echo '<td> ' . htmlspecialchars($Commande->get("prixTotal")) . '</td> ';
                //echo '<td>' . '<a href="?action=delete&idCommandeClient='.rawurlencode($Commande->get("idCommandeClient")).'&controller=CommandeClient"><i class="material-icons">delete</i></a>';                 
                /* echo '<form method="post" action="?action=update&controller=commande">
                  <input type="hidden" name="idProduit" id="idProduit_id" value="'.htmlspecialchars($Commande->get("idProduit")).'">
                  <input type="hidden" name="idFournisseur" id="idFournisseur_id" value="'.htmlspecialchars($Commande->get("idFournisseur")).'">
                  <input id="idCommande" name="idCommande" type="hidden" value="'.htmlspecialchars($Commande->get("idCommande")).'">
                  <div class="white-text">
                  <button class="btn btn-info my-4 btn-block orange accent-4" type="submit">Modifier</button>
                  </div>
                  </p>
                  </form>'. '</td>'; */
                echo '<td>' . '<a href="?action=detail&idCommande=' . rawurlencode($Commande->get("idCommande")) . '&controller=Commande"><i class="material-icons">search</i></a>';
            }
            ?>
        </tbody>
    </table>
    <div class="text-center py-3" style="padding-top:40px;">
        <a class="waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=create&controller=commande">Créer une commande</a>
    </div>

