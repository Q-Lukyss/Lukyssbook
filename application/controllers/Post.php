<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
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
        $this->load->library('user_agent');

        $this->load->model("utilisateurs_model", "usersManager");
        $this->load->model("post_model", "Post");
        $this->load->model("evenement_Post_model", "EventPostManager");
        $this->load->model("parametres_model", "parametresManager");
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
    }
    public function remove($x, $redirect){
        $id = $x;

        // Supprimer le Post
        $this->Post->_update(array("post_id" => $id), array("post_contenu" => "contenu supprimé", "post_visibility" => 4));

        $this->EventPostManager->_insert( array("evenement_p_type" => "delete", "post_id" => $id, "evenement_p_date" => date("Y-m-d H:i:s"), "usr_id" => $this->session->userdata("usr_id") ));


        $redirect = str_replace("zwxy", '/', $redirect);
        $redirect = str_replace("http://127.0.0.1/ProjetX", '', $redirect);


        redirect($redirect, 'location');
    }
    public function index($where_to_redirect){
        // echo "En Construction";
        $this->Post->publier($where_to_redirect, $_POST["contenu"], $this->session->userdata("usr_id"));
    }
    public function edit(){
        $where_to_redirect = $this->input->post("where_to_redirect");
        $baseUrl = "http://127.0.0.1/ProjetX/";

        $where_to_redirect = str_replace($baseUrl, '', $where_to_redirect);

        //faire un update dans la bdd
        $this->Post->_edit($_POST["id_post"], $_POST["contenu"]);

        redirect($where_to_redirect);
    }
    public function like($post_id){
        is_connected();

        $this->EventPostManager->_insert(array("evenement_p_type" => "like", "evenement_p_date" => date("Y-m-d H:i:s"), "usr_id" => $this->session->userdata("usr_id"), "post_id" => $post_id));

    }

    public function unlike($post_id){
        is_connected();
        
        //supprimer le like
        $this->EventPostManager->_delete(array("evenement_p_type" => "like", "usr_id" => $this->session->userdata("usr_id"), "post_id" => $post_id));

    }
}
