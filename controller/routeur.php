<?php

require_once(File::build_path(array("controller", "ControllerProduit.php")));
require_once(File::build_path(array("controller", "ControllerUtilisateur.php")));

// On recupère l'action passée dans l'URL
//var_dump($_REQUEST);
//phpinfo();

if (isset($_REQUEST['controller'])) {
    $controller = $_REQUEST['controller'];
} else {
    //controller par defaut si pref definie dans cookie
    if (isset($_COOKIE['preference'])) {
        echo '<p> preference : ' . $_COOKIE['preference'] . '</p>';
        $controller = $_COOKIE['preference'];
    }
    //controller par defaut
    else {
        $controller = 'produit';
    }
}

$controller_class = 'Controller' . ucfirst($controller);

if (class_exists($controller_class)) {
//on recupere l'action passée dans l'url
    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        //verif qu'action soit valide
        $availMethods = get_class_methods($controller_class);
        if (in_array($action, $availMethods)) {
            // Appel de la méthode statique $action du controller transmis
            $controller_class::$action();
        } else {
            $controller_class::error();
        }
    }
    //appel de la page par défaut
    else {
        $controller_class::readAll();
    }
} else {
    ControllerProduit::error();
}

function myGet($nomvar) {
    if (isset($_REQUEST[$nomvar])) {
        return $_REQUEST[$nomvar];
    } else {
        if (isset($_REQUEST[$nomvar])) {
            return $_REQUEST[$nomvar];
        } else {
            return null;
        }
    }
}
