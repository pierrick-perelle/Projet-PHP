<div class="">
    <div class="">
        <?php
            echo '<p> Nom d\'Utilisateur : ' . htmlspecialchars($v->get("login")) . '.</p>';
            echo '<p> Nom : ' . htmlspecialchars($v->get("nomClient")) . '.</p>';
            echo '<p> Prenom : ' . htmlspecialchars($v->get("prenomClient")) . '.</p>';
            echo '<p> Email : ' . htmlspecialchars($v->get("mailClient")) . '.</p>';
            echo '<p> Adresse : ' . htmlspecialchars($v->get("adresseClient")) . '.</p>';
            echo '</div>';
            echo '<div class="text-center">';
 
        if (Session::is_user($v->get("login"))===true or Session::is_admin()==true) {
            echo '<a href="?action=delete&controller=utilisateur&login='.rawurlencode($v->get("login")).'"><button class="" type="submit">Supprimer</button></a>';
            echo '<a href="?action=update&controller=utilisateur&login='.rawurlencode($v->get("login")).'"><button class="" type="submit">Modifier</button></a>';
        }
        
        ?>
    </div>
</div>
