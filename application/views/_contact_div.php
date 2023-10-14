<?php
foreach ($contacts as $key => $value) { ?>
    
    <div class="contact_row" data-contact_id="<?= $value->usr_id ?>">
        <img class="image_profil" src="<?= site_url("assets/uploads/".$value->usr_image_profil) ?>" alt="image profil de <?= $value->usr_pseudo ?>">
        <span><?= $value->usr_pseudo ?></span>
    </div>

<?php }
?>


<script>

</script>