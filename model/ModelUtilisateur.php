<?php

class ModelUtilisateur extends Model {

    private $login;
    private $nomClient;
    private $prenomClient;
    private $mailClient;
    private $mdp;
    private $adresseClient;
    protected static $object = 'utilisateur';
    protected static $primary='login';
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
    // un constructeur
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $mailClient = NULL, $mdp = NULL, $adresseClient=NULL) {
        if (!is_null($login) && !is_null($nom) && !is_null($prenom)) {
            $this->login = $login;
            $this->nomClient = $nom;
            $this->prenomClient = $prenom;
            $this->mailClient = $mailClient;
            $this->mdp = $mdp;
            $this->adresseClient=$adresseClient;
        }
    }
    public static function checkPassword($login,$mot_de_passe_chiffre){
          $sql = "SELECT * FROM utilisateur WHERE login=:login AND mdp=:mdp";
          // Préparation de la requête
          $req_prep = Model::$pdo->prepare($sql);

          $values = array(
              "login" => $login,
              "mdp" => $mot_de_passe_chiffre,
          );
          // On donne les valeurs et on exécute la requête   
          $req_prep->execute($values);
          $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
          $result = $req_prep->fetchAll();
          if (empty($result)) {
            return false;
          } else {
            return true;
          }
    }
    public static function checkAdmin($login){
        $table_name = static::$object;
        $sql = "SELECT admin from ".$table_name." WHERE login='".$login."'";
        $rep = Model::$pdo->query($sql);
        $admin = $rep->fetchAll();
        if(empty($admin))
            return false;
        if ($admin[0]==0){
            return false;
        }else{
            return true;
        }
    }
}
