<div class="page_chercher_amis">
            

    <aside class="left_aside"></aside>
    <main>
  
        <div class="titre">
            <h2>Trouvez des amis, <?= $profil["usr_pseudo"] ?></h2>
        </div>

        <div class="content">

        <div class="search_friend_div">
            <form action="<?= site_url("User/search_friend/") ?>" method="POST">
                <input type="text" name="search">
                <button type="submit">Cherchez</button>
            </form>
            
        </div>

        <table border="1">
            <tr>
                <th>
                    Pseudo
                    <a href="<?php echo $order_by == "usr_pseudo" ? ($sens == "asc" ? site_url("User/search_friend/usr_pseudo/desc/".$search) : site_url("User/search_friend/usr_pseudo/asc/".$search)) : site_url("User/search_friend/usr_pseudo/asc/".$search) ?>">
                        <img class="image_tri" src="<?= site_url('assets/img/trier.png') ?>" alt="image tri">
                    </a>
                </th>

                <th>
                    Nom
                    <a href="<?php echo $order_by == "usr_nom" ? ($sens == "asc" ? site_url("User/search_friend/usr_nom/desc/".$search) : site_url("User/search_friend/usr_nom/asc/".$search)) : site_url("User/search_friend/usr_nom/asc/".$search) ?>">
                        <img class="image_tri" src="<?= site_url('assets/img/trier.png') ?>" alt="image tri">
                    </a>
                </th>

                <th>
                    Prénom
                    <a href="<?php echo $order_by == "usr_prenom" ? ($sens == "asc" ? site_url("User/search_friend/usr_prenom/desc/".$search) : site_url("User/search_friend/usr_prenom/asc/".$search)) : site_url("User/search_friend/usr_prenom/asc/".$search) ?>">
                        <img class="image_tri" src="<?= site_url('assets/img/trier.png') ?>" alt="image tri">
                    </a>
                </th>

                <th>
                    Ville 
                    <a href="<?php echo $order_by == "usr_ville" ? ($sens == "asc" ? site_url("User/search_friend/usr_ville/desc/".$search) : site_url("User/search_friend/usr_ville/asc/".$search)) : site_url("User/search_friend/usr_ville/asc/".$search) ?>">
                        <img class="image_tri" src="<?= site_url('assets/img/trier.png') ?>" alt="image tri">
                    </a>
                </th>

                <th>Profil</th>
            </tr>

            <?php
            foreach ($allPossibleFriends as $key => $value) { ?>
                
                <tr>
                    <td>
                        <div>
                            <img class="image_profil" src="<?= site_url("assets/uploads/".$value->usr_image_profil) ?>" alt="image profil de <?= $value->usr_pseudo ?>">
                            <?= $value->usr_pseudo ?>
                        </div>
                        
                    </td>
                    <td><?= $value->usr_nom ?></td>
                    <td><?= $value->usr_prenom ?></td>
                    <td><?= $value->usr_ville ?></td>
                    <td>
                        <a href="<?= site_url("User/profil/".$value->usr_id) ?>">Profil</a>
                    </td>
                </tr>

            <?php }
            ?>
          
          
        </table>
          

        </div>
        
    </main>
    

    <aside class="right_aside"></aside>
</div>





