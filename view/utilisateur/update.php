<div class="">    
    <div class="">
        <h5 class="">
            <strong><?php 
    	if($effect==='created'){
    		echo 'Inscription';
    	} else {
    		echo 'Mettre à jour';
    	}?>
            </strong>
        </h5>      
        
        <div class="">      
            <form class="" style="color: #757575;" method="post" action="?action=<?php echo $effect ?>&controller=<?php echo static::$object ?>">

                <div class="">
                    <div class="">
                        <!-- First name -->
                        <div class="">
    			<input class="" type="text" placeholder="" name="prenom" id="prenom_id" value="<?php echo htmlspecialchars($v->get("prenom"))?>" required/>
                            <label for="prenom_id">Prenom</label>
                        </div>
                    </div>
                    <div class="">
                        <!-- Last name -->
                        <div class="">
    			<input type="text" placeholder="" class="form-control" name="nom" id="nom_id" value="<?php echo htmlspecialchars($v->get("nom"))?>" required/>
                            <label for="nom_id">Nom</label>
                        </div>
                    </div>
                    <div class="">
                        <!-- Adresse -->
                        <div class="">
                            <input type="text" placeholder="" class="form-control" name="adresse" id="adresse_id" value="<?php echo htmlspecialchars($v->get("adresse"))?>" required/>
                            <label for="nom_id">Adresse</label>
                        </div>
                    </div>

                </div>

                <div class="">
                    <div class="">
                        <!-- Login -->
                        <div class="">
    			<input class="form-control" type="text" placeholder="" name="login" id="log_id" value="<?php echo htmlspecialchars($v->get("login")).'" '.$input?> />
                            <label for="log_id">Nom d'utilisateur</label>
                        </div>
                    </div>
                    <div class="">
                        <!-- Email -->
                        <div class="">
    			<input class="" type="email" placeholder="" name="email" id="email_id" value="<?php echo htmlspecialchars($v->get("email"))?>" required/>
                            <label for="email_id">Email</label>
                        </div>
                    </div>
                </div>
    		<?php
    		if(!Session::is_admin()){
                echo '<div class="form-row">
                    <div class="col">
                        <!-- PSW -->
                        <div class="md-form">
    			<input class="form-control" type="password" name="mdp1" id="mdp1_id" value="" required>
                            <label for="mdp_id">Mot de passe</label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- PSW BIS -->
                        <div class="md-form">
    			<input class="form-control" type="password" name="mdp2" id="mdp2_id" value="" required>
                            <label for="mdpbis_id">Retapez votre mot de passe</label>
                        </div>
                    </div>
                </div>';
    		}
    		?>
    	    <?php
                if ($effect=='updated' && Session::is_admin()) {
                  echo '
                  <input class="form-control" type="checkbox" id="admin_id" name="admin"  />
                  <label for="admin_id">Administrateur</label>';
                }
                ?>

                <!-- Sign up button -->
                <button class="" type="submit">Envoyer</button>

                <hr>

                <!-- Terms of service -->
                <p>En vous inscrivant, vous acceptez
                    <a href="" target="_blank"> nos conditions d'utilisations</a>

            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form register -->
</div>
