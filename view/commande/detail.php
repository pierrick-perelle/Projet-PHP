<div class="text-center m-2 py-3" style="padding-top:40px;">
    <a href="?action=readAll&controller=commande" class="btn btn-info my-4 btn-block orange accent-4">Retour</a>
</div>
<?php
echo 'Commande Numéro : '.$commande->get('idCommande');
echo '<br> Date de commande : '.$commande->get('dateCommande');
echo '<br> Prix total: '.$commande->get('prixTotal');

$listeProduits=$commande->get('listeProduits');
?>
<div class="mx-5 py-4">
    <table class="table product-table">

        <!-- Table head -->
        <thead class="mdb-color lighten-5">
        <tr>
            <th class="font-weight-bold">
                <strong>Produit</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Quantité</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Prix à l'unité</strong>
            </th>
            <th class="font-weight-bold">
                <strong>Sous-total</strong>
            </th>
        </tr>
        </thead>
        <!-- /.Table head -->

        <tbody>
<?php
foreach($listeProduits as $cle => $valeur){
    $prixUnite=ModelProduit::select($cle)->get("prix");
echo '<tr><th scope="row">'.ModelProduit::select($cle)->get("libelle").'</th>';
echo '<td>'.$valeur.'</td>';
echo '<td>'.$prixUnite.'</td>';
echo '<td>'.$valeur*$prixUnite.'</td></tr>';
}
?>
        </tbody>
    </table>
<div class="text-center m-2 py-3" style="padding-top:40px;">
     <a href="?action=reiterate&controller=commande&idCommande=<?php echo $commande->get('idCommande');?>" class="btn btn-info my-4 btn-block orange accent-4">Refaire cette commande</a>
</div>


