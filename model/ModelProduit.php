<?php



Class ModelProduit extends Model {

    static protected $object = 'produit';
    static protected $primary = 'idProduit';
    private $idProduit;
    private $libelle;
    private $prix;
    private $stock;
    private $description;
    private $categorie;

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

    public function __construct($id = NULL, $lib = NULL, $pp = NULL, $s = NULL, $desc = NULL, $cat = NULL) {
        if (!is_null($id) && !is_null($lib) && !is_null($pp) && !is_null($s) && !is_null($desc) && !is_null($cat)) {
            $this->idProduit = $id;
            $this->libelle = $lib;
            $this->prix = $pp;
            $this->stock = $s;
            $this->description = $desc;
            $this->categorie = $cat;
        }
    }

    public static function ajoutProduitPanier($idp, $qte) {
        if (is_numeric($qte)) {
            $estadd = 0;
            if (isset($_SESSION['panier'][0])) {
                foreach ($_SESSION['panier'] as $key => $value) {
                    if ($value[0] == $idp) {
                        $_SESSION['panier'][$key][1] += $qte;
                        $estadd = 1;
                    }
                }
            }
            if ($estadd == 0) {
                array_push($_SESSION['panier'], array($idp, $qte));
                $estadd = 1;
            }
            ModelProduit::calculPrixPanier();
            return $estadd;
        }
    }

    public static function calculPrixPanier() {
        $prixtotal = 0;
        if (!isset($_SESSION['prix'])) {
            $_SESSION['prix'] = 0;
        } else {
            $_SESSION['prix'] = 0;
        }
        foreach ($_SESSION['panier'] as $article) {
            if (($product = ModelProduit::select($article[0])) != false && is_numeric($article[1])) {
                $prixtotal += $product->get("prix") * $article[1];
            }
            $_SESSION['prix'] = $prixtotal;
        }
    }

    public static function modifierQuantite($key, $qte) {
        $_SESSION['panier'][$key][1] = $qte;
        ModelProduit::calculPrixPanier();
    }

    public static function supprimerProduit($key){ 
        unset($_SESSION['panier'][$key]);
        ModelProduit::calculPrixPanier();
    }
    public static function viderPanier(){
        $_SESSION['panier']=array();
        ModelProduit::calculPrixPanier();
    }
        

    public static function getListCat() {
        try {
            $resultat = ModelProduit::selectDistinct("categorie");
            return $resultat;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            }
        }
    }

    public static function getProduitByCat($cat) {

        $result = ModelProduit::selectWhere("categorie", $cat);
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

}
?>

