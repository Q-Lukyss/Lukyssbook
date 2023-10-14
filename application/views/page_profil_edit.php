<?php
$list = ["pseudo", "nom", "prenom", "mail", "tel", "adresse", "cp", "ville"];
function set_div_row($profil, $list){
    foreach ($list as $key) { ?>
        <div class="content_row">
            <label for="<?= 'usr_'.$key ?>"><?= ucfirst($key) ?></label>
            <input name="<?= 'usr_'.$key ?>" type="text" value="<?= $profil["usr_".$key] ?>">
        </div>
    <?php }
}
?>
<div class="page_profil_edit" data-profil_id="<?= $profil["usr_id"] ?>">
            

    <aside class="left_aside"></aside>
    <main>
  
        <div class="titre">
            <h2>Editer profil de <?= $profil["usr_pseudo"] ?></h2>
        </div>

        <div class="content">

        <div class="content_image_profil">
            <label for="<?= 'usr_image_profil' ?>">Image de profil</label>
            <img class="btn_change_image_profil" src="<?= site_url('assets/uploads/'.$profil['usr_image_profil'])  ?>" alt="image de profil">
            <div class="upload_settings"></div>
        </div>

        <form action="<?= site_url("User/editer_profil/".$this->session->userdata('usr_id')) ?>" method="POST">

        <?php echo '<div class="error" style="color: red;">' . validation_errors() . '</div>' ?>

        <?php
            if (isset($info_edit) && $info_edit == 'deja_compte') echo '<p style="color: red;">Ce Pseudo ou ce Mail sont déja pris</p>' 
        ?>

        <?php set_div_row($profil, $list) ?>

        <button type="submit">Valider les Changements</button>

        </form>

        
        <div>
            <a class="btn_change_mdp" href="<?= site_url('user/reset_mdp/') ?>">Changez de Mot de Passe</a>
            <div class="change_mdp"></div>
        </div>
        
        
       

       


          
        </div>
        
    </main>
    

    <aside class="right_aside"></aside>
</div>

<script>
    
$('body').on('click', '.btn_change_image_profil', function() {
    let uploadSettingsDiv = $(this).closest('.content_image_profil').find('.upload_settings');
    $.ajax({
        url: "<?= site_url('Upload/') ?>",
        method: 'POST',
        success: function(response) {
            uploadSettingsDiv.html(response);
        },
        error: function(error) {
        }
    });
});
</script>

