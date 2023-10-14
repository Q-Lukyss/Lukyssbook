<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apropos extends CI_Controller
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
        $this->load->model("apropos_model","aproposManager");
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
    }
  
    public function add($type_info){

        //switch pour envoyer les bons trucs selon les cas en bdd
        switch ($type_info) {
            case 'bio':
            case 'libre':
                $data_to_insert = json_encode([$type_info => $_POST[$type_info]]);
                $this->aproposManager->_insert(array("apropos_contenu" => $data_to_insert, "apropos_type" => $type_info, "usr_id" => $this->session->userdata("usr_id")));
                break;
                
            case 'relation':
                $data_to_insert = json_encode([$type_info => $_POST[$type_info]]);
                $this->aproposManager->_insert(array("apropos_contenu" => $data_to_insert, "apropos_type" => $type_info, "usr_id" => $this->session->userdata("usr_id")));
                break;
            
            case 'habitation':
                $data_to_insert = json_encode(["date_debut" => $_POST["depuis"], "date_fin" => $_POST["jusque"], "habitation" => $_POST["ville"]]);
                $this->aproposManager->_insert(array("apropos_contenu" => $data_to_insert, "apropos_type" => $type_info, "usr_id" => $this->session->userdata("usr_id")));
                break;
        
            case 'etude':
                $data_to_insert = json_encode(["date_debut" => $_POST["depuis"], "date_fin" => $_POST["jusque"], "intitule" => $_POST["intitule"], "ville" => $_POST["ville"], "etablissement" => $_POST["etablissement"]]);
                $this->aproposManager->_insert(array("apropos_contenu" => $data_to_insert, "apropos_type" => $type_info, "usr_id" => $this->session->userdata("usr_id")));
                break;
    
            case 'travail':
                $data_to_insert = json_encode(["date_debut" => $_POST["depuis"], "date_fin" => $_POST["jusque"], "intitule" => $_POST["intitule"], "ville" => $_POST["ville"], "etablissement" => $_POST["entreprise"]]);
                $this->aproposManager->_insert(array("apropos_contenu" => $data_to_insert, "apropos_type" => $type_info, "usr_id" => $this->session->userdata("usr_id")));
                break;

            default:
                # code...
                break;
        }
        
    header('Location: ' .site_url("User/a_propos/". $this->session->userdata("usr_id")));
    exit;
    }
    
    public function remove($apropos_id){

    }

   
}
