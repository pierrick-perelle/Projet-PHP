<?php
require_once file::build_path(array("config","Conf.php"));

class Model{
    
    public static $pdo;
        
    public static function Init(){
        try{
            $login = Conf::getLogin();
            $database_name = Conf::getDatabase();
            $password = Conf::getPassword();
            $hostname = Conf::getHostname();
            // Connexion à la base de données            
            // Le dernier argument sert à ce que toutes les chaines de caractères 
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
            echo $e->getMessage(); // affiche un message d'erreur
        } else {
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>' ;
        }
  die();
}

    }
    public static function selectAll(){
      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);
      try{
      $rep = Model::$pdo->query("SELECT * FROM ".$table_name);
      $tab_result = $rep->fetchAll(PDO::FETCH_CLASS, $class_name);
        }catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
        if (empty($tab_result)){
          return false;
      }
      return $tab_result;
  }
  public static function select($primary_value) {
      $table_name = static::$object;
      $class_name = 'Model'.$table_name;
      $primary_key = ucfirst(static::$primary);
      $sql = "SELECT * from $table_name WHERE $primary_key=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
          "nom_tag" => $primary_value,
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab))
          return false;
      return $tab[0];
   }
   public static function selectMore($primary_value,$key) {
      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);
      $primary_key = ucfirst(static::$primary);
      try{
      $sql = "SELECT * from $table_name WHERE $key=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
          "nom_tag" => $primary_value,
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
      $tab = $req_prep->fetchAll();
      }catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab)){
          return false;
      }     
      return $tab;      
   }
   
   public static function delete($primary_value) {
      $table_name = ucfirst(static::$object);
      $primary_key = ucfirst(static::$primary);
      try {
        $sql = "DELETE from $table_name WHERE $primary_key=:nom_tag";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        $values = array(
            "nom_tag" => $primary_value,
        );
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);
      } catch (PDOException $e) {
        // Attention, si il y a une erreur, on renvoie false
        return false;
      }
   }
   // Update générique en fonction des données récupéré
   public static function update($data) {
      $val=""; 
      $primary_key = static::$primary;
      $table_name = static::$object;
      // Création du contenu SET de la requète SQL
      foreach ($data as $cle => $valeur)
          $val=$val.$cle.'=:'.$cle.',';
      // Retrait de la dernière virgule en trop
      $val=rtrim($val,",");
      try {
        $sql = "UPDATE $table_name SET $val WHERE $primary_key=:$primary_key;";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        foreach ($data as $cle => $valeur)
          $values[$cle]=$valeur;
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);
      } catch (PDOException $e) {
        // Attention, si il y a une erreur, on renvoie false
          echo $e;
        return false;
      }
    }
    // Save générique en fonction des données récupéré
    public static function save($data) {
      $val=""; 
      $insert="";
      $table_name = static::$object;
      // Création du contenu VALUES de la requète SQL
      foreach ($data as $cle => $valeur){
          $val=$val.$cle.',';
          $insert=$insert.':'.$cle.',';
      }
      // Retrait de la dernière virgule en trop
      $insert=rtrim($insert,",");
      $val=rtrim($val,",");
      try {
        $sql = "INSERT INTO $table_name ($val) VALUES ($insert)";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        foreach ($data as $cle => $valeur)
          $values[$cle]=$valeur;
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);
      } catch(PDOException $e) {
          echo $e->getMessage(); //
        return false;
      }
    }
}

Model::Init();

?>

