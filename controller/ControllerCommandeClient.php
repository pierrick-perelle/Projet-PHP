<?php
require_once File::build_path(array("model", "ModelCommandeClient.php"));
require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));

class ControllerCommandeClient{
    protected static $object='commandeClient';
    
    public static function readAll() {
        $tab_Commande = ModelCommandeClient::selectAll(); 
        $view='list';
        $pagetitle='Liste des Commandes clients';
        require (File::build_path(array("view","view.php")));    
    }
    public static function created() {
        $commandeEnCours=unserialize(base64_decode($_POST['commandeEnCours']));
        $dateLivraison=$_POST['dateLivraison'];
        $commandeEnCours->set('dateLivraison',$dateLivraison);
        if (empty($_data)) {
            $tab_Commande = ModelCommandeClient::selectAll(); 
            $view='list';
            $pagetitle='Liste des Commandes';
        }else {
            if (ModelCommandeClient::save($_POST) === false || $commandeEnCours->saveList()==false) {
                $view = 'error';
                $pagetitle = 'Erreur insertion';
                $error = 'Erreur : la Commande existe déjà / impossible d inserer';
            } else {
                $view='list';
                /*$tab_Commande = ModelCommandeClient::selectAll();
                $view = 'created';
                $pagetitle = 'Liste des Commandes';*/
            }
        }
        require (File::build_path(array("view","view.php")));
    }
    public static function delete() {
    	if (ModelCommandeClient::delete($_GET['idCommande'])===false) {
            $view='error';
            $pagetitle='Erreur suppression';
            $error='Erreur : le Commande n existe pas';
    	} else {
	    	$tab_Commande = ModelCommandeClient::selectAll();
            $view='deleted';
            $pagetitle='Liste des Commandes';
    	}
        require (File::build_path(array("view","view.php")));
    }
    public static function updated() {
        if (empty($_POST)) {
            $tab_Commande = ModelCommandeClient::selectAll(); 
            $view='list';
            $pagetitle='Liste des Commandes';
        }else if (ModelCommandeClient::update($_POST)===false) {
            $view='error';
            $pagetitle='Erreur mise à jour';
        } else {
            $tab_Commande = ModelCommandeClient::selectAll();
            $view='updated';
            $pagetitle='Liste des commandes';
        }
        require (File::build_path(array("view","view.php")));
    }
    public static function checkLogged(){
        if (isset($_SESSION['login'])) {
            controllerCommandeClient::create();
        }
        else{
            $view = 'connect';
            controllerUtilisateur::connect('redirect');
        }
    }
    public static function create(){
        $effect="created";
        $view='update';
        $pagetitle='Création d une Commande Client';
        $Client=ModelUtilisateur::select($_SESSION['login']);
        $idClient=$Client->get('idClient');
        $v = new ModelCommandeClient();
        $v->set('dateCommande',date("Y/m/d"));
        $v->set('idClient',$idClient);
        require (File::build_path(array("view","view.php")));
    }
    public static function update() {
        $effect="updated";
        $v = ModelCommandeClient::select($_POST['idCommandeClient']);
        $view='update';
        $pagetitle='Mise à jour';
        require (File::build_path(array("view","view.php")));
    }
}
    
    
