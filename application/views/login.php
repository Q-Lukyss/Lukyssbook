<div class="main_container">
    <section class="home_left">
        <img src="<?= site_url("assets/img/reseau.png")?>" alt="image reseau">
    </section>
    <section class="home_right">
        <h2>Pas encore Membre? <br>Rejoignez notre Communauté</h2>
        <form action="<?= site_url("User/signup")?>" method="post" name="signup">

            <?php echo '<div class="error">' . validation_errors() . '</div>' ?>
            <div class="civil">
                <div class="form_row">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" name="pseudo_signup" value="<?php echo set_value('pseudo_signup'); ?>" required>
                </div>
                <div class="form_row">
                     <label for="nom">Nom</label>      
                    <input type="text" name="nom" value="<?php echo set_value('nom'); ?>">
                </div>
                <div class="form_row">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>">
                </div>
            </div>

            <div class="coordonnees">
                <div class="form_row">
                    <label for="mail">Mail</label>
                    <input type="text" name="mail" value="<?php echo set_value('mail'); ?>" required>
                </div>
                <div class="form_row">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" value="<?php echo set_value('adresse'); ?>">
                </div>
                <div class="form_row">
                    <label for="cp">Code Postal</label>
                    <input type="text" name="cp" value="<?php echo set_value('cp'); ?>" onkeyup="handleChange();" maxlength="5">
                </div>
                <div class="form_row">
                    <label for="ville">Ville</label>
                    <select name="ville" id="ville">
                        <option value="default">--- Ville ---</option>
                    </select>
                </div>
            </div>

            <div class="mdp">
                <div class="form_row">
                    <label for="mdp">Mot de Passe</label>
                    <input type="password" name="mdp_signup" value="<?php echo set_value('mdp_signup'); ?>" required>
                </div>
                <div class="form_row">
                    <label for="mdp_v">Verifier mot de passe</label>
                    <input type="password" name="mdp_v" value="<?php echo set_value('mdp_v'); ?>" required>
                </div>
            </div>
                
                
            <div class="rgpd_container">
                <input type="checkbox" name="rgpd" >
                <label for="rgpd"><a href="<?= site_url("assets/ressources/RGPD-LukyssBook.pdf")?>" target="_blank">J'accepte que mes données soient utilisées par LukyssBook (Cliquez pour voir le document complet)</a></label>
            </div>  
                
                
                
                <?php
                // if (isset($info_signup) && $info_signup == 'error') echo '<p style="color: red;">Mot de passe différent</p>';
                // else if (isset($info_signup) && $info_signup == 'deja_compte') echo '<p style="color: red;">Déja un compte</p>' 
                ?>
                <button type="submit">Inscription</button>
            </form>
    </section>
</div>

