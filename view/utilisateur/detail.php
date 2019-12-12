<div class="">
    <div class="">

          <div class="row">
    <div class="col s12 m4 ">
      <div class="card blue-grey darken-1 center">
        <div class="card-content white-text">
         <?php echo '<span class="card-title"><p> Nom d\'Utilisateur : ' . htmlspecialchars($u->get("login")) . '.</p></span>
          <p> Nom : ' . htmlspecialchars($u->get("nomClient")) . '.</p>
          <p> Prenom : ' . htmlspecialchars($u->get("prenomClient")) . '.</p>
          <p> Email : ' . htmlspecialchars($u->get("mailClient")) . '.</p>
          <p> Adresse : ' . htmlspecialchars($u->get("adresseClient")) . '.</p>'; ?>
        </div>
        <div class="card-action">
         <?php if (Session::is_user($u->get("login")) || Session::is_admin()) {
        echo ' <a class="orange waves-effect waves-light btn" href="?action=delete&controller=utilisateur&login='.rawurlencode($u->get("login")).'">Supprimer</a> ';
         echo ' <a class="orange waves-effect waves-light btn" href="?action=update&controller=utilisateur&login='.rawurlencode($u->get("login")).'">Modifier</a>';
         } ?>
        </div>
      </div>
    </div>
  </div>';

    </div>
</div>
