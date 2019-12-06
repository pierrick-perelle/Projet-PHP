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
            <form class="" style="color: #757575;" method="post" action="?action=<?php echo $effect ?>&controller=<?php echo static::$objet ?>">

                <div class="">
                    <div class="">
                        <!-- First name -->
                        <div class="">
    			<input class="" type="text" placeholder="" name="prenomClient" id="prenom_id" value="<?php echo htmlspecialchars($v->get("prenomClient"))?>" required/>
                            <label for="prenom_id">Prenom</label>
                        </div>
                    </div>
                    <div class="">
                        <!-- Last name -->
                        <div class="">
    			<input type="text" placeholder="" class="form-control" name="nomClient" id="nom_id" value="<?php echo htmlspecialchars($v->get("nomClient"))?>" required/>
                            <label for="nom_id">Nom</label>
                        </div>
                    </div>
                    <div class="">
                        <!-- Adresse -->
                        <div class="">
                            <input type="text" placeholder="" class="form-control" name="adresseClient" id="adresse_id" value="<?php echo htmlspecialchars($v->get("adresseClient"))?>" required/>
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
    			<input class="" type="email" placeholder="" name="mailClient" id="email_id" value="<?php echo htmlspecialchars($v->get("mailClient"))?>" required/>
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
    			<input class="form-control" type="password" name="mdp" id="mdp1_id" value="" >
                            <label for="mdp_id">Mot de passe</label>
                        </div>
                    </div>
                    <div class="col">
                        <!-- PSW BIS -->
                        <div class="md-form">
    			<input class="form-control" type="password" name="mdp2" id="mdp2_id" value="" >
                            <label for="mdpbis_id">Retapez votre mot de passe</label>
                        </div>
                    </div>
                </div>';
    		}
                if ($effect=='updated' && Session::is_admin()) {
                echo ' <label for="admin_id" >
                <input class="form-control" type="checkbox" id="admin_id" name="admin" />
                 <span>Administrateur</span>
                    </label>
                    </p>';
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
