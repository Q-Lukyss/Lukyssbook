<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajouter extends CI_Controller
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
        $this->load->model("ajouter_model", "ajouterManager");

        
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
    }
 
    public function send_request($id_demandeur, $id_destinataire, $redirect){
        //vérifier que le destinataire n'a pas deja fait une demande 
        $count = $this->ajouterManager->count_is_friend_request_pending($id_destinataire, $id_demandeur);
        
        if($count > 0){
            //si le destinataire et le demandeur on met à jour la plus ancienne, on les ajoute mutuellement avec un ajouter_state de 1;
            $this->ajouterManager->_update(array('usr_id' => $id_destinataire, 'usr_id_1' => $id_demandeur), array('ajouter_state' => 1, 'ajouter_state_date' => date('Y-m-d H:i:s'))); 
        }

        //sinon demande d'ami normale
        else $this->ajouterManager->_insert(array('usr_id' => $id_demandeur, 'usr_id_1' => $id_destinataire, 'ajouter_date' => date('Y-m-d'), 'ajouter_state' => 0));

        // On envoie une notification au destinataire

        // On redirige
        $redirect = str_replace("zwxy", '/', $redirect);
        $redirect = str_replace("http://127.0.0.1/ProjetX", '', $redirect);


        redirect($redirect, 'location');
       
    }
    public function create_friendship($id_destinataire){
        $this->ajouterManager->_update(array('usr_id_1' => $id_destinataire), array('ajouter_state' => 1, 'ajouter_state_date' => date('Y-m-d H:i:s'))); 
    }
    public function break_friendship($id_breaker, $id_other, $redirect){
        $this->ajouterManager->_delete("(usr_id = ".$id_breaker." and usr_id_1 = ".$id_other.") or (usr_id = ".$id_other." and usr_id_1 = ".$id_breaker.")");

         // On redirige
         $redirect = str_replace("zwxy", '/', $redirect);
         $redirect = str_replace("http://127.0.0.1/ProjetX", '', $redirect);
 
 
         redirect($redirect, 'location');
    
    }
    
}

