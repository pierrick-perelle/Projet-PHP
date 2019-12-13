<?php

require_once File::build_path(array("model", "Model.php"));
require_once File::build_path(array("model", "ModelProduit.php"));
require_once File::build_path(array("model", "ModelListecommande.php"));

class ModelCommandeClient extends Model {

    //private $etatCommande (passée/payée/livrée)
    private $idCommandeClient;
    private $idClient;
    private $listeProduits = array();
    private $dateCommande;
    private $prixTotal = 0;
    protected static $object = 'Commande';
    protected static $primary = 'idCommande';

    public function __construct($idC = NULL, $dC = NULL, $idCC = NULL, $lP = NULL) {
        if (!is_null($idC) && !is_null($dC)) {
            $idCommande = $idCC;
            $idClient = $idC;
            $dateCommande = $dC;
            $listeProduits = $lP;
        }
        //si c'est une nouvelle commande
        if (is_null($idCommande)) {
            self::toList();
        } else {
            ModelListeProduitsCommande::select($idCommande);
        }
    }

    public function toList() {
        //$pT=0;
        $contenuPanier = $_SESSION['panier'];
        //creation de la liste de produits finale
        foreach ($contenuPanier as $produit => $quantite) {
            $quantite = intval($quantite);
            //recuperation du produit afin d'accéder à ses attributs
            $produitObj = ModelProduit::select($produit);
            // si le produit n'est plus disponible en quantite suffisante
            if (($produitObj->get('quantite')) < ($quantite)) {
                unset($contenuPanier[$produit]);
            } else {
                $this->listeProduits[$produit] = $quantite;
                //$pT=$pT+$quantite*($produitObj->get('prixProduit'));            
            }
        }
        //$this->prixTotal=$pT;
        $this->prixTotal = $_SESSION['prix'];
        $_SESSION['panier'] = $contenuPanier;
    }

    public function saveList() {
        $values[':idCC'] = ModelCommande::$pdo->lastInsertId();
        $donnees = "";
        $numeroProd = 0;
        // Création de chaque combinaison produit quantité à inserer dans la listeProdClient
        foreach ($this->listeProduits as $produit => $quantite) {
            $numeroProd++;
            $donnees = $donnees . '(:idCC , :produit' . $numeroProd . ',:quantite' . $numeroProd . '),';
            //attribution des tags
            $values[':produit' . $numeroProd] = $produit;
            $values[':quantite' . $numeroProd] = $quantite;
        }
        // Retrait de la dernière virgule en trop
        $donnees = rtrim($donnees, ",");
        try {
            $numeroProd = 0;
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

}
