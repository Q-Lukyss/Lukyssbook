<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <div id="container">
        <form action="" method="post">
            <h1>Créer un compte</h1>
            <?php echo '<div class="error">' . validation_errors() . '</div>' ?>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" value="<?php echo set_value('pseudo'); ?>">
            <label for="mail">Mail</label>
            <input type="text" name="mail" value="<?php echo set_value('mail'); ?>">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" value="<?php echo set_value('adresse'); ?>">
            <label for="ville">Ville</label>
            <input type="text" name="ville" value="<?php echo set_value('ville'); ?>">
            <label for="cp">Code Postal</label>
            <input type="text" name="cp" value="<?php echo set_value('cp'); ?>">
            <label for="mdp">Mot de Passe</label>
            <input type="password" name="mdp" value="<?php echo set_value('mdp'); ?>">
            <label for="mdp_v">Verifier mot de passe</label>
            <input type="password" name="mdp_v" value="<?php echo set_value('mdp_v'); ?>">
            <?php
            // if (isset($info_signup) && $info_signup == 'error') echo '<p style="color: red;">Mot de passe différent</p>';
            // else if (isset($info_signup) && $info_signup == 'deja_compte') echo '<p style="color: red;">Déja un compte</p>' 
            ?>
            <button type="submit">Inscription</button>
        </form>
    </div>


</body>

</html>