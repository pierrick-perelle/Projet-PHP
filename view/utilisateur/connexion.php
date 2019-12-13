<div class="">
    <?php
    if (isset($login)) {
        echo '<div class="alert alert-danger" role="alert">
          Erreur : vérifiez vos login - mot de passe
        </div>';
  }
  ?>
<div class="">

  <h5 class="">
    <strong>Connectez-vous</strong>
  </h5>
  <div class="">
    <form method="post" class="" style="color: #757575;" action="?controller=utilisateur&action=connected<?php if($effect=='redirect'){echo '&effect=redirect';} ?>">
      <div class="">
        <input class="" type="text" placeholder="" name="login" id="materialLoginFormEmail" value="<?php if(isset($login)){ echo $login; } ?>" required />
        <label for="materialLoginFormEmail">Login</label>
      </div>
      <div class="">
        <input class="" type="password" name="mdp" id="materialLoginFormPassword" value="" required>
        <label for="materialLoginFormPassword">Password</label>
      </div>
      <button class="" type="submit">Connexion</button>
      <p>Vous n'êtes pas un membre ?
        <a href="./?controller=utilisateur&action=create">Incrivez-vous</a>
      </p>
    </form>
  </div>
</div>
</div>