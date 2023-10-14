<div class="page_parametres">
    <?php
    function set_div_param($parametres, $titre, $database_colonne, $div_class){ ?>
        <div class="parametres_row <?= $div_class ?>">
            <div class="parametres_row_titre">
                <h4>Visibilité <?= $titre ?></h4>
            </div>
            
            <?php
                switch ($parametres[$database_colonne]) {
                    case 1:
                        ?>
                        <div class="parametres_row_content">
                            <img class="<?= $database_colonne ?>_image" src="<?= site_url("assets/img/utilisateur.png") ?>" alt="image moi uniquement">
                            <select name="<?= $database_colonne ?>" onchange="updateImage('<?= $database_colonne ?>');">
                                <option value="1" selected>Moi uniquement</option>
                                <option value="2">Mes amis et moi</option>
                                <option value="3">Tout le monde</option>
                            </select>
                        </div>
                           
                        <?php
                        break;
                    case 2:
                        ?>
                            <div class="parametres_row_content">
                                <img class="<?= $database_colonne ?>_image" src="<?= site_url("assets/img/silhouette-dutilisateurs-multiples.png") ?>" alt="image amis et moi">
                                <select name="<?= $database_colonne ?>" onchange="updateImage('<?= $database_colonne ?>');">
                                    <option value="1">Moi uniquement</option>
                                    <option value="2" selected>Mes amis et moi</option>
                                    <option value="3">Tout le monde</option>
                                </select>
                            </div>
                        <?php
                        break;
                    default:
                        ?>
                            <div class="parametres_row_content">
                                <img class="<?= $database_colonne ?>_image" src="<?= site_url("assets/img/carte-du-monde.png") ?>" alt="image monde">
                                <select name="<?= $database_colonne ?>" onchange="updateImage('<?= $database_colonne ?>');">
                                    <option value="1">Moi uniquement</option>
                                    <option value="2">Mes amis et moi</option>
                                    <option value="3" selected>Tout le monde</option>
                                </select>
                            </div>
                        <?php
                        break;
                }
        echo '</div>';
        }
    ?>

    <aside class="left_aside"></aside>
    <main>
  
        <div class="titre">
            <h2>Paramètres <?= $this->session->userdata("usr_pseudo") ?></h2>
        </div>
        
        <div class="parametres_content">
            
            <?php 

                set_div_param($parametres, "des Informations par défaut", "param_default_info_visibility", "default_info");
                set_div_param($parametres, "des Amis par défaut", "param_default_amis_visibility", "default_amis");
                set_div_param($parametres, "des Photos par défaut", "param_default_photo_visibility", "default_photo");
                set_div_param($parametres, "des Posts par défaut", "param_default_post_visibility", "default_post");
                set_div_param($parametres, "des Commentaires par défaut", "param_default_commentaire_visibility", "default_commentaire");
                set_div_param($parametres, "du Nom", "param_nom_visibility", "default_nom");
                set_div_param($parametres, "du Prénom", "param_prenom_visibility", "default_prenom");
                set_div_param($parametres, "de la Ville", "param_ville_visibility", "default_ville");

            ?>

          

            
        </div>
    </main>
    

    <aside class="right_aside"></aside>
</div>





