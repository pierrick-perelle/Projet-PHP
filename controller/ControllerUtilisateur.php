<?php
require_once(File::build_path(array("model","ModelUtilisateur.php")));
require_once (File::build_path(array("lib","Security.php"))); // chargement du modèle
require_once (File::build_path(array("lib","Session.php"))); // chargement du modèle

class ControllerUtilisateur{
    
protected static $object = 'utilisateur';

    public static function readAll() {
        /*if (Session::is_admin()) {
            $tab_v = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
            $view='list';
            $pagetitle='Liste des Utilisateurs';
            require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
        } else {
            header('Location: ./');
            exit();  
        }*/
        $tab_u = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        $view='list';
        $pagetitle='Liste des Utilisateurs';
        require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
        
    }
    public static function read() {
        //if ($_GET['login']===$_SESSION['login'] or Session::is_admin()==true) {
            $u = ModelUtilisateur::select($_GET['login']);     //appel au modèle pour gerer la BD
            $view='';
            $pagetitle='';
            if ($u==null) {
                $view='error';
                $pagetitle='Erreur de lecture';//"redirige" vers la vue
            } else {
                $view='detail';
                $pagetitle='Détail '.$_GET['login'] ;//"redirige" vers la vue
            }
            require (File::build_path(array("view","view.php")));
       // } else {
            //header('Location: ./');
           // exit();
        //}
    }
    public static function delete() {
    	//if ($_GET['login']===$_SESSION['login'] or Session::is_admin()==true) {
	        if (ModelUtilisateur::delete($_GET['login'])===false) {
	            $view='error';
	            $pagetitle='Erreur suppression';
	        } else {
	            $tab_v = ModelUtilisateur::selectAll();
	            $view='deleted';
	            $pagetitle='Liste des utilisateurs';
	        }
	   /* } else {
            header('Location: ./index.php?action=connect&controller=Utilisateur');
            exit();
        }*/
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

    public static function created(){

        require_once(File::build_path(array('lib', 'Security.php')));
        $chiffre = Security::chiffrer($_POST['mdp']);

        if ($_POST['mdp'] == $_POST['mdp2']) {
            $_POST['mdp'] = $chiffre;
            unset($_POST['mdp2']);
            ModelUtilisateur::save($_POST);
            $tab_u = ModelUtilisateur::selectAll();
            $table_name = "utilisateur";
            $view = 'connexion';
            $pagetitle = 'Connectez-vous';
            $chemin = array('view','view.php');
            require_once(File::build_path($chemin));
        }
    }
    public static function update(){
        $control=static::$object;
        $view='update';
        $effect="updated";
        $pagetitle='Liste des utilisateurs';
        $v = ModelUtilisateur::select($_GET['login']);
        $effect='updated';
        $input='required';
        require_once (File::build_path(array("view","view.php")));
    }
    public static function updated()
    {
        require_once(File::build_path(array('lib', 'Security.php')));
        $chiffrer = Security::chiffrer($_POST['mdp']);
        //var_dump($chiffrer);
        if (!is_null(myGet('admin'))) {
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }
        $data = array(
            "login" => $_POST['login'],
            "nomClient" => $_POST['nomClient'],
            "prenomClient" => $_POST['prenomClient'],
            "mdp" => $chiffrer,
            "mailClient" => $_POST['mailClient'],
            "admin" => $isAdmin
        );
        require_once(File::build_path(array('lib', 'Session.php')));
        if (empty($_SESSION['login']) || myGet('login') != $_SESSION['login'] && !Session::is_admin()) {
            header("Location: connect.php");
        }
        if (myGet('password') != myGet('password_confirm')) {
            $verif = false;
        } else {
            ModelUtilisateur::update($data);
            $verif = true;
        }
        $tab_u = ModelUtilisateur::selectAll();
        $view = 'updated';
        $pagetitle = 'Liste des utilisateurs';
        require_once(File::build_path(array('view','view.php')));
    }

    public static function connect($effet=null) {
        $effect=$effet;
        $view='connexion';
        $pagetitle='Connexion';
        require (File::build_path(array("view","view.php")));  //"redirige" vers la vue
    }

    public static function connected(){
        if (isset($_GET['effect'])){
            $effect=$_GET['effect'];
        }
        require_once(File::build_path(array('lib','Security.php')));
        $couple = ModelUtilisateur::checkPassword($_POST['login'],Security::chiffrer($_POST['mdp']));
        if($couple){
            $_SESSION['login'] = $_POST['login'];
            if (ModelUtilisateur::checkAdmin($_POST['login'])){
                $_SESSION['admin'] = true;
            }else{
                $_SESSION['admin'] = false;
            }
            $u=ModelUtilisateur::select($_POST['login']);
            $view='detail';
            $pagetitle='detail de l\'utilisateurs';
            if (isset($effect)){
            if ($effect=='redirect'){
                ControllerCommandeClient::create();
                }
            }

            require_once (File::build_path(array('view','view.php')));
        }else{
            echo "login ou mot de passe incorrect ou le compte n'a pas été valider par l'adresse mail";
            $pagetitle='Connexion - erreur de mdp';
            $view="connexion";
            require_once (File::build_path(array('view','view.php')));
        }
    }
    public static function deconnect(){
        session_unset();
        session_destroy();
        echo '<script type="text/javascript">
            alert("Vous avez été déconnecté");
            document.location.href = "index.php";
        </script>';
    }
    }