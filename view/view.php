<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <p style="border: 1px solid black;text-align:center;padding-right:1em;">
        <a href="index.php?action=readAll">Les Produits</a>
        <a href="index.php?action=readAll&controller=utilisateur">Mon Panier</a>
        <a href="index.php?action=readAll&controller=trajet">Connexion</a>
        </p>
<?php
// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;
?>
        <p style="border: 1px solid black;text-align:center;padding-right:1em;">
             Site Projet
        </p>
    </body>
</html>



