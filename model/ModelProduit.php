<?php
require_once file::build_path(array("model","Model.php"));

Class ModelProduit{
    private $idproduit;
    private $libelle;
    private $prixproduit;
    private $stock;
    private $description;
    
    public function getIdProduit() {
        return $this->idproduit;  
    }
    public function getLibelle(){
        return $this->libelle;
    }
    public function getPrixProduit(){
        return $this->prixproduit;
    }
    public function getStock(){
  	return $this->stock;
    }
    public function getDescription(){
  	return $this->description;
    }
    
    public function setIdProduit($idp2) {
        $this->idproduit = $idp2;
    }

    public function setPrixProduit($prixProduit2){
  	$this->prixproduit = $prixProduit2;
    }

    public function setLibelle($libelle2){
  	if(strlen($immatriculation2) >32){
  		echo "Une immatriculation doit contenir au maximum 255 caractères";
  	}
  	else{
  	$this->libelle = $libelle2;
  	}
    }
  
    public function setStock($stock2) {
        $this->stock = $stock2;
    }
    
    public function setDescription($desc2) {
        $this->description = $desc2;
    }
    
    public function __construct( $lib = NULL, $pp = NULL, $s = NULL,$desc = NULL) {
        if (!is_null($lib) && !is_null($pp) && !is_null($s) && !is_null($desc)) {
    // Si aucun de $m, $c et $i sont nuls,
    // c'est forcement qu'on les a fournis
    // donc on retombe sur le constructeur à 3 arguments
            $this->libelle = $lib;
            $this->prixproduit = $pp;
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
  
    public function save(){
        try{
            $sql = "INSERT INTO produit (idproduit, libelle, prixproduit, stock, description) VALUES (:idp_sql, :lib_sql, :prixproduit_sql, :stock_sql, :desc_sql)";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "idp_sql" => $this->idproduit,
                "lib_sql" => $this->libelle,
                "prixproduit_sql" => $this->prixproduit,
                "stock_sql" => $this->stock,
                "desc_sql" => $this->description,
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            return true;
        }catch (PDOException $e) {
            /*echo $e->getMessage(); // affiche un message d'erreur;*/
            return false;
            
        }
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
    public function update($data){
        try{
            $sql = "UPDATE produit SET libelle = (:lib_sql), prixproduit = (:prixproduit_sql), stock = (:stock_sql), description = (:desc_sql)  WHERE idproduit = (:idp_sql)";
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "idp_sql" => $data['idp'],
                "libelle_sql" => $data['libelle'],
                "desc_sql" => $data['desc'],
                "stock_sql" => $data['stock'],
                "prixproduit_sql" => $data['prixproduit'],
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            return true;
        }catch (PDOException $e) {
            /*echo $e->getMessage(); // affiche un message d'erreur;*/
            return false;    
        }
    }
}





?>

