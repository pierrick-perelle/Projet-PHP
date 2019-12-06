<div class="">
    <div class="">
        <?php
            echo '<p> Nom d\'Utilisateur : ' . htmlspecialchars($u->get("login")) . '.</p>';
            echo '<p> Nom : ' . htmlspecialchars($u->get("nomClient")) . '.</p>';
            echo '<p> Prenom : ' . htmlspecialchars($u->get("prenomClient")) . '.</p>';
            echo '<p> Email : ' . htmlspecialchars($u->get("mailClient")) . '.</p>';
            echo '<p> Adresse : ' . htmlspecialchars($u->get("adresseClient")) . '.</p>';
            echo '</div>';
            echo '<div class="text-center">';
 
        if (Session::is_user($u->get("login")) || Session::is_admin()) {
            echo '<a href="?action=delete&controller=utilisateur&login='.rawurlencode($u->get("login")).'"><button class="" type="submit">Supprimer</button></a>';
            echo '<a href="?action=update&controller=utilisateur&login='.rawurlencode($u->get("login")).'"><button class="" type="submit">Modifier</button></a>';
        }
        
        ?>
    </div>
</div>
