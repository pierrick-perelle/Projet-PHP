
<?php 
if ($effect=='cancelled'){
    echo '<div class="alert alert-success mx-5" role="alert"> La commande a bien été annulée !</div>';
}
if (ModelUtilisateur::checkAdmin($_SESSION['login'])){
                        $admin=true;
                    }
else $admin=false;
      //ou mettre un input direct si trop de clients ?
if($admin){
    echo '<form class="text-center" method="post" action="?action=readAll&controller=commande">
    <select class="browser-default custom-select" name="idClient" id="idClient_id">
    <option value="" disabled selected>Sélectionnez un client</option>';
    foreach ($tab_client as $client){
        $idClient=$client->get("idClient");
        echo '<option value="'.htmlspecialchars($idClient).'">'.htmlspecialchars($idClient).'</option>';
    }
    echo '</select> <button class="btn my-4" type="submit">Selectionner</button></form>';
}
?> 

<script src="css/js/ModalArg.js" ></script>
<div class="mx-5 py-4">
    <table class="table product-table">

            <!-- Table head -->
            <thead class="mdb-color lighten-5">
              <tr>
                <?php if($admin){
                    echo '<th class="font-weight-bold">
                  <strong>Nr Client</strong>
                </th>';
                }
?>
                <th class="font-weight-bold">
                  <strong>Nr Commande</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Etat Commande</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Date</strong>
                </th>
                <th class="font-weight-bold">
                    <strong>Prix</strong>
                </th>
                <th class="font-weight-bold">
                  <strong>Actions</strong>
                </th>
            </tr>
        </thead>
        <!-- /.Table head -->
        <tbody>            
		<?php
                    
                    if (empty($tab_Commande)){
                        echo 'Aucune commande enregistrée';
                    }
                    else{
                   foreach ($tab_Commande as $Commande){
                    if ($admin){                   
                        echo '<tr> <th> '.$Commande->get("idClient").' </th> ';
                        echo '<td>'.htmlspecialchars($Commande->get("idCommande")).' </td> ';
                    }
                    else{
                        echo '<tr> <th> '.htmlspecialchars($Commande->get("idCommande")).' </th> ';
                    }
                    echo '<td> '.$Commande->getEtat().' </td> ';
                    echo '<td> '.htmlspecialchars($Commande->get("dateCommande")).'</td> ';
                    echo '<td> '.htmlspecialchars($Commande->get("prixTotal")).'</td> ';
                    echo '<td><a href="?action=read&idCommande='.rawurlencode($Commande->get("idCommande")).'&controller=Commande"><i class="material-icons">search</i></a>';
                    if ($Commande->get("etatCommande")<2){
                        if ($admin){echo '<a class="material-icons send" href="?action=send&idCommande='.rawurlencode($Commande->get("idCommande")).'&controller=Commande">send</a>';}
                        echo '<a class="material-icons annuler" data-toggle="modal" data-target="#confirmation" data-id='.rawurlencode($Commande->get("idCommande")).'>cancel</a></td></tr>';
                        
                            }
                            
                        } 
                    }
        ?>
         </tbody>
<!-- prompt de confirmation d annulation de commande -->         
  <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmation">Annuler la commande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment annuler cette commande ?
      </div>
      <div class="modal-footer">
         <form method="post" action="?action=cancel&controller=commande">
        <input type="hidden" name="idCommande" id="idCommande" value=""/>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
        <button class="btn btn-info my-4 orange accent-4" type="submit">Annuler</button>
         </form>
      </div>
    </div>
  </div>
</div>

</table>
<div class="text-center py-3" style="padding-top:40px;">
      <a class="waves-effect waves-light btn orange accent-4 white-text text-lighten-4 effet" href="?action=readAll&controller=panier">Acceder au panier</a>
</div>

