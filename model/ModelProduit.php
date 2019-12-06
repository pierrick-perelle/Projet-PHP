<?php
require_once file::build_path(array("model","Model.php"));

Class ModelProduit extends Model{
    static protected $object = 'produit';
    static protected $primary = 'idProduit';
    private $idProduit;
    private $libelle;
    private $prix;
    private $stock;
    private $description;
    
    // Getter générique 
    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }
    // Setter générique
    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }
    public function __construct($id = NULL, $lib = NULL, $pp = NULL, $s = NULL,$desc = NULL) {
        if (!is_null($id) && !is_null($lib) && !is_null($pp) && !is_null($s) && !is_null($desc)) {
            $this->idProduit = $id;
            $this->libelle = $lib;
            $this->prix = $pp;
            $this->stock = $s;
            $this->description = $desc;
        }
    }
    public static function getAllProduits(){
        $rep = Model::$pdo->query("SELECT * FROM produit");
        $tab_produit = $rep->fetchAll(PDO::FETCH_CLASS, 'ModelProduit');
        return $tab_produit;
    }
    
    public static function getProduitById($idp) {
    try{
        $sql = "SELECT * FROM produit WHERE idproduit=:idp_sql";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "idp_sql" => $idp,
        );	 
        $req_prep->execute($values);

        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        $tab_produit = $req_prep->fetchAll();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    if (empty($tab_produit))
        return false;
    return $tab_produit[0];
  }
  public static function ajoutProduitPanier($idp,$qte){
        $estadd = 0;
        if(isset($_SESSION['panier'][0])){
            foreach ($_SESSION['panier'] as $key => $value){
                if($value[0] == $idp){
                    $_SESSION['panier'][$key][1] += $qte;
                    $estadd = 1;
                }
            }
        }
        if($estadd == 0){
            array_push($_SESSION['panier'],array($idp,$qte)); $estadd = 1;
        }
        ModelProduit::calculPrixPanier();
        return $estadd;
  }
  public static function calculPrixPanier(){
        $prixtotal = 0;
        if(!isset($_SESSION['prix'])){
            $_SESSION['prix'] = 0;
        }
        else{ $_SESSION['prix'] = 0; }
        foreach($_SESSION['panier'] as $article){
                if(($product = ModelProduit::select($article[0])) != false){
                    $prixtotal += $product->get("prix") * $article[1];
                }
                $_SESSION['prix'] = $prixtotal;
            }
    }
    
    public static function modifierQuantite($key,$qte){
        $_SESSION['panier'][$key][1] = $qte;
        ModelProduit::calculPrixPanier();
    }
    public static function supprimerProduit($key){ 
        unset($_SESSION['panier'][$key]);
        ModelProduit::calculPrixPanier();
    }
        
}

?>

