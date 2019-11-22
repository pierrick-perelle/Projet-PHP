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
            $this->prixProduit = $pp;
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

    public function deleteProduit(){
        try{
            $sql = "DELETE FROM produit WHERE idproduit = (:idp_sql)";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "idp_sql" => $this->idproduit,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        }catch (PDOException $e) {
            /*echo $e->getMessage(); // affiche un message d'erreur;*/
          return false;
            
        }
    }
    public function deleteByIdProduit($idp){
        try{
            $sql = "DELETE FROM produit WHERE idproduit = (:idp_sql)";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "idp_sql" => $idp,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
        }catch (PDOException $e) {
            /*echo $e->getMessage(); // affiche un message d'erreur;*/
            return false;
            
        }
      
  }
}

?>

