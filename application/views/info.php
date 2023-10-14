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
        <h1>Vos Infos</h1>
        <div>ID : <span><?= $this->session->userdata('usr_id') ?></span></div>
        <div>Pseudo : <span><?= $this->session->userdata('usr_pseudo') ?></span></div>
        <div>Mot de Passe : <span><?= $this->session->userdata('usr_mdp') ?></span></div>
        <div>Mail : <span><?= $this->session->userdata('usr_mail') ?></span></div>
        <div>Adresse : <span><?= $this->session->userdata('usr_adresse') . " " . $this->session->userdata('usr_cp') . " " . $this->session->userdata('usr_ville') ?></span></div>
        <div>Date d'inscription : <span><?= $this->session->userdata('usr_date_creation') ?></span></div>
        <?php echo anchor('User/deconnexion', 'Déconnexion'); ?>

    </div>
</body>

</html>