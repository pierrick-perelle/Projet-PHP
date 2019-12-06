<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div class="navbar-fixed">
        <nav class="nav-extended">
            <div class="grey darken-4 nav-wrapper">
                <a href="#!" class="grey-text text-lighten-3 brand-logo center"><i class="material-icons">cake</i>Cook'ilo</a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                <?php
                    if(empty($_SESSION['login'])){
                        echo '<li><a class="orange waves-effect waves-light btn" href="index.php?action=connect&controller=utilisateur">Connexion</a></li>';

                    }else{
                        echo '<li><a class="orange waves-effect waves-light btn" href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a></li>';
                    }
                ?>
                    <li><a class="grey-text text-lighten-3" href="index.php?action=readAll"><b>Les Produits</b></a></li>
                <?php
                        if(ModelUtilisateur::checkAdmin($_SESSION['login'])){
                           echo ' <li><a class="grey-text text-lighten-3" href="index.php?action=readAll&controller=utilisateur"><b>Liste des Utilisateurs</b></a></li>';
                        }
                ?>
                </ul>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a class="grey-text text-lighten-3" href="index.php?action=readPanier&controller=produit"><b>Mon Panier</b></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="navbar-fixed">
        <nav>
            <div class="grey darken-3 nav-wrapper">
                <form>
                    <div class="input-field">
                        <input class="grey-text text-darken-4" id="search" placeholder="Rechercher votre cookie ici !" type="search" required>
                        <label class="label-icon" for="search"><i class="text-darken-4 material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <?php
    $filepath = File::build_path(array("view", static::$object, "$view.php"));
    require $filepath;
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script> M.AutoInit(); </script>
    </body>
</html>



