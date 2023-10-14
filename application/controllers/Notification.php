<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
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
        
        $this->load->model("Notifications_model", "notificationsManager");

        
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
    }
    public function index(){

    }
    public function get_notification(){
        // is_connected();

        // // Appelle le modèle pour récupérer les commentaires
        // $data['notification'] = $this->;

        // //savoir si je suis admin
        // $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        // $data["usr_id"] = $this->session->userdata("usr_id");

        // // $data["start_from"] = $start_from;

        // $notification_div = $this->load->view('_notification_div', $data, true);

        // // Renvoie la vue comme réponse HTML
        // echo $notification_div;
    }
}