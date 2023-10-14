<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret</title>
</head>

<body>
    <div class="container">

        <div>Bienvenue <span><?= $this->session->userdata('usr_pseudo') ?></span>, vous avez trouvé la page secrète</div>
        <?php echo anchor('User/deconnexion', 'Déconnexion'); ?>
        <?php echo anchor('User/info', 'Mes infos'); ?>

    </div>
</body>

</html>
<!-- foreach ($info_connexion as $key) { ?>
            <div>Bienvenue <span><?= $key->pseudo ?></span>, vous avez trouvé la page secrète</div>
         -->