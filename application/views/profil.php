<div class="profil_page_container">
    <aside class="left_aside"></aside>

    <main>
        <?php 
        // if ($isMyProfil) echo "Mais, mais c'est MOI !" ;
        // else {
        //     echo "ce n'est pas mon profil !" ;
        //     echo '<br />';
        //     if ($isMyFriend) echo "cette personne est mon ami" ;
        //     else echo "cette personne n'est pas mon ami pour l'instant";
        //     echo '<br />';
        //     if($doIFollowHim) echo "Je suis cette personne";
        //     else echo "Je ne suis pas cette personne pour le moment";
        // }
        
        ?>
        <section class="page_profil_profil">
            
            <div class="border">
                <img src="<?= site_url('assets/uploads/'.$profil["usr_image_border"]) ?>" alt="Image de bordure">
            </div>
            <div class="profil">
                <img src="<?= site_url('assets/uploads/'.$profil["usr_image_profil"]) ?>" alt="Image de Profil">   
            </div>
            <div class="details">
                <?php
                    if(!empty($profil["usr_nom"]) and !empty($profil["usr_prenom"])) { ?>
                        <p class="names"><?= $profil["usr_nom"] ." ". $profil["usr_prenom"]." / ". $profil["usr_pseudo"]?><?= $amIAdmin == true && $isMyProfil == true ? " (Adminitrateur)" : '' ?></p>
                    <?php }
                    else{ ?>
                        <p class="names"><?= $profil["usr_pseudo"]?><?= $amIAdmin == true && $isMyProfil == true ? " (Adminitrateur)" : '' ?></p>
                    <?php }
                ?>
                <p><?= $nbFriends ?> ami(s) . <?= $nbFollowers ?> Suiveur(s)</p>
                <p>images des amis</p>
            </div>
            
           
            <!-- Gérer les Actions disponibles Selon MyProfil, Amis, et suivre -->
            <?php
            if ($isMyProfil){ ?> <a href='<?= site_url("User/editer_profil/".$profil["usr_id"]) ?>' class='btn_modifier_profil'>Modifier le profil</a> <?php ;}
            else{
                if($doIFollowHim) { ?> <a href='<?= site_url('Suivre/unfollow/'.$this->session->userdata("usr_id")."/".$profil["usr_id"]."/". str_replace('/','zwxy',current_url())) ?>' class='btn_stop_suivre'>Arrêter de Suivre</a> <?php }
                else { ?> <a href='<?= site_url('Suivre/follow/'.$this->session->userdata("usr_id")."/".$profil["usr_id"]."/".str_replace('/','zwxy',current_url())) ?>' class='btn_suivre'>Suivre</a> <?php };

                if($isFriendRequestPending) ?> <a title="Demande d'ami envoyée" href="<?= site_url('Ajouter/break_friendship/'.$this->session->userdata("usr_id")."/".$profil["usr_id"]."/".str_replace('/','zwxy',current_url())) ?>" class="btn_pending_ami"><img class="icone_pending_ami" src="<?= site_url("assets/img/wall-clock.png") ?>" alt="image friend request pending">Annuler ?</a> 
                <?php

                if($isMyFriend) { ?> <a href='<?= site_url('Ajouter/break_friendship/'.$this->session->userdata("usr_id")."/".$profil["usr_id"]."/".str_replace('/','zwxy',current_url())) ?>' class='btn_stop_ajouter'><img class='icone_supprimer_ami' src="<?= site_url('assets/img/add-friend.png') ?>" alt='image supprimer ami'> Rompre l'amitié</a> <?php }
                elseif(!$isFriendRequestPending and !$isMyFriend) { ?> <a href='<?= site_url('Ajouter/send_request/'.$this->session->userdata("usr_id")."/".$profil["usr_id"]."/".str_replace('/','zwxy',current_url())) ?>' class='btn_ajouter'><img class='icone_ajouter_ami' src="<?= site_url('assets/img/add.png') ?>" alt='image ajouter ami'> Envoyer une demande d'ami</a> <?php };
                
                ?>
                    <button data-contact_id="<?= $profil["usr_id"]?>" data-contact_pseudo="<?= $profil["usr_pseudo"]?>" class="btn_envoyer_msg_profil"><img class="icone_envoyer_msg" src="<?= site_url("assets/img/paper-plane.png")?>" alt="icone envoyer message"> Envoyer un message</button>
                <?php
            }
            ?>
           
            <!-- Fin de la gestion -->


            <div class="page_profil_menu">
                <a href="#page_profil_apropos">A Propos</a>
                <a href="#page_profil_amis">Amis</a>
                <a href="#page_profil_photos">Photos</a>
            </div>
        </section>
        <section class="page_profil_main">

            <div class="left_section">
                <div class="page_profil_apropos" id="page_profil_apropos">

                    <h3>A Propos</h3>

                    <?php
                    // var_dump($apropos)
                     ?>

                    <div class="bio">
                        <h4>Bio</h4>  
                    </div>

                    <div class="Infos">
                        <h4>Infos</h4>
                    </div>

                    <?php
                    if ($isMyProfil) { ?>
                        <a href="<?= site_url("User/a_propos/".$profil["usr_id"]) ?>">Modifier Section A Propos</a>
                    <?php }
                    else{ ?>
                        <a href="<?= site_url("User/a_propos/".$profil["usr_id"]) ?>">Voir Section A Propos</a>
                    <?php }
                    ?>
                    
                   
                </div>

                <div class="page_profil_amis" id="page_profil_amis">
                    <h3>Amis</h3>

                    <div class="friend_container">

                        <?php
                        foreach ($friendList as $key => $value) { ?>

                            <div class="friend_card">
                                
                                <a href="<?= site_url("user/profil/".$value->usr_id) ?>">
                                    <img src="<?= site_url("assets/uploads/".$value->usr_image_profil) ?>" alt="image de profil de <?= $value->usr_pseudo ?>">
                                    <h4><?= $value->usr_pseudo ?></h4>
                                </a>
                                

                            </div>

                        <?php }

                        ?>

                    </div>

                    <?php
                    if ($isMyProfil) { ?>
                        <a href="<?= site_url("User/amis/".$profil["usr_id"]) ?>">Voir mes amis</a>
                    <?php }
                    else{ ?>
                        <a href="<?= site_url("User/amis/".$profil["usr_id"]) ?>">Voir les amis</a>
                    <?php }
                    ?>
                    

                </div>
                
                <div class="page_profil_photos" id="page_profil_photos">
                    <h3>Photos</h3>

                    <?php
                    if ($isMyProfil) { ?>
                        <a href="<?= site_url("User/photos/".$profil["usr_id"]) ?>">Voir mes photos</a>
                    <?php }
                    else{ ?>
                        <a href="<?= site_url("User/photos/".$profil["usr_id"]) ?>">Voir les photos</a>
                    <?php }
                    ?>
                    

                </div>
            </div>

            <div class="right_section">

            <!-- Gérer la section Poster, si ce n'est pas mon profil je ne mets pas cette section -->


            <?php
            if($isMyProfil){ ?>
                 <div class="page_profil_poster">
               
                    <form action="<?= site_url("Post/index/profil") ?>" method="post">
                        <img src="<?= site_url("assets/img/image_rose.png") ?>" alt="ajouter image">
                        <textarea name="contenu" cols="30" rows="10" placeholder="Quoi de neuf <?= $this->session->userdata("usr_pseudo") ?> ?"></textarea>
                        <button class="btn_poster" type="submit">Poster</button>
                    </form>

                </div>
            <?php }
            ?>
               
            
            <!-- Fin de la gestion -->

                <div class="page_profil_fil">

                    <?php
                        foreach ($post_list as $key) { ?>
                            <div class="post_wrapper" data-post_id="<?= $key->post_id ?>">
                                <div class="post_container">
                                    <input type="hidden" class="id_post" name="id_post" value="<?= $key->post_id ?>">
                                    <div class="post_infos">
                                        <img class="profil_img" src="<?= site_url('assets/uploads/'.$key->usr_image_profil) ?>" alt="image profil">
                                        <h4 class="post_infos_titre"><?= $key->usr_pseudo ?></h4>

                                        <!-- Gérer l'image de confidentialité du post -->
                                        <?php
                                            switch ($key->post_visibility) {
                                                case 1:
                                                    ?>
                                                    <img src="<?= site_url('assets/img/utilisateur.png') ?>" alt="icone moi uniquement" class="icone_confidentialite" title="Moi uniquement">
                                                    <?php
                                                    break;
                                                case 2:
                                                    ?>
                                                    <img src="<?= site_url('assets/img/silhouette-dutilisateurs-multiples.png') ?>" alt="icone amis" class="icone_confidentialite" title="Mes amis et Moi">
                                                    <?php
                                                    break;
                                                case 4:
                                                    break;
                                                default:
                                                    ?>
                                                    <img src="<?= site_url('assets/img/carte-du-monde.png') ?>" alt="icone carte monde" class="icone_confidentialite" title="Tout le monde">
                                                    <?php
                                                    break;
                                            }
                                        ?>
                                        <!-- Fin Gérer l'image de confidentialité du post -->

                                        <p class="post_infos_date">Le <?php  
                                            $dateString = $key->post_date;
                                            $date = new DateTime($dateString);
                                            
                                            // Convertir le mois en français
                                            $englishMonths = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
                                            $frenchMonths = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
                                            
                                            // Formater la date avec mois en français
                                            $formattedDate = $date->format('d F Y');
                                            $formattedDate = str_replace($englishMonths, $frenchMonths, $formattedDate);
                                            
                                            // Ajouter l'heure
                                            $formattedDate .= '<br> à ' . $date->format('H\hi'); // Format pour heure et minutes
                                            
                                            echo $formattedDate;
                                        ?></p>
                                    </div>

                                    <div class="div_contenu_post">
                                        <p class="post_contenu_post"><?= $key->post_contenu ?></p>
                                    </div>
                                    
                                </div>

                                
                               <div class="icones_container">

                                    <!-- Gérer Seul les propriétaire ou les admins peuvent supprimer ou editer les Post -->

                                    <?php
                                    if ($isMyProfil or $amIAdmin) { ?>

                                        <img class="ico_post" src="<?= site_url("assets/img/editer.png") ?>" alt="icone_editer" onclick="editPost(this, this.parentElement.parentElement.querySelector('.id_post').value);">
                                        <a href="<?= site_url("/Post/remove/".$key->post_id."/".str_replace('/','zwxy',current_url())) ?>"><img class="ico_post" src="<?= site_url("assets/img/poubelle.png")?>" alt="icone_poubelle"></a>
                                        

                                    <?php }
                                    ?>
                                
                                    <!-- Fin de la Gestion -->
                                    
                                        <div class="liker_container">
                                            <img class="ico_post btn_like<?= $key->did_i_like_this_post ? ' liked' : '' ?>" src="<?=  $key->did_i_like_this_post ? site_url("assets/img/pouce_rose.png") : site_url("assets/img/pouce.png") ?>" alt="icone_pouce" data-post_id="<?= $key->post_id ?>">
                                            <span><?= $key->likes_count ?></span>
                                        </div>

                                        <div class="comment_container">
                                            <img class="ico_post" src="<?= site_url("assets/img/commenter.png") ?>" alt="icone_commenter" onclick="toggleComment(this);">
                                            <span class="get_comment" data-post_id="<?= $key->post_id ?>" ><span class="commentaire_count"><?= $key->commentaires_count ?></span> commentaire(s) <img class="ico_down" src="<?= site_url("assets/img/sort-down.png") ?>" alt="sort _down"></span>
                                        </div>
                                        
                                        
                                </div>

                                <div class="commenter_container">
                                    
                                    <input type="hidden" class="id_post" name="id_post" value="<?= $key->post_id ?>">
                                    <textarea name="commentaire_textarea" id="commentaire" cols="30" rows="10"></textarea>
                                    <button class="btn_commenter">Commenter</button>
                                    
                                </div>


                                <div class="section_commentaire"></div>


                            </div>
                        <?php }
                    ?>

                </div>
            </div>
       
        </section>
    </main>

    <aside class="right_aside"></aside>
</div>







