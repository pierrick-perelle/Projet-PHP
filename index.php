<?php
    $DS = DIRECTORY_SEPARATOR;
//    $s = __DIR__.$DS.'lib'.$DS.'file.php';
//    echo $s;
    require_once __DIR__.$DS.'lib'.$DS.'file.php';
    require_once file::build_path(array("controller","routeur.php"));

?>

