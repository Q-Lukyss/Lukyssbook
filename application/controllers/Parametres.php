<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parametres extends CI_Controller
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
        $this->load->model("parametres_model", "parametresManager");
        $this->load->model("commenter_model", "Commenter");
        $this->load->model("Commentaire_model", "Commentaire");
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
        is_connected();
    }
  
    public function index($usr_id){
        $data["parametres"] = $this->parametresManager->_get_row("*", array("usr_id" => $usr_id));

        $data["usr_id"] = $this->session->userdata("usr_id");

        $this->layout->set_titre("Paramètres de ".$this->session->userdata("usr_pseudo"));
        $this->layout->view('parametres', $data, "default");
    }
    public function update_select(){
        $selectValue = $this->input->post('value');
        $databaseColonne = $this->input->post('column');
        $usr_id = $this->input->post('usr_id');

        
        $this->parametresManager->_update(array("usr_id" => $usr_id), array($databaseColonne => $selectValue));


        // Répondez à la requête Ajax
        echo 'Mise à jour réussie';
    
    }
   
}
