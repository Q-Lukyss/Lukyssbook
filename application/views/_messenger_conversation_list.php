<?php
// var_dump($conversations);
foreach ($conversations as $key => $value) { ?>
    <div class="conversation_row" data-conversation_id="<?= $value->conversation_id ?>" data-conversation_name="<?= $value->conversation_name ?>">
        <div>
            <img src="<?= site_url('assets/uploads/'. $value->conversation_image) ?>" alt="image de la conversation">
        </div>
        <div>
            <h2><?= $value->conversation_name ?></h2>
            <?php
            //Gérer gras ou pas selon message lu ou non
            if ($value->last_message_auteur != $usr_id and $value->last_message_date_emission > $value->last_visit_date ) { ?>
                <p class="unread"><?= nl2br($value->last_message_contenu) ?></p>
            <?php }
            else{ ?>
                <p><?= nl2br($value->last_message_contenu) ?></p>
            <?php }
            ?>
        </div>
    </div>
<?php }
?>