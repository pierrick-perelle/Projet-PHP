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
            echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
        }
  die();
}

    }
    public static function selectAll(){
      $table_name = static::$object;
      $class_name = 'Model'.ucfirst($table_name);
      $rep = Model::$pdo->query("SELECT * FROM ".$table_name);
      $tab_result = $rep->fetchAll(PDO::FETCH_CLASS, $class_name);
      return $tab_result;
  }
}

Model::Init();

?>

