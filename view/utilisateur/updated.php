<?php
echo "L'utilisateur de login ".htmlspecialchars($_POST['login'])." a été mis à jour";
$chemin=array('view','utilisateur','list.php');
require_once (File::build_path($chemin));
?>