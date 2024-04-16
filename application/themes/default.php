<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= site_url("assets/img/embleme-02.png") ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= site_url("assets/css/default.css") ?>">
    <!-- font -->
    <link href="/assets/fileuploader//dist/font/font-fileuploader.css" media="all" rel="stylesheet">
    <!-- css -->
    <link href="/assets/fileuploader//dist/jquery.fileuploader.min.css" media="all" rel="stylesheet">

    <!-- js -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="/assets/fileuploader/dist/jquery.fileuploader.min.js" type="text/javascript"></script>
    <title><?= $titre ?></title>
    <meta name="description" content="<?= $desc ?>">
    <link rel="canonical" href="<?= site_url("User/") ?>" />
</head>
<body>
    <header>
        <div class="site_name">
            <h1><a href="<?= site_url("User/mur/".$this->session->userdata("usr_id")) ?>">LukyssBook</a></h1>
        </div>


        <div class="rechercher_container">
            <a href="<?= site_url('User/search_friend/') ?>" name="friend_search">
                Chercher des amis
            </a>
        </div>
           
        <nav>
            <div class="notification_container">
                <img src="<?= site_url("assets/img/bouton-notifications_blanc.png") ?>" alt="notification icone"  onclick="toggleNotificationMenu();">
                <div class="notif_redball_container">
                    <p class="notif_redball_number">99+</p>
                </div>
            </div>
            <!-- Code pour faire apparaitre le menu notification -->
            <div class="notification_menu">
                <div class="triangle_menu_notification"></div>
                <div class="menu_menu_notification">
                    <h3>Notifications</h3>

                    <div class="notification_container"></div>
                    
                    <div class="menu_bottom">
                        <a href="">Voir tout</a>
                    </div>
                </div>

            </div>
            <!-- Fin -->

           


            <div class="messenger_container">
                <div class="messenger_redball_container">
                    <p class="messenger_redball_number">99+</p>
                </div>
                <img src="<?= site_url("assets/img/discussion_white.png") ?>" alt="messenger icone" onclick="toggleMessengerMenu();">
            </div>

            <!-- Code pour faire apparaitre le menu Messenger -->
            <div class="messenger_menu">
                <div class="triangle_menu_messenger"></div>
                <div class="menu_menu_messenger">
                    <h3>Messenger</h3>
                    <div class="menu_messenger_div_recherche">
                        <input type="text" name="menu_messenger_rechercher">
                        <img class="menu_messenger_icone_recherche" src="<?= site_url("assets/img/recherche-a-la-loupe.png") ?>" alt="icone loupe">
                    </div> 
                    <div class="messenger_conversation_list"></div>
                    <div class="menu_bottom">
                        <a href="">Voir tout dans Messenger</a>
                    </div>
                </div>
            </div>
            <!-- Fin -->



            <div class="imageProfil_container">
                <img src="<?= site_url("assets/uploads/".$this->session->userdata("usr_image_profil")) ?>" alt="image de profil"  onclick="toggleProfilMenu();">
            </div>

            <!-- Code pour faire apparaitre le menu Profil -->
            <div class="profil_menu">
                <div class="triangle_menu_profil"></div>
                <div class="menu_menu_profil">
                    <h3>Profil</h3>
                    <div class="menu_row">
                        <img src="<?= site_url("assets/img/editer.png") ?>" alt="icone editer">
                        <a href="<?= site_url("User/profil/".$this->session->userdata("usr_id")) ?>">Mon Profil</a>
                    </div>
                    <div class="menu_row">
                        <img src="<?= site_url("assets/img/oeil.png") ?>" alt="icone voir">
                        <a href="">Voir mon Profil du point de vue <br>d'un autre utilisateur</a>
                    </div>
                    <div class="menu_row">
                        <img src="<?= site_url("assets/img/option-de-deconnexion.png") ?>" alt="icone déconnexion">
                        <a href="<?= site_url("User/deconnexion") ?>">Déconnexion</a>
                    </div>
                </div>
            </div>
            <!-- Fin -->
           
           
            <div class="burger_container" style="color: black;" onclick="toggleHamburgerMenu();">
                <div class="burger">
                    <img id="hamburger_state" src="<?= site_url("assets/img/burger-bar_pink.png") ?>" alt="hamburger icone" >
                </div>
                </div>
            </div>

            <!-- Code pour faire apparaitre le menu Hamburger -->
            <div class="hamburger_menu">
                <div class="triangle_menu_hamburger"></div>
                <div class="menu_menu_hamburger">
                    <h3>Menu</h3>
                    <div class="menu_row">
                        <img src="<?= site_url("assets/img/parametres.png") ?>" alt="icone editer">
                        <a href="<?= site_url("Parametres/index/".$this->session->userdata("usr_id")) ?>">Paramètres</a>
                    </div>
                    <div class="menu_row">
                        <img src="<?= site_url("assets/img/theme.png") ?>" alt="icone voir">
                        <a href="">Affichage</a>
                    </div>
                    <div class="menu_row">
                        <img src="<?= site_url("assets/img/option-de-deconnexion.png") ?>" alt="icone déconnexion">
                        <a href="<?= site_url("User/deconnexion") ?>">Déconnexion</a>
                    </div>
                </div>
            </div>
            <!-- Fin -->
            
        </nav>
    </header>
    <?= $output; ?>

    <!-- HTML pour la boîte de dialogue de messagerie instantanée -->
<div id="message-popup" class="message-popup">
    <input type="hidden" name="destinataire_id">
    <div class="message-popup-content">
        <span class="close-button">&times;</span>
        <h2>test</h2>
        <div class="conversation_msg"></div>
        <div class="bottom_div">
            <textarea class="message_input" placeholder="Tapez votre message ici..."></textarea>
            <button class="btn_envoyer_msg">
                <img src="<?= site_url('assets/img/paper-plane.png') ?>" alt="image envoyer">
            </button>
        </div>
        
    </div>
</div>

    <!-- <footer>
        <h3 style="color: plum;">by Lukyss</h3>
    </footer> -->
</body>
<script>

    let menuHamburgerState = false;
    let menuNotificationState = false;
    let menuMessengerState = false;
    let menuProfilState = false;


    function toggleHamburgerMenu(){
        let menuHamburger = document.querySelector('.hamburger_menu');
        let img = document.getElementById("hamburger_state");
        if(!menuHamburgerState){
            closeAllMenus();
            menuHamburgerState = true;
            menuHamburger.style.display = 'block';
            img.src = "<?= site_url("assets/img/croix_rose1.png") ?>"
        }
        else{
            menuHamburgerState = false;
            menuHamburger.style.display = 'none';
            img.src = "<?= site_url("assets/img/burger-bar_pink.png") ?>";
        }
    }


    function toggleMessengerMenu(){
        let menuMessenger = document.querySelector('.messenger_menu');
        if(!menuMessengerState){
            closeAllMenus();
            menuMessengerState = true;
            menuMessenger.style.display = 'block';
            //Appel ajax pour récup les convs
            get_all_conversations();
        }
        else{
            menuMessengerState = false;
            menuMessenger.style.display = 'none';
        }

    }

    function toggleNotificationMenu(){
        let menuNotif = document.querySelector('.notification_menu');
        if(!menuNotificationState){
            closeAllMenus();
            menuNotificationState = true;
            // console.log("menu notification apparait");
            menuNotif.style.display = 'block';
        }
        else{
            menuNotificationState = false;
            // console.log("menu notification disparait");
            menuNotif.style.display = 'none';
        }
   
    }

    function toggleProfilMenu(){
        let menuProfil = document.querySelector('.profil_menu');
        if(!menuProfilState){
            closeAllMenus();
            menuProfilState = true;
            menuProfil.style.display = 'block';
        }
        else{
            menuProfilState = false;
            menuProfil.style.display = 'none';
        }
 
    }

    function closeAllMenus(){
        let menuNotif = document.querySelector('.notification_menu');
        let menuMessenger = document.querySelector('.messenger_menu');
        let menuProfil = document.querySelector('.profil_menu');
        let menuHamburger = document.querySelector('.hamburger_menu');
        let img = document.getElementById("hamburger_state");

        let arr = [menuNotif, menuMessenger, menuProfil, menuHamburger];
        arr.forEach(e => {
            e.style.display = 'none';
           
        });
        menuHamburgerState = false;
        menuNotificationState = false;
        menuMessengerState = false;
        menuProfilState = false;

        img.src = "<?= site_url("assets/img/burger-bar_pink.png") ?>";

        // console.log("menu messenger = "+menuMessengerState);
        // console.log("menu notif = "+menuNotificationState);
        // console.log("menu profil = "+menuProfilState);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input.files').fileuploader({
            // Options will go here
        });
    });
</script>
<script>    
    ///////////////////////////////////////////////////////////////////////////// Script pour gérer le fait de commenter /////////////////////////////////////////////////////////////////////////////////////
    document.querySelectorAll('.commenter_container').forEach(function(container) {
        container.style.display = 'none';
    });
    

    function toggleComment(element){
        // console.log(element.parentElement.parentElement.parentElement)
        let targetElement = element.parentElement.parentElement.parentElement;
        if (targetElement.querySelector('.commenter_container').style.display == 'none') {
            targetElement.querySelector('.commenter_container').style.display = 'flex';
        }
        else targetElement.querySelector('.commenter_container').style.display = 'none';
    }
    function editPost(element, id){
        // console.log(element.parentElement.parentElement.parentElement)
        let targetElement = element.parentElement.parentElement;

        let contenu =  targetElement.querySelector('.post_contenu_post').textContent


        targetElement.querySelector('.div_contenu_post').innerHTML = `
            <form action="<?= site_url("Post/edit") ?>" method="post">
                <input type="hidden" name="id_post" value="${id}">
                <textarea name="contenu" class="contenu_post" cols="30" rows="10">${contenu}</textarea>
                <input type="hidden" name="where_to_redirect" value="<?= current_url() ?>">
                <button type="submit">Valider</button>
            </form>`;

        targetElement.querySelector('.icones_container').style.display = 'none';
    }
</script>
<script>
    ////////////////////////////////////////////////////////////Script ajax pour gérer les selects dans Paramètres
    document.addEventListener("DOMContentLoaded", function() {
        var selects = document.querySelectorAll('select[name^="param_"]');
        selects.forEach(function(select) {
            select.addEventListener("change", function() {
                var selectValue = this.value;
                var databaseColonne = this.name;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "<?= site_url("parametres/update_select/") ?>", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            
                        } else {
                            console.error('Erreur dans la requête Ajax');
                        }
                    }
                };
                xhr.send("value=" + encodeURIComponent(selectValue) + "&column=" + encodeURIComponent(databaseColonne)+ "&usr_id=" + encodeURIComponent(<?= $this->session->userdata("usr_id") ?>));
            });
        });
    });


    function updateImage(selecteur){
        selecteurValue = document.querySelector('[name="' + selecteur + '"]').value;
        console.log(selecteurValue);
        image = document.querySelector('.' + selecteur + '_image')
        switch (selecteurValue) {
            case "1":
                image.src = "<?= site_url("assets/img/utilisateur.png") ?>";
                image.alt = "image moi uniquement"
                break;
            case "2":
                image.src = "<?= site_url("assets/img/silhouette-dutilisateurs-multiples.png") ?>";
                image.alt = "image amis et moi"
                break;
            default:
                image.src = "<?= site_url("assets/img/carte-du-monde.png") ?>";
                image.alt = "image monde"
                break;
        }
    }
</script>
<script>
/////////////////////////////////////////////////////////////////////// Script Ajax pour la recherche de profils

</script>
<script>
//////////////////////////////////////////////////////////////////////////////Gérer les likes Post
$('.btn_like').click(function() {
  // Récupérer l'ID du contenu à liker
  var contentId = $(this).data('post_id');
  var liked = $(this).hasClass('liked');

  if (!liked) {

    $.ajax({
      url: "<?= site_url('post/like/') ?>" + contentId,
      method: 'POST',
      data: {
        contentId: contentId,
        userId: <?= $usr_id ?>
      },
      success: function(response) {
        $('.btn_like[data-post_id="' + contentId + '"]').addClass('liked');
        // Incrémenter le compteur de likes
        var likeCount = parseInt($('.btn_like[data-post_id="' + contentId + '"]').siblings('span').text());
        $('.btn_like[data-post_id="' + contentId + '"]').siblings('span').text(likeCount + 1);

        // Changer l'image en pouce rose
        $('.btn_like[data-post_id="' + contentId + '"]').attr('src', '<?= site_url("assets/img/pouce_rose.png") ?>');
        
      },
      error: function(error) {
        // Gérer l'erreur
      }
    });
  } else {
    $.ajax({
      url: "<?= site_url('post/unlike/') ?>" + contentId, // URL pour supprimer le like
      method: 'POST',
      data: {
        contentId: contentId,
        userId: <?= $usr_id ?>
      },
      success: function(response) {
        $('.btn_like[data-post_id="' + contentId + '"]').removeClass('liked');
        // Décrémenter le compteur de likes
        var likeCount = parseInt($('.btn_like[data-post_id="' + contentId + '"]').siblings('span').text());
        $('.btn_like[data-post_id="' + contentId + '"]').siblings('span').text(likeCount - 1);

        // Changer l'image en pouce transparent
        $('.btn_like[data-post_id="' + contentId + '"]').attr('src', '<?= site_url("assets/img/pouce.png") ?>');
    
      },
      error: function(error) {
        // Gérer l'erreur
      }
    });
  }
});
////////////////////////////////////////////////////////////////////////////////////Gérer les commentaires
var currentUrl = "<?= current_url(); ?>";

$('.btn_commenter').click(function() {
    let currentButton = $(this);  // Stockez une référence au bouton actuel
    let postWrapper = currentButton.closest('.post_wrapper'); // Trouvez le conteneur du message
    
    $.ajax({
        url: "<?= site_url('Commenter/index/') ?>",
        method: 'POST',
        data: {
            commentaire: document.getElementById('commentaire').value,
            id_post: this.parentElement.parentElement.querySelector('.id_post').value,
            userId: <?= $usr_id ?>,
            where_to_redirect: currentUrl,
            type: "rang1"
        },
        success: function(response) {
            // Mettez à jour la section des commentaires spécifique
            let sectionCommentaire = postWrapper.find('.section_commentaire');
            sectionCommentaire.empty();  // Videz la section des commentaires
            startFrom = 0;  // Réinitialisez la position de départ
            
            // Déclenchez un clic sur le bouton de chargement des commentaires
            postWrapper.find('.get_comment').trigger('click');
            
            // Cachez la div du commentaire
            postWrapper.find('.commenter_container').css('display', 'none');
            
            // Videz le champ de texte (text area)
            postWrapper.find('[name="commentaire_textarea"]').val('');

            // Incrémentez la valeur du compteur de commentaires
            let commentaireCountElement = postWrapper.find('.commentaire_count');
            let currentCommentCount = parseInt(commentaireCountElement.text());
            commentaireCountElement.text(currentCommentCount + 1);
        },
        error: function(error) {
            // Gérez l'erreur
        }
    });
});

let startFrom = 0; // Initialisation de la position de départ

$('.get_comment').click(function() {
    
    let postId = $(this).data('post_id');
    let postWrapper = $(this).closest('.post_wrapper');
    let sectionCommentaire = postWrapper.find('.section_commentaire');

    startFrom = 0;

    // Si la section_commentaire est vide, charge les commentaires via AJAX
    if (sectionCommentaire.is(':empty')) {
        $.ajax({
            url: "<?= site_url('Commenter/get_comments/') ?>",
            type: 'POST',
            dataType: 'html',
            data: { 
                post_id: postId,
                start_from: startFrom,
                nb_comment: parseInt(postWrapper.find('.commentaire_count').text()),
            },
            success: function(data) {
                // Remplace le contenu de la div section_commentaire spécifique
                sectionCommentaire.html(data);

//*********************************************************** */ Script pour gérer la div répondre
            document.querySelectorAll('.commenter_container_response').forEach(function(container) {
                container.style.display = 'none';
            });
    
                // Met à jour la position de départ pour la prochaine requête
                startFrom += 10;
            }
        });
    } else {
        // Si la section_commentaire n'est pas vide, vide-la pour masquer les commentaires
        sectionCommentaire.empty();
    }
});

///////////////////////////////////////////////////////////////////////////////Gérer la mise à jours des commentaire au fur et à mesure du scroll
$(".section_commentaire").scroll(function() {
    let postWrapper = $(this).closest('.post_wrapper');

    // Récupérer la valeur du champ id_post 
    let postId = postWrapper.find('.id_post').val();

    let sectionCommentaire = postWrapper.find('.section_commentaire');

    if ($(this).scrollTop() + $(this).height() >= $(this)[0].scrollHeight) {
        $.ajax({
            url: "<?= site_url('Commenter/get_comments/') ?>",
            type: 'POST',
            dataType: 'html',
            data: { 
                post_id: postId,
                start_from: parseInt(startFrom),
                nb_comment: parseInt(postWrapper.find('.commentaire_count').text()),
            },
            success: function(data) {
                sectionCommentaire.append(data);
                startFrom += 10;

                //*********************************************************** */ Script pour gérer la div répondre
            document.querySelectorAll('.commenter_container_response').forEach(function(container) {
                container.style.display = 'none';
            });
            }
        });
    }
});


///ici car sinon comme les classes existent pas encore ça fait rien
//Erratum j'ai ajouté la propagation d'evenements et ça fonctionne nickel
//////////////////////////////////////////////////////////////////////////////Gérer les likes Commentaire
$('body').on('click', '.btn_like_commentaire',function() {
  // Récupérer l'ID du contenu à liker
  var contentId = $(this).data('commentaire_id');
  var liked = $(this).hasClass('liked');

  if (!liked) {

    $.ajax({
      url: "<?= site_url('commenter/like/') ?>",
      method: 'POST',
      data: {
        commentaire_id: contentId,
        userId: <?= $usr_id ?>
      },
      success: function(response) {
        $('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').addClass('liked');
        // Incrémenter le compteur de likes
        var likeCount = parseInt($('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').siblings('span').text());
        $('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').siblings('span').text(likeCount + 1);

        // Changer l'image en pouce rose
        $('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').attr('src', '<?= site_url("assets/img/pouce_rose.png") ?>');
        
      },
      error: function(error) {
        // Gérer l'erreur
      }
    });
  } else {
    $.ajax({
      url: "<?= site_url('commenter/unlike/') ?>", // URL pour supprimer le like
      method: 'POST',
      data: {
        commentaire_id: contentId,
        userId: <?= $usr_id ?>
      },
      success: function(response) {
        $('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').removeClass('liked');
        // Décrémenter le compteur de likes
        var likeCount = parseInt($('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').siblings('span').text());
        $('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').siblings('span').text(likeCount - 1);

        // Changer l'image en pouce transparent
        $('.btn_like_commentaire[data-commentaire_id="' + contentId + '"]').attr('src', '<?= site_url("assets/img/pouce.png") ?>');
    
      },
      error: function(error) {
        // Gérer l'erreur
      }
    });
  }
});
//////////////////////////////////////////////////////////////////////////////Gérer suppression/edition Commentaire
//Suppression
$('body').on('click', '.btn_remove_commentaire',function() {
  // Récupérer l'ID du contenu à liker
  var contentId = $(this).data('commentaire_id');
  var targetDiv = $(this).closest(".post_wrapper");

    $.ajax({
      url: "<?= site_url('commenter/remove_comment/') ?>",
      method: 'POST',
      data: {
        commentaire_id: contentId,
        userId: <?= $usr_id ?>
      },
      success: function(response) {
      
        // Mettre à jour le compteur de commentaires
        
        var commentaireCount = parseInt(targetDiv.find('.commentaire_count').text());

        // Supprimer la div commentaire_row_container du commentaire
        $('.commentaire_row_container[data-commentaire_id="' + contentId + '"]').remove();
        targetDiv.find('.commentaire_count').text(commentaireCount - 1);

        // console.log(targetDiv.find('.commentaire_count').text());
        //Si aucun commentaires afficher aucun commentaires
        if(targetDiv.find('.commentaire_count').text() == "0"){
            // console.log("yeaaaaaaaaaaaah")
            targetDiv.find('.section_commentaire').find(".section_titre").text("Aucun commentaire")
        }
  
      
        
      },
      error: function(error) {
        // Gérer l'erreur
      }
    });
});
//Edition
$(document).ready(function() {
  $('body').on('click', '.editer_commentaire',function() {
      const boutonEdition = $(this); // Référence au bouton d'édition
      const commentaireContainer = boutonEdition.closest('.commentaire_row_container');
      const contenuCommentaire = commentaireContainer.find('.post_contenu_commentaire');
      const getComment = $(this).closest(".post_wrapper").find(".comment_container  ").find(".get_comment");

      //Reset du startFrom
      startFrom = 0;

      const contenuActuel = contenuCommentaire.text().trim();

      const textarea = $('<textarea class="edit_commentaire_textarea"></textarea>').text(contenuActuel);
      contenuCommentaire.replaceWith(textarea);

      // Crée le bouton de sauvegarde avec l'icône check
      const saveButton = $('<img class="ico_post enregistrer_edition" src="<?= site_url("assets/img/check.png") ?>" alt="icone_enregistrer">');

      //envoyer en bdd au click du save button
      saveButton.click(function() {
          let nouveauContenu = textarea.val();
          

          console.log(getComment.html());

              $.ajax({
              url: "<?= site_url('commenter/edit/') ?>",
              method: 'POST',
              data: {
                commentaire_id: commentaireContainer.data("commentaire_id"),
                userId: <?= $usr_id ?>, 
                commentaire_contenu: nouveauContenu,
              },
              success: function(response) {
                // Simuler deux click sur getComment
                // console.log("success");
                getComment.click();
                getComment.click();
                
              },
              error: function(error) {
                // Gérer l'erreur
              }
            });
      });

      boutonEdition.replaceWith(saveButton);
  });

});

var startFromResponse = 0; // Initialisation de la position de départ

$('body').on('click', '.get_comment_response', function() {

    let postWrapper = $(this).closest('.post_wrapper');
    let postId = postWrapper.data('post_id');
    let commentaireRow = $(this).closest('.commentaire_row_container');
    let commentID = commentaireRow.data('commentaire_id');
    let sectionReponse = commentaireRow.find(".section_reponse");
    

    startFromResponse = 0;

    // Si la section_commentaire est vide, charge les commentaires via AJAX
    if (sectionReponse.is(':empty')) {
        $.ajax({
            url: "<?= site_url('Commenter/get_responses/') ?>",
            type: 'POST',
            dataType: 'html',
            data: { 
                post_id: postId,
                commentaire_id: commentID,
                start_from_response: startFromResponse,
                nb_comment_post: parseInt(postWrapper.find('.commentaire_count').text()),
                nb_comment_response: parseInt(commentaireRow.find('.commentaire_response_count').text())
            },
            success: function(data) {
                // Remplace le contenu de la div section_commentaire spécifique
                sectionReponse.html(data);
                sectionReponse.css({
                    "border": "2px solid var(--main-darker)",
                    "margin": "2%",
                    "margin-left": "10%",
                    // Vous pouvez ajouter d'autres règles ici si nécessaire
                });

//*********************************************************** */ Script pour gérer la div répondre
            document.querySelectorAll('.commenter_container_response').forEach(function(container) {
                container.style.display = 'none';
            });
    
                // Met à jour la position de départ pour la prochaine requête
                startFromResponse += 10;
            }
        });
    } else {
        // Si la section_commentaire n'est pas vide, on la vide pour masquer les commentaires
        sectionReponse.empty();
        sectionReponse.css({
        "border": "",
        "margin": "",
        "margin-left": ""
        
    });
    }
});


// ****************************************************************** Gérer l'action de répondre à un commentaire 
$('body').on('click', '.btn_commenter_response', function() {
    let currentButton = $(this);  
    let postWrapper = currentButton.closest('.post_wrapper'); 
    let commentaireRow = currentButton.closest('.commentaire_row_container'); 
    
    $.ajax({
        url: "<?= site_url('Commenter/index/') ?>",
        method: 'POST',
        data: {
            commentaire: commentaireRow.find(".commentaire_textarea").val(),
            id_post: postWrapper.data("post_id"),
            commentaire_id: commentaireRow.data("commentaire_id"),
            userId: <?= $usr_id ?>,
            where_to_redirect: currentUrl,
            type: "rang2",
        },
        success: function(response) {
            // Mettez à jour la section des commentaires spécifique
            let sectionCommentaire = postWrapper.find('.section_commentaire');
            sectionCommentaire.empty();  // Videz la section des commentaires
            startFrom = 0;  // Réinitialisez la position de départ
            
            // Déclenchez un clic sur le bouton de chargement des commentaires
            postWrapper.find('.get_comment').trigger('click');
            
            // Cachez la div du commentaire
            postWrapper.find('.commenter_container').css('display', 'none');
            
            // Videz le champ de texte (text area)
            postWrapper.find('[name="commentaire_textarea"]').val('');

            // Incrémentez la valeur du compteur de commentaires
            let commentaireCountElement = postWrapper.find('.commentaire_count');
            let currentCommentCount = parseInt(commentaireCountElement.text());
            commentaireCountElement.text(currentCommentCount + 1);
        },
        error: function(error) {
            // Gérez l'erreur
        }
    });
});
</script>
<script>
//************************************************************* Tous ce qui a attrait aux réponses au commentaires
//*********************************************************** */ Script pour gérer la div répondre

    function toggleCommentResponse(element){
        // console.log(element.parentElement.parentElement.parentElement)
        let targetElement = element.parentElement.parentElement.parentElement;
        console.log(targetElement);
        if (targetElement.querySelector('.commenter_container_response').style.display == 'none') {
            targetElement.querySelector('.commenter_container_response').style.display = 'flex';
        }
        else targetElement.querySelector('.commenter_container_response').style.display = 'none';
    }



// ****************************************************************** Gérer l'action de répondre à une réponse
$('body').on('click', '.btn_repondre_response', function() {
    let currentButton = $(this);  
    let postWrapper = currentButton.closest('.post_wrapper'); 
    let commentaireRow = currentButton.closest('.commentaire_row_container'); 
    let sectionResponse = currentButton.closest('.section_reponse'); 
    
    $.ajax({
        url: "<?= site_url('Commenter/index/') ?>",
        method: 'POST',
        data: {
            commentaire: commentaireRow.find(".commentaire_textarea").val(),
            id_post: postWrapper.data("post_id"),
            commentaire_id: sectionResponse.data("commentaire_id"),
            userId: <?= $usr_id ?>,
            where_to_redirect: currentUrl,
            type: "rang3",
        },
        success: function(response) {
            // Mettez à jour la section des commentaires spécifique
            let sectionCommentaire = postWrapper.find('.section_commentaire');
            sectionCommentaire.empty();  // Videz la section des commentaires
            startFrom = 0;  // Réinitialisez la position de départ
            
            // Déclenchez un clic sur le bouton de chargement des commentaires
            postWrapper.find('.get_comment').trigger('click');
            
            // Cachez la div du commentaire
            postWrapper.find('.commenter_container').css('display', 'none');
            
            // Videz le champ de texte (text area)
            postWrapper.find('[name="commentaire_textarea"]').val('');

            // Incrémentez la valeur du compteur de commentaires
            let commentaireCountElement = postWrapper.find('.commentaire_count');
            let currentCommentCount = parseInt(commentaireCountElement.text());
            commentaireCountElement.text(currentCommentCount + 1);
        },
        error: function(error) {
            // Gérez l'erreur
        }
    });
});

//*********************************************************************************Récupérer toutes les conversations
function get_all_conversations(){
  
    
    $.ajax({
        url: "<?= site_url('Messenger/get_all_conversations') ?>",
        method: 'POST',
        data: {
            usr_id: <?= $usr_id ?>,         
        },
        dataType: 'html',
        success: function(response) {
            $('header').find('.messenger_conversation_list').html(response);
        },
        error: function(error) {
            // Gérez l'erreur
        }
    });
}
 


//************************************************************************************************************************ 
//**************************  Récupérer le nombre de message non lu pour la bulle au dessus de messenger
function get_nb_unread_messages(){
    $.ajax({
        type: 'POST',
        url: '<?= site_url("Messenger/get_unread_msg") ?>', 
        dataType: 'html',
        success: function(response) {
            let red_ball = $('body').find('.messenger_redball_container');
            if (response > 0) {
                red_ball.css('display', 'flex');
                red_ball.find('.messenger_redball_number').text(response);
            }
            else if(response >= 99){
                red_ball.css('display', 'flex');
                red_ball.find('.messenger_redball_number').text('99+');
            }
            else if(response == 0){
                red_ball.css('display', 'none');
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
$(document).ready(function() {
     // Lancer la fonction immédiatement lors du chargement du document
     get_nb_unread_messages();

    // Définir un intervalle de 2 minutes (en millisecondes)
    setInterval(function() {
        get_nb_unread_messages();
    }, 2 * 60 * 1000); // 2 minutes * 60 secondes * 1000 millisecondes
});
//************************************************************************* Récupérer les contacts
 $(document).ready(function() {
    // Lancer l'appel AJAX directement lors du chargement du document
    $.ajax({
        type: 'POST',
        url: '<?= site_url("User/get_contact/") ?>', 
        dataType: 'html',
        success: function(response) {
            // Ajoutez la réponse HTML à la div avec la classe "contact_list"
            $('.contact_list').html(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});

// Attachez un gestionnaire d'événements click aux éléments avec la classe "contact_row"
$('body').on('click', '.contact_row', function() {
    //Fermer les menus
    closeAllMenus();
    // Obtenez les données de l'élément cliqué
    let usrId = $(this).data('contact_id');
    let usrPseudo = $(this).find('span').text();

    var popup = $('.message-popup');
    popup.find('[name="destinataire_id"]').val(usrId);
    popup.css('display', 'block');

    popup.find('h2').text(usrPseudo);

    // Récupérer le contenu d'une conversation
    let limit_msg = 20;

    //Vider la div
    $('.conversation_msg').html('');
   
    $.ajax({
        type: 'POST',
        url: '<?= site_url("Messenger/get_messages") ?>', 
        data: {
            usr_id: <?= $usr_id ?>,  
            destinataire_id: usrId,
        },
        dataType: 'html',
        success: function(response) {
            // Ajoutez la réponse HTML à la div avec la classe "contact_list"
            $('.conversation_msg').html(response);

            // Faites défiler vers le bas de l'élément '.conversation_msg' au maximum
            $('.conversation_msg').scrollTop($('.conversation_msg')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    //Mettre a jour les notifs messenger
    get_nb_unread_messages();

});

// Attachez un gestionnaire d'événements click aux éléments avec la classe "conversation_row"
$('body').on('click', '.conversation_row', function() {
    
    // Obtenez les données de l'élément cliqué
    let conversation_id = $(this).data('conversation_id');
    let usrPseudo = $(this).data('conversation_name');

    var popup = $('.message-popup');
    popup.find('[name="destinataire_id"]').val('conversation_id'+conversation_id);
    popup.css('display', 'block');

    popup.find('h2').text(usrPseudo);

    //Vider la div
    $('.conversation_msg').html('');

    // Récupérer le contenu d'une conversation
    let limit_msg = 20;
   
    $.ajax({
        type: 'POST',
        url: '<?= site_url("Messenger/get_messages") ?>', 
        data: {
            conversation_id: conversation_id,
            usr_id: <?= $usr_id ?>,         
        },
        dataType: 'html',
        success: function(response) {
            // Ajoutez la réponse HTML à la div avec la classe "contact_list"
            $('.conversation_msg').html(response);

            // Faites défiler vers le bas de l'élément '.conversation_msg' au maximum
            $('.conversation_msg').scrollTop($('.conversation_msg')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    //Mettre a jour les notifs messenger
    get_nb_unread_messages();

});

// Attachez un gestionnaire d'événements click aux boutons envoyer sur les pages de profil
$('body').on('click', '.btn_envoyer_msg_profil', function() {
    //Fermer les menus
    closeAllMenus();
    // Obtenez les données de l'élément cliqué
    let usrId = $(this).data('contact_id');
    let usrPseudo = $(this).data('contact_pseudo');

    var popup = $('.message-popup');
    popup.find('[name="destinataire_id"]').val(usrId);
    popup.css('display', 'block');

    popup.find('h2').text(usrPseudo);

    // Récupérer le contenu d'une conversation
    let limit_msg = 20;

    //Vider la div
    $('.conversation_msg').html('');
   
    $.ajax({
        type: 'POST',
        url: '<?= site_url("Messenger/get_messages") ?>', 
        data: {
            usr_id: <?= $usr_id ?>,  
            destinataire_id: usrId,
        },
        dataType: 'html',
        success: function(response) {
            // Ajoutez la réponse HTML à la div avec la classe "contact_list"
            $('.conversation_msg').html(response);

            // Faites défiler vers le bas de l'élément '.conversation_msg' au maximum
            $('.conversation_msg').scrollTop($('.conversation_msg')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
    //Mettre a jour les notifs messenger
    get_nb_unread_messages();

});


//************************************************** Mettre à jour les messages si un boite de dialogue est ouvert
function fetchMessages() {
    var conversationId = $('.conversation_msg').find('.msg_row:first').data('conversation_id');
    
    $.ajax({
        type: 'POST',
        url: '<?= site_url("Messenger/get_messages") ?>', 
        data: {
            conversation_id: conversationId,
            usr_id: <?= $usr_id ?>,         
        },
        dataType: 'html',
        success: function(response) {
            // Ajoutez la réponse HTML à la div avec la classe "conversation_msg"
            $('.conversation_msg').html(response);

            // Faites défiler vers le bas de l'élément '.conversation_msg' au maximum
            $('.conversation_msg').scrollTop($('.conversation_msg')[0].scrollHeight);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

// Fonction pour vérifier si la div est visible et effectuer la requête Ajax si nécessaire
function checkAndFetchMessages() {
    if ($('#message-popup').is(':visible')) {
        fetchMessages();
    }
}

// Exécuter la vérification toutes les deux minutes
setInterval(checkAndFetchMessages, 120000); // 120000 ms = 2 minutes





// JavaScript pour fermer la boîte de dialogue
$('body').on('click', '.close-button', function() {
    var popup = $('#message-popup');
    popup.css('display', 'none');
    popup.find('.msg_response').remove();
    popup.find('.message_input').val("");

});



$('body').on('click', '.btn_envoyer_msg', function() {
    // Obtenez les données de l'élément parent .message-popup
    closeAllMenus();
    let popup = $(this).closest('.message-popup');
    let usrIdDestinataire = popup.find('[name="destinataire_id"]').val();
    let messageContenu = popup.find('.message_input').val();
    
    if (usrIdDestinataire.includes("conversation_id")) {
        usrIdDestinataire = usrIdDestinataire.replace("conversation_id", "");
        data = {
            message_contenu: messageContenu,
            usr_id_envoyeur: <?= $usr_id ?>,
            usr_id_destinataire: usrIdDestinataire,
            conversation_id: usrIdDestinataire,
        };
    } else {
        data = {
            message_contenu: messageContenu,
            usr_id_envoyeur: <?= $usr_id ?>,
            usr_id_destinataire: usrIdDestinataire
        };
    }
    
    $.ajax({
        url: "<?= site_url('Messenger/send_message') ?>",
        method: 'POST',
        data: data, 
        success: function(response) {
            // Effacer le texte du textarea
            popup.find('.message_input').val('');
            
            // Mettre à jour le contenu de '.conversation_msg' avec la réponse HTML
            $('.conversation_msg').html(response);

            // Faire défiler vers le bas de l'élément '.conversation_msg' au maximum
            $('.conversation_msg').scrollTop($('.conversation_msg')[0].scrollHeight);
     

        },
        error: function(error) {
            popup.find('.message-popup-content').append('<p class="msg_response">Une erreur s\'est produite</p>');
        }
    });
    // setTimeout(function() {
    //     // Le code à exécuter après une seconde
    //     popup.find('.close-button').click();
    // }, 1000);

});

//************************************************************************************************************** */

</script>
<script>
    //**********************************************************************************Marche pas */
$('body').on('scroll', '.section_reponse', function() {

let postWrapper = $(this).closest('.post_wrapper');
let postId = postWrapper.data('post_id');
let commentaireRow = $(this).closest('.commentaire_row_container');
let commentID = commentaireRow.data('commentaire_id');
let sectionReponse = commentaireRow.find(".section_reponse");
let sectionParent = postWrapper.find(".section_commentaires");

let scrollThreshold = 100;

let sectionReponseBottom = sectionReponse.offset().top + sectionReponse.height();
let sectionParentBottom = sectionParent.offset().top + sectionParent.height();


  if (sectionReponseBottom >= sectionParentBottom - scrollThreshold) {
    $.ajax({
        url: "<?= site_url('Commenter/get_responses/') ?>",
        type: 'POST',
        dataType: 'html',
        data: { 
            post_id: postId,
            commentaire_id: commentID,
            start_from_response: startFromResponse,
            nb_comment_post: parseInt(postWrapper.find('.commentaire_count').text()),
            nb_comment_response: parseInt(commentaireRow.find('.commentaire_response_count').text())
        },
        success: function(data) {
            // Remplace le contenu de la div section_commentaire spécifique
            sectionReponse.append(data);
            // sectionReponse.css({
            //     "border": "2px solid var(--main-darker)",
            //     "margin": "2%",
            //     "margin-left": "10%",
            //     // Vous pouvez ajouter d'autres règles ici si nécessaire
            // });

//*********************************************************** */ Script pour gérer la div répondre
        document.querySelectorAll('.commenter_container_response').forEach(function(container) {
            container.style.display = 'none';
        });

            // Met à jour la position de départ pour la prochaine requête
            startFromResponse += 10;
        }
    });
}
});
</script>
</html>
