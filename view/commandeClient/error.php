<p>
<?php
if (isset($error)){
	echo $error;
} else {
	echo "Erreur d'insertion";
}  ?>
</p>
<div class="center" style="padding-top:40px;">
	  	<a class="waves-effect waves-light btn blue grey-text text-lighten-4 effet" href="?action=read&controller=panier">Retourner à la gestion</a>
</div>