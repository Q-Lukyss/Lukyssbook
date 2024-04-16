<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/img/embleme-02.png" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/defaultLogin.css">
    <title><?= $titre ?></title>
    <meta name="description" content="<?= $desc ?>">
</head>
<body>
    <header>
        <div class="site_name">
            <h1>LukyssBook</h1>
        </div>
        <?php if(isset($info_connexion) && $info_connexion == "error") echo '<div class="error_login" style="color: red;" >Informations erronées</div>' ?>
        <form action="<?= site_url("user/login") ?>" method="post" name="login">
            <div class="pseudo_container">
                <!-- pseudo et mail -->
                <label for="pseudo">Pseudo/Email</label>
                <input type="text" name="pseudo" required value="<?php echo set_value('pseudo'); ?>">
            </div>
            <div class="mdp_container">
                <label for="mdp">Mot de Passe</label>
                <input type="password" name="mdp" required value="<?php echo set_value('mdp'); ?>">
            </div>
            <a href="<?= site_url('User/reset_mdp/') ?>" class="reset_mdp">Mot de Passe oublié</a>
            <button type="submit">Connexion</button>
        </form>
    </header>

    <div class="animation-container">
            <div class="top-side">
            </div>
            <div class="middle">
                <span>LukyssBook</span>
            </div>
            <div class="bottom-side">
            </div>
        </div>
    </div>


    <?= $output; ?>
    <!-- <footer>
        <h3 style="color: plum;">by Lukyss</h3>
    </footer> -->
</body>
<script>
    //creer un requette XmlHttp
        function getxhr(){ 
            if (window.XMLHttpRequest){
                xhr=new XMLHttpRequest();
            }
            else if(window.ActiveXObject){
                try{
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e){
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            }
            return xhr;
        }
        function getCommuneByCp() {
            var codePostal = document.querySelector('[name="cp"]').value;
            var communeSelect = document.querySelector('[name="ville"]');
            communeSelect.innerHTML = ""; // Supprimer les options existantes

            var xhr = getxhr();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                var communes = [];

                for (var i = 0; i < response.length; i++) {
                    if (response[i].fields.code_postal.startsWith(codePostal)) {
                    var commune = response[i].fields.nom_de_la_commune;
                    communes.push(commune);
                    }
                }

                if (communes.length > 0) {
                    for (var j = 0; j < communes.length; j++) {
                    var option = document.createElement("option");
                    option.text = communes[j];
                    communeSelect.add(option);
                    }
                } else {
                    var option = document.createElement("option");
                    option.text = "Aucune commune trouvée";
                    communeSelect.add(option);
                }
                }
            };
            //On veut récupérer des infos du serveur donc GET
            xhr.open("GET", "/assets/ressources/laposte_hexasmal.json", true);
            xhr.send();
        }
    
        function handleChange() {
            var codeCp = document.querySelector('[name="cp"]').value.length;
            var communeSelect = document.querySelector('[name="ville"]');
            
            if (codeCp === 5) {
                communeSelect.removeAttribute("disabled");
                getCommuneByCp();
            } else {
                communeSelect.value = "";
                communeSelect.setAttribute("disabled", "disabled");
            }
        }
</script>
</html>
