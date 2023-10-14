<?php
function create_div($type_info, $apropos, $profil, $usr_id, $count_relation, $count_bio){
    switch ($type_info) {
        case 'relation': ?>
             <div class="<?= $type_info ?>">

             <?php
                foreach ($apropos as $key => $value) {
                  
                    if ($type_info == $value["apropos_type"]) {
                        $apropos_contenu = json_decode($value["apropos_contenu"]);?>
                        <div class="ancient_info">
                            <?php if (isset($apropos_contenu->relation)) { 
                                switch ($apropos_contenu->relation) {
                                    case 'marie': ?>
                                        <p>Situation amoureuse : Marié</p>
                                        <?php break;
                                    case 'union_libre': ?>
                                        <p>Situation amoureuse : Union Libre</p>
                                        <?php break;
                                    default: ?>
                                        <p>Situation amoureuse : <?= ucfirst($apropos_contenu->relation) ?></p>
                                        <?php break;
                                }
                            }
                        ?>
                        </div>
                    <?php }
                    
                }
                ?>

                <!-- Si c'est ton profil tu peux ajouter/editer des infos sinon non -->
                <?php
                if ($profil["usr_id"] ==  $usr_id and $count_relation == 0) { ?>
                    <div class="new_info"></div>
                    <p class="add_info" onclick="addFormulaire(this, '<?= $type_info ?>');">+ Ajouter Situation Amoureuse</p>
                <?php }
                else if ($profil["usr_id"] ==  $usr_id and $count_relation > 0) { ?>
                    <p class="add_info" onclick="editFormulaire(this, '<?= $type_info ?>');">Editer Situation Amoureuse</p>
                <?php }
                ?>
                

            </div>  
            <?php
            break;
        default: ?>
            <div class="<?= $type_info ?>">

                
             <?php
                foreach ($apropos as $key => $value) {
                  
                    if ($type_info == $value["apropos_type"]) {
                        $apropos_contenu = json_decode($value["apropos_contenu"]);?>
                        <div class="ancient_info">

                            <?php if (isset($apropos_contenu->date_debut) and isset($apropos_contenu->date_fin)) { ?>
                                <p>De <?= $apropos_contenu->date_debut ?> à <?= $apropos_contenu->date_fin ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->intitule)) { ?>
                                <p>Intitulé : <?= $apropos_contenu->intitule ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->etablissement)) { ?>
                                <p>Etablissement :  <?= $apropos_contenu->etablissement ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->entreprise)) { ?>
                                <p>Entreprise :  <?= $apropos_contenu->entreprise ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->habitation)) { ?>
                                <p>A habité à : <?= $apropos_contenu->habitation ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->ville)) { ?>
                                <p>A <?= $apropos_contenu->ville ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->bio)) { ?>
                                <p><?= ucfirst($apropos_contenu->bio) ?></p>
                            <?php } ?>

                            <?php if (isset($apropos_contenu->libre)) { ?>
                                <p>A <?= ucfirst($apropos_contenu->libre) ?></p>
                            <?php } ?>


                        </div>
                    <?php }
                    
                }
                ?>

                  <!-- Si c'est ton profil tu peux ajouter des infos sinon non -->
                  <?php

                    if ($profil["usr_id"] ==  $usr_id and $count_bio == 0 and $type_info == "bio") { ?>
                        <div class="new_info"></div>
                        <p class="add_info" onclick="addFormulaire(this, '<?= $type_info ?>');">+ Ajouter <?= ucfirst($type_info) ?></p>
                    <?php }

                    else if ($profil["usr_id"] ==  $usr_id and $count_bio > 0 and $type_info == "bio") { ?>
                        <p class="add_info" onclick="supprimerInfo(this, '<?= $type_info ?>');">Supprimer <?= ucfirst($type_info) ?></p>
                    <?php }

                    else if ($profil["usr_id"] ==  $usr_id) { ?>
                        <div class="new_info"></div>
                        <p class="add_info" onclick="addFormulaire(this, '<?= $type_info ?>');">+ Ajouter <?= ucfirst($type_info) ?></p>
                    <?php }
                    ?>

               
               

            </div>  
            <?php
            break;
    }

}
?>

<!------------------------------------------------------------------------------ Début de la page --------------------------------------------------------------------------->


<div class="page_apropos">
       

    <aside class="left_aside"></aside>
    <main>
  
        <div class="titre">
            <h2>A Propos de <?= $profil["usr_pseudo"] ?></h2>
        </div>

        <div class="content">

            <div class="bio_container">

                <h3>Ma bio</h3>

                <?php
               create_div("bio", $apropos, $profil, $usr_id, $count_relation, $count_bio);
               ?>

            </div>

            <div class="infos_container">

                <h3>Mes infos</h3>

               <?php
               create_div("etude", $apropos, $profil, $usr_id, $count_relation, $count_bio);
               create_div("travail", $apropos, $profil, $usr_id, $count_relation, $count_bio);
               create_div("habitation", $apropos, $profil, $usr_id, $count_relation, $count_bio);
               create_div("relation", $apropos, $profil, $usr_id, $count_relation, $count_bio);
               create_div("libre", $apropos, $profil, $usr_id, $count_relation, $count_bio);
               ?>


            </div>

        </div>
        
    </main>

    

    <aside class="right_aside"></aside>
</div>
<script>
    /////////////////////////////////////////////////////////////////////////Code pour gérer l'ajout et la suppression des formulaires
    function addFormulaire(element, typeInfo){
        
        switch (typeInfo) {
            case "bio":
            case "libre":
                element.parentElement.querySelector('.new_info').innerHTML = `
                    <form action="<?= site_url("apropos/add/") ?>${typeInfo}" method="post">

                        <label for="${typeInfo}">${typeInfo.charAt(0).toUpperCase() + typeInfo.slice(1)}</label>

                        <textarea name="${typeInfo}" cols="30" rows="10"></textarea>               

                        <button type="submit">Enregistrer</button>
                    </form>
                `;
                break;
            case "travail":
                element.parentElement.querySelector('.new_info').innerHTML = `
                    <form action="<?= site_url("apropos/add/") ?>${typeInfo}" method="post">
                        <label for="depuis">Depuis</label>
                        <select name="depuis" required>
                            <?php
                            for ($i = intval(date("Y")); $i > intval(date("Y")) - 110; $i--) { ?> 
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            ?>
                        </select>

                        <label for="jusque">Jusque</label>
                        <select name="jusque" required>
                            <option value="maintenant">Maintenant</option>
                            <?php
                            for ($i = intval(date("Y")); $i > intval(date("Y")) - 110; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            ?>
                        </select>

                        <label for="intitule">Intitulé</label>
                        <input type="text" name="intitule" required>

                        <label for="entreprise">Entreprise</label>
                        <input type="text" name="entreprise" required>

                        <label for="ville">Ville</label>
                        <input type="text" name="ville" required>

                        <button type="submit">Enregistrer</button>
                    </form>
                `;
                break;
            case "etude":
                element.parentElement.querySelector('.new_info').innerHTML = `
                    <form action="<?= site_url("apropos/add/") ?>${typeInfo}" method="post">
                        <label for="depuis">Depuis</label>
                        <select name="depuis" required>
                            <?php
                            for ($i = intval(date("Y")); $i > intval(date("Y")) - 110; $i--) { ?> 
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            ?>
                        </select>

                        <label for="jusque">Jusque</label>
                        <select name="jusque" required>
                            <option value="maintenant">Maintenant</option>
                            <?php
                            for ($i = intval(date("Y")); $i > intval(date("Y")) - 110; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            ?>
                        </select>

                        <label for="intitule">Intitulé</label>
                        <input type="text" name="intitule" required>

                        <label for="etablissement">Etablissement</label>
                        <input type="text" name="etablissement" required>

                        <label for="ville">Ville</label>
                        <input type="text" name="ville" required>

                        <button type="submit">Enregistrer</button>
                    </form>
                `;
                break;
            case "habitation":
                element.parentElement.querySelector('.new_info').innerHTML = `
                    <form action="<?= site_url("apropos/add/") ?>${typeInfo}" method="post">
                        <label for="depuis">Depuis</label>
                        <select name="depuis" required>
                            <?php
                            for ($i = intval(date("Y")); $i > intval(date("Y")) - 110; $i--) { ?> 
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            ?>
                        </select>

                        <label for="jusque">Jusque</label>
                        <select name="jusque" required>
                            <option value="maintenant">Maintenant</option>
                            <?php
                            for ($i = intval(date("Y")); $i > intval(date("Y")) - 110; $i--) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php }
                            ?>
                        </select>

                        <label for="ville">Ville</label>
                        <input type="text" name="ville" required>

                        <button type="submit">Enregistrer</button>
                    </form>
                `;
                break;
            case "relation":
                element.parentElement.querySelector('.new_info').innerHTML = `
                    <form action="<?= site_url("apropos/add/") ?>${typeInfo}" method="post">
                        <label for="relation">Situation amoureuse</label>
                        <select name="relation" required>
                            <option value="marie">Marié</option>
                            <option value="celibataire">Célibataire</option>
                            <option value="concubinage">Concubinage</option>
                            <option value="union_libre">Union Libre</option>
                            <option value="autre">Autre</option>
                        </select>

                        <button type="submit">Enregistrer</button>
                    </form>
                `;
                break
            default:
                break;
        }
        // Ajouter un gestionnaire d'événements onclick au bouton "Submit"
        const form = element.parentElement.querySelector('form');
       
        let formerTextContent = element.textContent;
        element.textContent = "- Annuler";
        element.removeAttribute("onclick");
        element.setAttribute("onclick", `removeForm(this, '${formerTextContent}', '${typeInfo}')`);
}

function removeForm(element, formerTextContent, typeInfo) {
    // Rétablir le texte précédent
    element.textContent = formerTextContent;

    //enelever le formulaire
    element.parentElement.querySelector('.new_info').innerHTML = "";

    // Supprimer l'attribut onclick
    element.removeAttribute("onclick");

    // Ajouter l'attribut onclick pour réactiver l'ajout de formulaire
    element.setAttribute("onclick", `addFormulaire(this, '${typeInfo}')`);
}


</script>





