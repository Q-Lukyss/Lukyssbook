<div class="page_amis">
            

    <aside class="left_aside"></aside>
    <main>
  
        <div class="titre">
            <h2>Amis de <?= $profil["usr_pseudo"] ?></h2>
        </div>

        <div class="content">

            <?php
            
            foreach ($listeAmis as $key => $value) { 
            // Gerer si c'est mon Profil actions spécifiques 
                if ($value->usr_id != $this->session->userdata("usr_id")) { ?>

                    <div class="content_row">
                        <img class="image_profil" src="<?= site_url("assets/uploads/".$value->usr_image_profil) ?>" alt="image profil de <?= $value->usr_pseudo ?>">
                        <a class="pseudo" href="<?= site_url("User/profil/".$value->usr_id) ?>"><?= $value->usr_pseudo ?></a>
                        
                        <div class="btn_container">
                                
                            <a class="btn_voir_profil" href="<?= site_url("User/profil/".$value->usr_id) ?>">Voir Profil</a>

                            
                            <!-- Gestion du statut de l'amitié -->

                            <?php

                            if (is_it_my_friend($this->session->userdata("usr_id"), $value->usr_id)) { ?>
                                  <a href='<?= site_url('Ajouter/break_friendship/'.$this->session->userdata("usr_id")."/".$value->usr_id."/".str_replace('/','zwxy',current_url())) ?>' class='btn_stop_ajouter'><img class='icone_supprimer_ami' src="<?= site_url('assets/img/add-friend.png') ?>" alt='image supprimer ami'> Rompre l'amitié</a>
                            <?php }
                            elseif (is_friend_request_pending($this->session->userdata("usr_id"), $value->usr_id)) { ?>
                                <a title="Demande d'ami envoyée" href="<?= site_url('Ajouter/break_friendship/'.$this->session->userdata("usr_id")."/".$value->usr_id."/".str_replace('/','zwxy',current_url())) ?>" class="btn_pending_ami"><img class="icone_pending_ami" src="<?= site_url("assets/img/wall-clock.png") ?>" alt="image friend request pending">Annuler ?</a>
                            <?php }
                            else { ?>
                                <a href='<?= site_url('Ajouter/send_request/'.$this->session->userdata("usr_id")."/".$value->usr_id."/".str_replace('/','zwxy',current_url())) ?>' class='btn_ajouter'><img class='icone_ajouter_ami' src="<?= site_url('assets/img/add.png') ?>" alt='image ajouter ami'> Envoyer une demande d'ami</a>
                            <?php }

                            ?>

                            <!-- Fin de la gestion d'amitié -->

                              <!-- Gestion du statut suivi  -->
                            <?php
                            if (do_i_follow_him($this->session->userdata("usr_id"), $value->usr_id)) { ?>
                                <a href='<?= site_url('Suivre/unfollow/'.$this->session->userdata("usr_id")."/".$value->usr_id."/". str_replace('/','zwxy',current_url())) ?>' class='btn_stop_suivre'>Arrêter de Suivre</a>
                            <?php } 
                            else{ ?>
                                <a href='<?= site_url('Suivre/follow/'.$this->session->userdata("usr_id")."/".$value->usr_id."/". str_replace('/','zwxy',current_url())) ?>' class='btn_suivre'>Suivre</a>
                            <?php }
                            ?>
                            <!-- Fin de la gestion -->

                            

                        </div>
                    </div>
                <?php } 
                else { ?>
                <!-- C'est moi donc je vais pas m'ajouter ni me suivre -->
                    <div class="content_row">
                        <img class="image_profil" src="<?= site_url("assets/uploads/".$value->usr_image_profil) ?>" alt="image profil de <?= $value->usr_pseudo ?>">
                        <a class="pseudo" href="<?= site_url("User/profil/".$value->usr_id) ?>">Moi</a>
                        
                        <div class="btn_container">
                                
                            <a class="btn_voir_profil" href="<?= site_url("User/profil/".$value->usr_id) ?>">Voir mon Profil</a>

                            <!-- Fin de la gestion -->

                            

                        </div>
                    </div>
                <?php }
                ?>
            <!-- Fin de Gestion si c'est mon profil -->
            <?php }
            ?>

        </div>
        
    </main>
    

    <aside class="right_aside"></aside>
</div>





