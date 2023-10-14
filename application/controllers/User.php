<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model("utilisateurs_model", "usersManager");
        $this->load->model("post_model", "Post");
        $this->load->model("ajouter_model", "ajouterManager");
        $this->load->model("suivre_model", "suivreManager");
        $this->load->model("apropos_model","aproposManager");

        
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));

    }

    public function index()
    {
        $this->layout->set_titre("LukyssBook");
        $this->layout->view('login', array(), "defaultLogin");
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pseudo', 'Pseudo/Mail', 'required', array('required' => 'Pseudo/Mail non renseigné'));
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required', array('required' => 'Mot de Passe non renseigné'));

        if ($this->form_validation->run() == FALSE) {
            $this->layout->set_titre("LukyssBook");
            $this->layout->view('login', array(), "defaultLogin");
        } else {
            $pseudo = $this->input->post('pseudo');
            $mdp = md5($this->input->post('mdp'));

            if ($this->usersManager->cb_users($pseudo, $mdp) == 1) {
                $user = $this->usersManager->get_user($pseudo, $mdp);

                $newdata = array(
                    'usr_id'  => $user->usr_id,
                    'usr_pseudo' => $user->usr_pseudo,
                    'usr_mdp' => $user->usr_mdp,
                    'usr_mail' => $user->usr_mail,
                    'usr_cp' => $user->usr_cp,
                    'usr_ville' => $user->usr_ville,
                    'usr_adresse' => $user->usr_adresse,
                    'usr_date_creation' => $user->usr_date_creation,
                    'usr_rang' => $user->usr_rang,
                    'usr_image_profil' => $user->usr_image_profil,
                    'usr_image_border' => $user->usr_image_border
                );

                $this->session->set_userdata($newdata);
                redirect('user/mur/'.$this->session->userdata("usr_id"));
            } else {
                $data['info_connexion'] = 'error';
                $this->layout->set_titre("LukyssBook");
                $this->layout->view('login', $data, "defaultLogin");
            }
        }
    }

public function signup()
{
    $this->load->library('form_validation');
    //Form Rules
    $this->form_validation->set_rules('pseudo_signup', 'Pseudo', 'required|min_length[4]|callback_check_champs', 
    array(
        'required' => 'Pseudo non renseigné',
        'check_champs' => 'Le {field} est déjà pris'
    ));
    $this->form_validation->set_rules('mail', 'Mail', 'required|min_length[4]|callback_check_champs', 
    array(
        'required' => 'Mail non renseigné',
        'check_champs' => 'Le {field} est déjà pris'
    ));

    $this->form_validation->set_rules(
        'rgpd',
        'RGPD',
        'required',
        array('required' => 'Veuillez accepter les conditions RGPD')
    );

    $this->form_validation->set_rules(
        'mdp_signup',
        'Mot de passe',
        'required|min_length[4]',
        array('required' => 'Mot de Passe non renseigné', 'min_length' => 'Le Mot de passe doit faire au moins 4 caractères')
    );
    $this->form_validation->set_rules(
        'mdp_v',
        'validation du Mot de passe',
        'required|matches[mdp_signup]',
        array('required' => 'Validation de Mot de Passe non renseigné', 'matches' => 'Les Mot de Passe doivent être identiques')
    );
    //Fin Règles
    if ($this->form_validation->run() == FALSE) {
        $this->index();
    } else {
        if ($_POST["mdp_signup"] == $_POST["mdp_v"]) {
            if ($this->usersManager->cb_users($_POST["pseudo_signup"], md5($_POST["mdp_signup"])) == 1) {
                $data['info_signup'] = 'deja_compte';
                $this->layout->set_titre("LukyssBook");
                $this->layout->view('login', $data, "defaultLogin");
            } else {
                $this->usersManager->add_user($_POST["pseudo_signup"], $_POST["nom"], $_POST["prenom"], $_POST["mail"], $_POST["adresse"], $_POST["cp"], $_POST["ville"], $_POST["mdp_signup"]);
                // $this->layout->set_titre("LukyssBook");
                // $this->layout->view('login', array(), "defaultLogin");
            }
        } else {
            $data['info_signup'] = 'error';
            $this->layout->set_titre("LukyssBook");
            $this->layout->view('login', $data, "defaultLogin");
        }
    }
}
    public function mur($id_profil=''){
        //a faire
        is_connected();
        if ($id_profil != $this->session->userdata("usr_id")){
            echo 'Accès interdit';
            header("Location: ". site_url("User/mur/".$this->session->userdata("usr_id"))."");
            exit();
        }
        
        //savoir si je suis admin
        $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        //savoir si c'est mon profil
        $data["isMyProfil"] = is_it_my_profil($this->session->userdata("usr_id"), $id_profil);

        $data["usr_id"] = $this->session->userdata("usr_id");

        //recupérer les posts précédents dans l'ordre décroissant limité a dix? dix dans un premier temps
        $data["post_list"] = $this->Post->get_posts_for_mur($this->session->userdata("usr_id"), is_admin($this->session->userdata("usr_id")));

        // echo $this->db->last_query();

        $this->layout->set_titre("Mur de ".$this->session->userdata("usr_pseudo"));
        $this->layout->view('mur', $data, "default");
    }
    public function deconnexion()
    {
        $this->session->sess_destroy();
        redirect('User/');
        exit();
    }
  
    // public function info()
    // {
    //     is_connected();
    //     $this->load->view('info');
    // }
    public function reset_mdp()
    {
        session_destroy();
        if (isset($_POST["mail"]) && !empty($_POST["mail"])) {
            $temp = genererChaineAleatoire();
            $this->usersManager->set_temp_mdp($_POST["mail"], $temp);
            //loader la librairy "email" pour faire des operations
            $this->load->library('email');
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.laposte.net',
                'smtp_port' => 465,
                'smtp_user' => 'lukyssbook-contact@laposte.net',
                'smtp_pass' => 'lukyssBOOK20232709!',
                'smtp_crypto' => 'ssl',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => '\r\n',
            );
            $this->email->initialize($config);
            $this->email->from('lukyssbook-contact@laposte.net');
            $this->email->to($_POST["mail"]);

            $this->email->subject('Récupération de mdp');
            $this->email->message('Voici votre lien de récupération de mdp <a target="_blank" href="http://localhost/ProjetX/User/set_new_mdp/' . $temp . '">Lien =)</a> .');

            $this->email->send();
            // $this->email->print_debugger();
        } else $this->load->view('recup_mdp');
    }
    public function profil($id_profil){
        if(!empty($id_profil)){
            is_connected();

            //récupérer les donnée de l'utilisateur 
            $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $id_profil));

            if (empty($data["profil"])) {
                echo "Oups vous n'êtes pas censé être ici";
                header("Refresh: 3; url=". site_url("User/mur/".$this->session->userdata("usr_id"))."");
                exit();
            }

            //récupérer les paramètres pour ce profil
            //a faire

            //récupérer les derniers amis pour la section amis
            $data["friendList"] = $this->ajouterManager->liste_amis($id_profil, "ajouter_state_date desc", 9);

            //Récupérer le nombre de follower du profil
            $data["nbFollowers"] = $this->suivreManager->_count("usr_id_1", $id_profil);

            //Récupérer le nombre d'amis du profil
            $data["nbFriends"] = $this->ajouterManager->count_nb_friends($id_profil);
            
            //recupérer les posts précédents dans l'ordre décroissant limité a dix? dix dans un premier temps
            $data["post_list"] = $this->Post->get_100_last_posts($id_profil);

            //savoir si je suis admin
            $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

            //savoir si c'est mon profil
            $data["isMyProfil"] = is_it_my_profil($this->session->userdata("usr_id"), $id_profil);

            //savoir si c'est mon ami
            $data["isMyFriend"] = is_it_my_friend($this->session->userdata("usr_id"), $id_profil);

            //savoir si j'ai envoyé une requete d'ami
            $data["isFriendRequestPending"] = is_friend_request_pending($this->session->userdata("usr_id"), $id_profil);

            //savoir si je follow ce compte
            $data["doIFollowHim"] = do_i_follow_him($this->session->userdata("usr_id"), $id_profil);

            $data["usr_id"] = $this->session->userdata("usr_id");

            //récupérer toutes les données à propos pour ce profil
            $data["apropos"] = $this->aproposManager->_get("*", array("usr_id" => $id_profil));

            //Compter si une bio existe deja
            $data["count_bio"] = $this->aproposManager->_count(array("usr_id" => $id_profil, "apropos_type" => "bio"));

            //Compter si une relation existe deja
            $data["count_relation"] = $this->aproposManager->_count(array("usr_id" => $id_profil, "apropos_type" => "relation"));
           
            $this->layout->set_titre("Profil de ".$data["profil"]["usr_pseudo"]);
            $this->layout->view('profil', $data, "default");
        } 
        else {
            $this->session->sess_destroy();
            redirect("User/");
        }
    }

    public function editer_profil($id_profil){
        is_connected();

        $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $id_profil));

        if (empty($data["profil"]) || $this->session->userdata('usr_id') != $id_profil) {
            echo "Oups vous n'êtes pas censé être ici";
            header("Refresh: 3; url=". site_url("User/mur/".$this->session->userdata("usr_id"))."");
            exit();
        }

        $data["usr_id"] = $this->session->userdata("usr_id");
        
        $this->load->library('form_validation');
        //Form Rules
        $this->form_validation->set_rules('usr_pseudo', 'Pseudo', 'required|min_length[4]', 
        array(
            'required' => 'Pseudo non renseigné',
            'check_champs' => 'Le {field} est déjà pris'
        ));
        $this->form_validation->set_rules('usr_mail', 'Mail', 'required|min_length[4]', 
        array(
            'required' => 'Mail non renseigné',
            'check_champs' => 'Le {field} est déjà pris'
        ));
    
        //Fin Règles
        if ($this->form_validation->run() == FALSE) {
            $this->layout->set_titre("Editer profil de ".$data["profil"]["usr_pseudo"]);
            $this->layout->view('page_profil_edit', $data, "default");
        } else {
            //Si il y a deja un utilisateur avec ce pseudo et mail soit c'est nous soit c'est pas nous et on dit deja compte
            if ($this->usersManager->_count("usr_pseudo", $_POST["usr_pseudo"]) == 1 || $this->usersManager->_count("usr_mail", $_POST["usr_mail"]) == 1) {
                //C'est pas nous
                if (($this->usersManager->_count("usr_pseudo", $_POST["usr_pseudo"]) == 1 && $_POST["usr_pseudo"] != $this->session->userdata('usr_pseudo')) || ($this->usersManager->_count("usr_mail", $_POST["usr_mail"]) == 1 && $_POST["usr_mail"] != $this->session->userdata('usr_mail'))) {
                    $data['info_edit'] = 'deja_compte';
                    $this->layout->set_titre("Editer profil de ".$data["profil"]["usr_pseudo"]);
                    $this->layout->view('page_profil_edit', $data, "default");
                } 
                //C'est nous
                else {
                    $this->usersManager->_update(array('usr_id' => $this->session->userdata('usr_id')), array('usr_pseudo' => $_POST['usr_pseudo'], 'usr_nom' => $_POST['usr_nom'], 'usr_prenom' => $_POST['usr_prenom'], 'usr_cp' => $_POST['usr_cp'], 'usr_adresse' => $_POST['usr_adresse'], 'usr_ville' => $_POST['usr_ville'], 'usr_mail' => $_POST['usr_mail'], 'usr_tel' => $_POST['usr_tel']));
                    echo 'Modifications prises en compte, vous allez être redirigé vers la page de connexion.';
                    header('Refresh: 5; URL="/ProjetX/User/deconnexion"');
                    exit();
                }
            } else {
                $this->usersManager->_update(array('usr_id' => $this->session->userdata('usr_id')), array('usr_pseudo' => $_POST['usr_pseudo'], 'usr_nom' => $_POST['usr_nom'], 'usr_prenom' => $_POST['usr_prenom'], 'usr_cp' => $_POST['usr_cp'], 'usr_adresse' => $_POST['usr_adresse'], 'usr_ville' => $_POST['usr_ville'], 'usr_mail' => $_POST['usr_mail'], 'usr_tel' => $_POST['usr_tel']));
                echo 'Modifications prises en compte, vous allez être redirigé vers la page de connexion.';
                header('Refresh: 5; URL="/ProjetX/User/deconnexion"');
                exit();
            }
        }
    }

    public function amis($id_profil){
        is_connected();

        //récupérer les donnée de l'utilisateur 
        $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $id_profil));

        //sécurité        
        if (empty($data["profil"])) {
            echo "Oups vous n'êtes pas censé être ici";
            header("Refresh: 3; url=". site_url("User/mur/".$this->session->userdata("usr_id"))."");
            exit();
        }

        //savoir si je suis admin
        $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        $data["usr_id"] = $this->session->userdata("usr_id");


        //récupérer la liste d'amis de cette personne 
        $data["listeAmis"] = $this->ajouterManager->liste_amis($id_profil);

        $this->layout->set_titre("Amis de ".$data["profil"]["usr_pseudo"]);
        $this->layout->view('page_amis', $data, "default");
    }

    
    public function a_propos($id_profil){
        is_connected();
    
        //récupérer les donnée de l'utilisateur 
        $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $id_profil));

          //sécurité        
          if (empty($data["profil"])) {
            echo "Oups vous n'êtes pas censé être ici";
            header("Refresh: 3; url=". site_url("User/mur/".$this->session->userdata("usr_id"))."");
            exit();
        }

        //récupérer toutes les données à propos pour ce profil
        $data["apropos"] = $this->aproposManager->_get("*", array("usr_id" => $id_profil));

        //Compter si une bio existe deja
        $data["count_bio"] = $this->aproposManager->_count(array("usr_id" => $id_profil, "apropos_type" => "bio"));

        //Compter si une relation existe deja
        $data["count_relation"] = $this->aproposManager->_count(array("usr_id" => $id_profil, "apropos_type" => "relation"));

        $data["usr_id"] = $this->session->userdata("usr_id");

        $this->layout->set_titre("A Propos de ".$data["profil"]["usr_pseudo"]);
        $this->layout->view('page_apropos', $data, "default");
    }

    
    public function photos($id_profil){
        is_connected();

        $data["usr_id"] = $this->session->userdata("usr_id");
        
        //récupérer les donnée de l'utilisateur 
        $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $id_profil));

          //sécurité        
          if (empty($data["profil"])) {
            echo "Oups vous n'êtes pas censé être ici";
            header("Refresh: 3; url=". site_url("User/mur/".$this->session->userdata("usr_id"))."");
            exit();
        }

        $this->layout->set_titre("Photos de ".$data["profil"]["usr_pseudo"]);
        $this->layout->view('page_photos', $data, "default");
    }


    public function search_friend($order_by = "usr_id", $sens = "asc", $search = '')
	{
        // $page = 1, $ordre = 'id', $sens = 'desc', $search =''
        is_connected();

   
        if (!empty($this->input->post('search')) and $search == '') {
            $search = $this->input->post('search');
        }
        else if ($search != '') $search = $search;
        else $search = '';

        $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $this->session->userdata("usr_id")));

        $data["allPossibleFriends"] = $this->ajouterManager->get_all_possible_friend($this->session->userdata("usr_id"), $order_by, $sens, $search);

        // var_dump($this->db->last_query());

        //quel ordre?
        $data["order_by"] = $order_by;
        
        //Quel sens?
        $data["sens"] = $sens;

        //Search ?
        $data["search"] = $search;

        $data["usr_id"] = $this->session->userdata("usr_id");

        
        $this->layout->set_titre("Trouvez des amis, ".$data["profil"]["usr_pseudo"]);
        $this->layout->view('page_chercher_amis', $data, "default");
		// $NombreItemsParPage = 50;
		
		// $page = intval($page);
		// if($page < 1){
		// 	$page = 1;
		// }
	

		// $premierItem = ($page - 1) * $NombreItemsParPage;  // moins un car les requetes sql commences à 0 et non à 1

		// // On récupère les derniers items
		// $data['items'] = $this->membresManager->lister_membres($NombreItemsParPage, $premierItem, $ordre, $sens, $search);

		// /*------------------------------ Fonction suivant ------------------------------*/
		// $data['nombreItems'] = $this->membresManager->nombre_items($search);

		// // Pour obtenir le nombre exact de page, on divise par le nombre d'item par page
		// $nbPage = $data['nombreItems'] / $NombreItemsParPage;

		// $data['pagePrecedente'] = $page - 1;
		// $data['pageSuivante'] = $page + 1;
		// $data['page'] = $page;
		// $data['NombreItemsParPage'] = $NombreItemsParPage;
		// $data['controller'] = $this->controller;
		// $data['ordre'] = $ordre;
		// $data['sens'] = $sens;
		// $data['search'] = $search;
		
		
	}
    public function messenger($id_profil){
        is_connected();

        //récupérer les donnée de l'utilisateur 
        $data["profil"] = $this->usersManager->_get_row("*", array("usr_id" => $id_profil));

          //sécurité        
          if (empty($data["profil"]) || $this->session->userdata('usr_id') != $id_profil) {
            echo "Oups vous n'êtes pas censé être ici";
            header("Refresh: 3; url=". site_url("User/mur/".$this->session->userdata("usr_id"))."");
            exit();
        }

        //savoir si je suis admin
        $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        $data["usr_id"] = $this->session->userdata("usr_id");
       
        $this->layout->set_titre("Messenger");
        $this->layout->view('page_messenger', $data, "default");
    }

    public function get_contact(){
        is_connected();

        // Appelle le modèle pour récupérer les commentaires
        $data['contacts'] = $this->usersManager->get_contacts($this->session->userdata("usr_id"));

        //savoir si je suis admin
        $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        $data["usr_id"] = $this->session->userdata("usr_id");

        // $data["start_from"] = $start_from;

        $contact_div = $this->load->view('_contact_div', $data, true);

        // Renvoie la vue comme réponse HTML
        echo $contact_div;
    }


    // public function upload_profil($id_profil){
    //     include('/var/www/html/ProjetX/codeIgniter3/assets/fileuploader/src/php/class.fileuploader.php');

    //     // initialize the FileUploader
    //     $FileUploader = new FileUploader('files', array(
            
                
    //             'extensions' => ['jpg', 'png', 'jpeg'],
    //             'uploadDir' => '/var/www/html/ProjetX/codeIgniter3/assets/uploads/',
        
            
    //     ));

    //     // call to upload the files
    //     $upload = $FileUploader->upload();

    //     if($upload['isSuccess']) {
    //         // get the uploaded files
    //         $files = $upload['files'];
    //         echo 'succes';
    //         var_dump($files);
    //     } else {
    //         // get the warnings
    //         $warnings = $upload['warnings'];
    //         echo 'erreur';
    //         var_dump($warnings);
    //     }
    //     redirect('user/profil/'. $this->session->userdata("usr_id"));
    // }


    public function set_new_mdp($x = '')
    {
        if (!empty($x)) {

            if (!empty($_POST["mdp1"]) && !empty($_POST["mdp2"])) {

                if ($_POST["mdp1"] == $_POST["mdp2"]) {

                    $this->usersManager->set_new_mdp($_POST["mdp1"], $x);
                } 
                else $this->load->view('set_new_mdp/' . $x);
            } 
            else $this->load->view('set_new_mdp');
        } 
        else $this->load->view('recup_mdp');
    }
    //Fonction du Form Validation 
    public function check_champs($str){
        if ($this->usersManager->cb_users_unique_champ($str) > 0) return FALSE;
        else return TRUE;
    }
}
