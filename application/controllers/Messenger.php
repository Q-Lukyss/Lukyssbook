<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Messenger extends CI_Controller
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
        
        is_connected();
        $this->load->model("Message_model", "messageManager");
        $this->load->model("Participer_conversation_model", "pcManager");
        $this->load->model("Conversation_model", "conversationManager");

        
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
    }
    public function index(){

    }
    public function get_all_conversations(){
        //Récupérer les inputs de l'AJAX
        $usr_id = $this->input->post('usr_id');

        //Récuperer toutes les conversations pour lesquelles notre gars participe et pc_actif = 1 (là ou il est actif)
        //Si la conversation n'as pas de nom on mets le nom du ou des autres participants
        //On récupère le dernier message de la conversation avec is_my_msg = 1 si $usr_id est l'auteur et is_read si il est lu par usr_id, 
        //si c'est son message balek sinon on regade via les dates    

        $data['conversations'] = $this->conversationManager->get_all_conversations($this->session->userdata('usr_id'));

        $data["usr_id"] = $this->session->userdata("usr_id");

        // // $data["start_from"] = $start_from;

        $messenger_conversation_list = $this->load->view('_messenger_conversation_list', $data, true);

        // Renvoie la vue comme réponse HTML
        echo $messenger_conversation_list;

       
    }
    public function get_messages(){
        //Depuis messenger
        if (!empty($this->input->post('conversation_id'))) {
            $conversation_id = $this->input->post('conversation_id');

            $data['messages'] = $this->conversationManager->get_messages($conversation_id);

            $data["usr_id"] = $this->session->userdata("usr_id");

            //l'utilisateur récupère les msg on met a jour derniere visite dans participer_conversation
            $this->pcManager->_update(array('usr_id' => $this->session->userdata("usr_id"), 'conversation_id' => $conversation_id), array('pc_date_derniere_visite' => date('Y-m-d H:i:s')));

            $messenger_conversation_messages = $this->load->view('_messenger_conversation_messages', $data, true);

            // Renvoie la vue comme réponse HTML
            echo $messenger_conversation_messages;
        }
        //Depuis contacts
        else{
            $auteur_id = $this->session->userdata("usr_id");
            $destinataire_id = $this->input->post('destinataire_id');

            //Regarder si une conversation existe 
            $conversation_id = $this->pcManager->does_conversation_exist($auteur_id, $destinataire_id);

            //Si elle existe on recupère les messages de cette dernière
            if ($conversation_id > 0) {
                $data['messages'] = $this->conversationManager->get_messages($conversation_id);

                $data["usr_id"] = $this->session->userdata("usr_id");

                //l'utilisateur récupère les msg on met a jour derniere visite dans participer_conversation
                $this->pcManager->_update(array('usr_id' => $this->session->userdata("usr_id"), 'conversation_id' => $conversation_id), array('pc_date_derniere_visite' => date('Y-m-d H:i:s')));

    
                $messenger_conversation_messages = $this->load->view('_messenger_conversation_messages', $data, true);

                // Renvoie la vue comme réponse HTML
                echo $messenger_conversation_messages;
            }
            //Sinon on retourne 'Aucun Message'
            else{
                echo '<p class="no_msg">Aucun Message</p>';
            }
        }
    
    }
    public function send_message(){
        //Récupérer les inputs de l'AJAX
        $auteur = $this->input->post('usr_id_envoyeur');
        $destinataire = $this->input->post('usr_id_destinataire');
        $message = $this->input->post('message_contenu');
        if (!empty($this->input->post('conversation_id'))) {
            $conversation_id = $this->input->post('conversation_id');
            
            //On envoie directement le message dans la bonne conversation
            $this->messageManager->_insert(array('message_contenu' => $message, 'message_date_emission' => date('Y-m-d H:i:s'), 'conversation_id' => $conversation_id, 'usr_id' => $auteur));
            $this->pcManager->_update(array('usr_id' => $auteur, 'conversation_id' => $conversation_id), array('pc_date_derniere_visite' => date('Y-m-d H:i:s')));
    
        }
        else{
             //Regarder si une conversation existe 
            $conversation_id = $this->pcManager->does_conversation_exist($auteur, $destinataire);

            //Si elle existe on envoie le message dans cette conversation
            if ($conversation_id > 0) {
                $this->messageManager->_insert(array('message_contenu' => $message, 'message_date_emission' => date('Y-m-d H:i:s'), 'conversation_id' => $conversation_id, 'usr_id' => $auteur));
                $this->pcManager->_update(array('usr_id' => $auteur, 'conversation_id' => $conversation_id), array('pc_date_derniere_visite' => date('Y-m-d H:i:s')));
        
            }
            //Sinon on la créer et on envoie le message dans cette conversation
            else{
                $this->conversationManager->_insert(array('conversation_name' => "", 'conversation_date_creation' => date("Y-m-d H:i:s")));
                //récuperer l'id qu'on vient d'insérer
                $conversation_id = $this->db->insert_id();
                $this->pcManager->_insert(array('usr_id' => $auteur, 'conversation_id' => $conversation_id, 'pc_date_derniere_visite' => date("Y-m-d H:i:s"), 'pc_actif' => 1));
                $this->pcManager->_insert(array('usr_id' => $destinataire, 'conversation_id' => $conversation_id, 'pc_date_derniere_visite' => "", 'pc_actif' => 1));
                $this->messageManager->_insert(array('message_contenu' => $message, 'message_date_emission' => date('Y-m-d H:i:s'), 'conversation_id' => $conversation_id, 'usr_id' => $auteur));
            }
        }

        // Chargez la vue des messages avec les nouveaux messages
        $data['messages'] = $this->conversationManager->get_messages($conversation_id);

        $data["usr_id"] = $this->session->userdata("usr_id");

        $messenger_conversation_messages = $this->load->view('_messenger_conversation_messages', $data, true);
    
        // Renvoyez la vue comme réponse HTML
        echo $messenger_conversation_messages;
    }
    public function get_unread_msg(){
        $nb = $this->conversationManager->get_unread_msg($this->session->userdata('usr_id'));

        echo ($nb->nb_msg_nu_lus);


    }
}