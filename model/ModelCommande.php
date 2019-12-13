<?php
require_once File::build_path(array("model", "Model.php"));
require_once File::build_path(array("model", "ModelProduit.php"));
require_once File::build_path(array("model", "ModelListeProduitsCommande.php"));

class ModelCommande extends Model{
    
    private $idCommande;
    private $idClient;
    private $dateCommande;
    private $dateLivraison;
    private $prixTotal=0;
    private $listeProduits=array();
    private $etatCommande; //passée 0 / en cours de preparation 1 / envoyée 2 / annulée 3
    protected static $object = 'commande';
    protected static $primary='idCommande';
    
    
    public function __construct($idC = NULL, $dC = NULL, $idCC = NULL, $dL=NULL, $lP=NULL, $eC=NULL){
        if (!is_null($idC) && !is_null($dC)){
            $idCommande=$idCC;
            $idClient = $idC;
            $dateCommande = $dC;
            $dateLivraison = $dL;
            $listeProduits=$lP;
            $etatCommande=$eC;
        }
        //si c'est une nouvelle commande
        if(is_null($this->idCommande)){
            self::toList();
            $this->etatCommande=0;
        }
        //sinon on recupère la liste de produits depuisla bd
        else {
            $this->listeProduits=ModelListeProduitsCommande::selectMore($this->idCommande,"idCommande");
        }
    }
    
    public function toList(){
    $contenuPanier=$_SESSION['panier'];
        //creation de la liste de produits finale
 	foreach ($contenuPanier as $key => $couple){
 	        $idProduit=intval($couple[0]);
 	        $quantite=intval($couple[1]);
            //recuperation du produit afin d'accéder à ses attributs
            $produitObj=ModelProduit::select($idProduit);
            // si le produit n'est plus disponible en quantite suffisante
            if(($produitObj->get('stock'))<($quantite)){
                unset($contenuPanier[$idProduit]);
                unset($_SESSION['panier'][$key]);
            }
            else {
                $this->listeProduits[$idProduit] = $quantite;
            }
 	}
 	$this->prixTotal=$_SESSION['prix'];
    }
    
    public function saveList(){
      $idCommande=ModelCommande::$pdo->lastInsertId();
      $this->set('idCommande',$idCommande);
      $values[':idCC']= $idCommande;
      $donnees="";
      $numeroProd=0;
      // Création de chaque combinaison produit quantité à inserer dans la listeProdClient
      foreach ($this->listeProduits as $produit => $quantite){
          $numeroProd++ ;
          $donnees=$donnees.'(:idCC , :produit'.$numeroProd.',:quantite'.$numeroProd.'),';
          //attribution des tags
          $values[':produit'.$numeroProd]=$produit;
          $values[':quantite'.$numeroProd]=$quantite;
      }
      // Retrait de la dernière virgule en trop
      $donnees=rtrim($donnees,",");      
      try {
        $numeroProd=0;
        $sql = "INSERT INTO listeProduitsCommande(idCommande,idProduit,quantite) VALUES $donnees";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
        // Attention, si il y a une erreur, on renvoie false
            return false;
      }   
    }

    // Getter générique (pas expliqué en TD)
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    // Setter générique (pas expliqué en TD)
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }
    
    public function getEtat(){
        $etat=$this->etatCommande;
        $result="";
        switch ($etat){
            case 0 :
                $result="Passée";
                break;
            case 1 :
                $result="En cours de traitement";
                break;
            case 2 :
                $result="Envoyée";
                break;
            case 3 :
                $result="Annulée";
                break;
            
            default : $result="Erreur dans la commande";
        }
        return $result;       
    }
}