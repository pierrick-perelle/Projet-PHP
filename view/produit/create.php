<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
    </head>
    <body>

        <form method="get" action="index.php">
            <fieldset>
                <legend>Mon formulaire :</legend>
                <p>
                    <label for="libelle">Libellé</label> :
                    <input type="text" placeholder="Ex : exemple" name="lib" id="libelle" required/>
                </p>
                <p>
                    <label for="prixprod">Prix Produit</label> :
                    <input type="text" placeholder="Ex : 1" name="prixprod" id="prixprod" required/>
                </p>
                <p>
                    <label for="stock">Stock</label> :
                    <input type="text" placeholder="Ex : 30" name="stock" id="stock" required/>
                </p>
                <p>
                    <label for="desc">Description</label> :
                    <input type="text" placeholder="Ex : blablabla" name="desc" id="desc" required/>
                </p>
                <p>
                    <input type='hidden' name='action' value='created'>
                    <input type="submit" value="Envoyer">

                </p>
            </fieldset>
        </form>

    </body>
</html>