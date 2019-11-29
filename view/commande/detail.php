<?php

foreach($listeProduits as $cle -> $valeur){
echo '<tr><th scope="row">'.ModelProduit::select($cle)->get("nomProduit").'</th>';
echo '<td>'.$valeur.'</td>';
echo '<td>'.$valeur*ModelProduit::select($cle)->get("prixProduit").'euros </td>';

}
?>

