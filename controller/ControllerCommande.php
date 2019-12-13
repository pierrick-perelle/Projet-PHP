<?php
require_once File::build_path(array("model", "ModelCommande.php"));
require_once File::build_path(array("model", "ModelUtilisateur.php"));
require_once File::build_path(array("model", "ModelListeProduitsCommande.php"));
require_once File::build_path(array("model", "ModelProduit.php"));
require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
require_once File::build_path(array("lib", "Session.php"));

class ControllerCommande{
    protected static $object='commande';
    
    public static function readAll($effet=null) {
        $effect=$effet;
        if (Session::is_admin()){
            $tab_client=ModelUtilisateur::selectAll();
            if (isset($_POST['idClient'])){
                $idClient=$_POST['idClient'];
                $tab_Commande = ModelCommande::selectMore($idClient,"idClient");
            }
            else{
                $tab_Commande = ModelCommande::selectAll();
            }
            $view='list';
            $pagetitle='Liste des Commandes clients';
        }
        else{
            $login=$_SESSION['login'];
            $User=ModelUtilisateur::select($login);
            $idUser=$User->get('idClient');
            $tab_Commande = ModelCommande::selectMore($idUser,"idClient");
            $view='list';
            $pagetitle='Liste des Commandes';
        }
        require (File::build_path(array("view","view.php")));    
    }
    public static function read(){
        $view='detail';
        $pagetitle='Detail commande client';
        if(isset($_GET['idCommande'])){            
            $idCommande=$_GET['idCommande'];}
        else {$view='error';}
        $commande=ModelCommande::select($idCommande);
        $listeProduits=$commande->get('listeProduits');
        require (File::build_path(array("view", "view.php")));
    }
    
    public static function created() {
        if (!isset($_POST['commandeEnCours'])) {
            ControllerCommande::readAll();
        }else {
            $commande=unserialize(base64_decode($_POST['commandeEnCours']));
            $commande->set('dateLivraison',$_POST['dateLivraison']);
            //construction de la commande à envoyer
            $data=array(
                'idCommande'=>NULL,
                'idClient'=> $commande->get('idClient'),
                'prixTotal'=> $commande->get('prixTotal'),
                'dateCommande'=> $commande->get('dateCommande'),
                'dateLivraison'=> $_POST['dateLivraison'],
                'etatCommande'=>0,
                );
            if (ModelCommande::save($data) === false || $commande->saveList()===false) {
                $view = 'error';
                $pagetitle = 'Erreur insertion';
                $error = 'Erreur : la Commande existe déjà / impossible d inserer';
            } else {
                $view='created';
                $pagetitle = 'Liste des Commandes';
            }
        }
        require (File::build_path(array("view","view.php")));
    }
    public static function delete() {
    	if (ModelCommande::delete($_GET['idCommande'])===false) {
            $view='error';
            $pagetitle='Erreur suppression';
            $error='Erreur : le Commande n existe pas';
    	} else {
	    	$tab_Commande = ModelCommande::selectAll();
            $view='deleted';
            $pagetitle='Liste des Commandes';
    	}
        require (File::build_path(array("view","view.php")));
    }
    public static function updated() {
        if (empty($_POST)) {
            $tab_Commande = ModelCommande::selectAll(); 
            $view='list';
            $pagetitle='Liste des Commandes';
        }else if (ModelCommande::update($_POST)===false) {
            $view='error';
            $pagetitle='Erreur mise à jour';
        } else {
            $tab_Commande = ModelCommande::selectAll();
            $view='updated';
            $pagetitle='Liste des commandes';
        }
        require (File::build_path(array("view","view.php")));
    }
    public static function checkLogged(){
        if (isset($_SESSION['login'])) {
            controllerCommande::create();
        }
        else{
            controllerUtilisateur::connect('redirect');
        }
    }
    public static function create(){
        $view='create';
        $pagetitle='Création d une Commande Client';
        $Client=ModelUtilisateur::select($_SESSION['login']);
        $idClient=$Client->get('idClient');
        $v = new ModelCommande();
        $v->set('dateCommande',date("Y/m/d"));
        $v->set('idClient',$idClient);
        require (File::build_path(array("view","view.php")));
    }
    public static function update() {
        $effect="updated";
        $v = ModelCommande::select($_POST['idCommande']);
        $view='update';
        $pagetitle='Mise à jour';
        require (File::build_path(array("view","view.php")));
    }
    public static function reiterate(){      
        $commande = ModelCommande::select($_GET['idCommande']);     
        setcookie ("panier", "", time() - 1);
        $panier=$commande->get('listeProduits');
        var_dump($panier);
        setcookie("panier", serialize($panier), time()+600);
        header('Location: ./index.php?controller=Panier&action=read');
    }
    public static function cancel(){
        $effect="cancelled";
        $idCommande = $_POST['idCommandeClient'];
        $data=array(
            'idCommande'=>$idCommande,
            'etatCommande'=>'3'
        );
        ModelCommande::update($data);
        ControllerCommande::readAll($effect);
    }
    public static function directOrder(){
        $Produit=ModelProduit::select($_POST['idProduit']);
        $quantite=$_POST['quantite'];
        $prixTotal=($Produit->get('prixProduit'))*$quantite;
        $_SESSION['prix']=$prixTotal;
        $_SESSION['panier']=array($_POST['idProduit']=>$quantite);
        ControllerCommande::checkLogged();
    }
    
    public static function send(){
    $idCommande=$_GET['idCommande'];
    $commande=ModelCommande::select($idCommande);
    $etat=$commande->get('etatCommande');
    if ($etat==1){
        $listeProduits=$commande->get('listeProduits');
        foreach($listeProduits as $idProduit=>$quantite){
            ControllerCommande::removeFromStock($idProduit,$quantite);
            }
    }
    $data=array(
        'idCommandeClient'=>$idCommande,
        'etatCommande'=> $etat+1 );
    ModelCommande::update($data);
    header('Location: ./index.php?controller=commande&action=readAll');
    }
    
    public static function removeFromStock($idProduit,$quantite){
        $produit=ModelProduit::select($idProduit);
        $stock=$produit->get('quantite');
        $data=array(
            'idProduit'=>$idProduit,
            'quantite'=> $stock-$quantite );
        ModelProduit::update($data);
    }
}
    
    
