<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Suivre extends CI_Controller
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
        $this->load->model("suivre_model", "suivreManager");

        
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
    }
 
    public function follow($id_follower, $id_followed, $redirect){
        $this->suivreManager->_insert(array('usr_id' => $id_follower, 'usr_id_1' => $id_followed, 'suivre_date' => date('Y-m-d')));

        $redirect = str_replace("zwxy", '/', $redirect);
        $redirect = str_replace("http://127.0.0.1/ProjetX", '', $redirect);


        redirect($redirect, 'location');
    }
    public function unfollow($id_follower, $id_followed, $redirect){
        $this->suivreManager->_delete(array('usr_id' => $id_follower, 'usr_id_1' => $id_followed));
        
        $redirect = str_replace("zwxy", '/', $redirect);
        $redirect = str_replace("http://127.0.0.1/ProjetX", '', $redirect);


        redirect($redirect, 'location');

        // redirect($redirect, 'location');
    }
    
}
