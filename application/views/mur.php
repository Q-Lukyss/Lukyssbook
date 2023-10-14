<div class="content_container">


    <aside class="left_aside_mur">
    
    </aside>
    <main>
        <section class="poster">
          
                <form action="<?= site_url("Post/index/mur") ?>" method="post">
                    <img src="<?= site_url("assets/img/image_rose.png") ?>" alt="ajouter image">
                    <textarea name="contenu" cols="30" rows="10" placeholder="Quoi de neuf <?= $this->session->userdata("usr_pseudo") ?> ?"></textarea>
                    <button class="btn_poster" type="submit">Poster</button>
                </form>
          
        </section>

        <section class="fil">
     
        <?php
            foreach ($post_list as $key) { ?>
                <div class="post_wrapper" data-post_id="<?= $key->post_id ?>">
                    <div class="post_container">
                        <input type="hidden" class="id_post" name="id_post" value="<?= $key->post_id ?>">
                        <div class="post_infos">
                            <a href="<?= site_url('user/profil/'.$key->usr_id) ?>">
                                <img class="profil_img" src="<?= site_url('assets/uploads/'.$key->usr_image_profil) ?>" alt="image profil">
                            </a>
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
                        if ($key->usr_id == $this->session->userdata('usr_id') or $amIAdmin) { ?>

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
        </section>
    </main>
  
    <section class="contacts">
        <div class="section_contacts_rechercher_container">
            <h4 class="section_contacts_titre">Contacts</h4> 
            <div class="contacts_div_recherche">
                <input type="text" name="contacts_rechercher">
                <img class="contacts_icone_recherche" src="<?= site_url("assets/img/recherche-a-la-loupe.png") ?>" alt="icone loupe">
            </div> 
        </div>
              
        <div class="contact_list"></div>
             
        <!-- <img class="contacts_icone_courrier" src="<?= site_url("assets/img/ecrire-un-courrier.png") ?>" alt="icone écrire un courrier"> -->
    </section>
</div>




<script>




</script>