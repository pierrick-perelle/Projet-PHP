<?php
require_once(File::build_path(array("ControllerVoiture.php")));
require(File::build_path(array("file","File.php.php")));
// On recupère l'action passée dans l'URL
$action = $_GET['action'] ;
// Appel de la méthode statique $action de ControllerProduit
ControllerProduit::$action();
?>