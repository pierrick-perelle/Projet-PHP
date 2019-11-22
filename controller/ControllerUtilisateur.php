<?php
require_once(File::build_path(array("model","ModelUtilisateur.php")));
require_once (File::build_path(array("lib","Security.php"))); // chargement du modèle
require_once (File::build_path(array("lib","Session.php"))); // chargement du modèle

class ControllerUtilisateur{
    
protected static $object = 'utilisateur';

    public static function readAll() {
        if (Session::is_admin()) {
            $tab_v = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $view='list';
            $pagetitle='Liste des Utilisateurs';
            require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
        } else {
            header('Location: ./');
            exit();  
        }
        
    }
    public static function read() {
        if ($_GET['login']===$_SESSION['login'] or Session::is_admin()==true) {
            $v = ModelUtilisateur::select($_GET['login']);     //appel au modèle pour gerer la BD
            $view='';
            $pagetitle='';
            if ($v==null) {
                $view='error';
                $pagetitle='Erreur de lecture';                                   //"redirige" vers la vue
            } else {
                $view='detail';
                $pagetitle='Détail '.$_GET['login'] ;                   //"redirige" vers la vue
            }
            require (File::build_path(array("view","view.php")));
        } else {
            header('Location: ./');
            exit();
        }  	
    }
    public static function delete() {
    	if ($_GET['login']===$_SESSION['login'] or Session::is_admin()==true) {
	        if (ModelUtilisateur::delete($_GET['login'])===false) {
	            $view='error';
	            $pagetitle='Erreur suppression';
	        } else {
	            $tab_v = ModelUtilisateur::selectAll();
	            $view='deleted';
	            $pagetitle='Liste des utilisateurs';
	        }
	    } else {
            header('Location: ./index.php?action=connect&controller=Utilisateur');
            exit();
        }
        require (File::build_path(array("view","view.php")));
    }
    public static function create() {
        $input="required";
        $effect="created";
        $v = new ModelUtilisateur();
        $view='update';
        $pagetitle='Inscription';
        require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
    }
    public static function connect() {
        $view='connexion';
        $pagetitle='Connexion';
        require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
    }

    public static function connected(){
        require_once(File::build_path(array('lib','Security.php')));
        $couple = ModelUtilisateur::checkPassword($_POST['login'],Security::chiffrer($_POST['mdp']));
        if($couple){
            $_SESSION['login'] = $_POST['login'];
            $u = ModelUtilisateur::select($_POST['login']);
            $view='detail';
            $pagetitle = 'Vos details';
            require_once(File::build_path(array('view','utilisateur','view.php')));
        }
        else {
            echo 'invalide login ou password';
        }
    }
    }