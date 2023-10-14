<!-- Si c'est la première fois qu'on affiche les commentaire on met le titre sinon on ne l'affiche pas -->
<?php
if ($start_from == 0) {
  if($nb_comment == 0){ ?>
    <h3 class="section_titre">Aucun commentaires</h3>
  <?php }
  else { ?>
  <h3 class="section_titre">Commentaires</h3>
  <?php }
  ?>
<?php }
?>
<!-- ************************************************************************************************** -->


<?php
foreach ($comments as $key => $value) { ?>

    <div class="commentaire_row_container" data-commentaire_id="<?= $value->commentaire_id ?>">
        <div class="commentaire_info">
            <img class="profil_img" src="<?= site_url('assets/uploads/'.$value->usr_image_profil) ?>" alt="image profil">
            <div>
                <h4 class="commentaire_infos_titre"><?= $value->usr_pseudo ?> a dit : </h4>
                <p class="commentaire_infos_date">Le <?php  
                $dateString = $value->commentaire_date;
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
            
            
          
                            
            
        </div>


        <!-- Gérer l'image de confidentialité du commentaire -->
        <?php
                switch ($value->commentaire_visibility) {
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
        <!-- Fin Gérer l'image de confidentialité du commentaire -->



        <div class="div_contenu_commentaire">
            <p class="post_contenu_commentaire"><?= nl2br($value->commentaire_contenu) ?></p>
        </div>



        <div class="icones_container_commentaire">

                        <!-- Gérer Seul les propriétaire ou les admins peuvent supprimer ou editer les Post -->

                        <?php
                        if ($amIAdmin or $value->is_it_my_commentaire) { ?>

                            <img class="ico_post editer_commentaire" src="<?= site_url("assets/img/editer.png") ?>" alt="icone_editer">
                            <a class="btn_remove_commentaire" data-commentaire_id="<?= $value->commentaire_id ?>" ><img class="ico_post" src="<?= site_url("assets/img/poubelle.png")?>" alt="icone_poubelle"></a>
                            

                        <?php }
                        ?>
                    
                        <!-- Fin de la Gestion -->
                           
                            <div class="liker_container">
                                <img class="ico_post btn_like_commentaire<?= $value->did_i_like_this_commentaire ? ' liked' : '' ?>" src="<?=  $value->did_i_like_this_commentaire ? site_url("assets/img/pouce_rose.png") : site_url("assets/img/pouce.png") ?>" alt="icone_pouce" data-commentaire_id="<?= $value->commentaire_id ?>">
                                <span><?= $value->nb_like ?></span>
                            </div>

                            <div class="comment_container">
                                <img class="ico_post" src="<?= site_url("assets/img/commenter.png") ?>" alt="icone_commenter" onclick="toggleCommentResponse(this);">
                                <span class="get_comment_response" data-commentaire_id="<?= $value->commentaire_id ?>" ><span class="commentaire_response_count"><?= $value->nb_commentaire ?></span> réponses(s) <img class="ico_down" src="<?= site_url("assets/img/sort-down.png") ?>" alt="sort _down"></span>
                            </div>
                            
                            
                    </div>


                    <div class="commenter_container_response" data-commentaire_id="<?= $value->commentaire_id ?>">
                     
                        <textarea name="commentaire_textarea" id="commentaire" class="commentaire_textarea" cols="30" rows="10" style="border: solid 2px var(--main-darker);"></textarea>
                        <button class="btn_commenter_response">Répondre</button>
                        
                    </div>
            
                    <div class="section_reponse" data-commentaire_id="<?= $value->commentaire_id ?>"></div>
                    

      </div>

 


<?php }
?>
<script>


</script>