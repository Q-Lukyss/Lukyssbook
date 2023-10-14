<?php
// var_dump($messages);
foreach ($messages as $key => $value) { ?>
    <div class="<?= $value->usr_id == $usr_id ? 'msg_row my_msg' : 'msg_row' ?>" data-usr_id="<?= $value->usr_id ?>" data-conversation_id="<?= $value->conversation_id ?>">
        <img src="<?= site_url('assets/uploads/'. $value->usr_image_profil) ?>" alt="image profil auteur du message">
        <div>
            <h4><?= $value->usr_pseudo ?></h4>
            <p><?= $value->message_contenu ?></p>
        </div>
    </div>
<?php }
?>