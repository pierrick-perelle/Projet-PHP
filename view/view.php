<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <p style="border: 1px solid black;text-align:center;padding-right:1em;">
        <a href="index.php?action=readAll">Page d'accueil</a>
        <a href="index.php?action=readAll&controller=utilisateur">Page User</a>
        <a href="index.php?action=readAll&controller=trajet">Page Trajet</a>
        </p>
<?php
// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;
?>
        <p style="border: 1px solid black;text-align:center;padding-right:1em;">
             Site de covoiturage
        </p>
    </body>
</html>



