<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commenter extends CI_Controller
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
        $this->load->model("commenter_model", "Commenter");
        $this->load->model("commenter_commentaire_model", "CommenterCommentaire");
        $this->load->model("Commentaire_model", "Commentaire");
        $this->load->model("parametres_model", "parametresManager");
        $this->load->model("evenement_Post_model", "EventPostManager");
        $this->load->model("evenement_commentaire_model", "EventCommentManager");
        $this->load->library("layout");
        $this->load->helper(array('form', 'url'));
        is_connected();
    }
    public function index(){


        // Récupérer param_default_commentaire_visibility depuis la table Parametres
        $query = $this->db->get_where("Parametres", array('usr_id' => $this->session->userdata("usr_id")));
        $parametres_row = $query->row();
        $commentaire_visibility = $parametres_row->param_default_commentaire_visibility;

        //Deux cas Le commentaire est une réponse à un Post ou une reponse à un Commentaire
        //Récupérer les post communs

        $commentaire_contenu = $this->input->post("commentaire");
        $post_id = $this->input->post("id_post");
        $user_id = $this->input->post("userId");
        $where_to_redirect = $this->input->post("where_to_redirect");
        $type = $this->input->post("type");
        !empty($this->input->post("commentaire_id")) ? $commentaire_id = $this->input->post("commentaire_id") : $commentaire_id = null;

         //inserer le commentaire en Commentaire
         $this->Commentaire->_insert(array("commentaire_contenu" => $commentaire_contenu, "commentaire_date" => date("Y-m-d H:i:s"), "commentaire_visibility" => $commentaire_visibility, "post_id" => $post_id));

         //*****************************************************************************Actions Communes


         //Récupérer l'id du commentaire qu'on vient d'insérer
         $lastIdArray = $this->Commentaire->get_id_post($commentaire_contenu, $post_id);
         $lastId = 0;
         foreach ($lastIdArray as $key) {
             $lastId = $key->commentaire_id;
         }

         //Remplir la table commenter avec les deux valeurs
         $this->Commenter->_insert(array("usr_id" => $this->session->userdata("usr_id"), "commentaire_id" => $lastId));

         //inserer l'envenement dans evenement_Post parce que c'est bien un evenement lié au post
         $this->EventPostManager->_insert(array("evenement_p_type" => "commentaire", "evenement_p_date" => date("Y-m-d H:i:s"), "usr_id" => $this->session->userdata("usr_id"), "post_id" => $post_id));


        //*********************************************************************Action Supplémentaire pour les réponses 

        if ($commentaire_id != null) { // on a ici une reponse à un commentaire
            
            //inserer l'envenement dans evenement_commentaire parce que c'est bien un evenement lié au commentaire
            $this->EventCommentManager->_insert(array("evenement_c_type" => "commentaire_response", "evenement_c_date" => date("Y-m-d H:i:s"), "usr_id" => $this->session->userdata("usr_id"), "commentaire_id" => $commentaire_id));

            //Insérer dans commenter_commentaire
            $this->CommenterCommentaire->_insert(array("commentaire_id" => $commentaire_id, "commentaire_id_response" => $lastId));
        }
        
       

             
    }
    public function edit(){
     
        $commentaire_id = $this->input->post("commentaire_id");
        $commentaire_contenu = $this->input->post("commentaire_contenu");
        $this->Commentaire->_update(array("commentaire_id" => $commentaire_id), array("commentaire_contenu" => $commentaire_contenu));

    }
    public function like(){

        $commentaire_id = $this->input->post("commentaire_id");
        $this->EventCommentManager->_insert(array("evenement_c_type" => "like", "evenement_c_date" => date("Y-m-d H:i:s"), "usr_id" => $this->session->userdata("usr_id"), "commentaire_id" => $commentaire_id));

    }

    public function unlike(){
        
        $commentaire_id = $this->input->post("commentaire_id");
        //supprimer le like
        $this->EventCommentManager->_delete(array("evenement_c_type" => "like", "usr_id" => $this->session->userdata("usr_id"), "commentaire_id" => $commentaire_id));

    }

    public function get_comments(){

        $post_id = $this->input->post('post_id'); 
        $start_from = $this->input->post('start_from');
        $nb_comment = $this->input->post('nb_comment');

        // Appelle le modèle pour récupérer les commentaires
        $data['comments'] = $this->Commentaire->get_commentaires($start_from, $post_id);

        //récupérer le nombre de commentaire du post
        $data["nb_comment"] = $nb_comment;

        //savoir si je suis admin
        $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        $data["usr_id"] = $this->session->userdata("usr_id");

        $data["start_from"] = $start_from;

        $commentaire_div = $this->load->view('_commentaire_div', $data, true);

        // Renvoie la vue comme réponse HTML
        echo $commentaire_div;
    }

    public function get_responses(){

        $post_id = $this->input->post('post_id'); 
        $commentaire_id = $this->input->post('commentaire_id'); 
        $start_from_response = $this->input->post('start_from_response');
        $nb_comment = $this->input->post('nb_comment');
        $nb_comment_response = $this->input->post('nb_comment_response');

        // Appelle le modèle pour récupérer les commentaires
        $data['comments'] = $this->Commentaire->get_responses($start_from_response, $post_id, $commentaire_id);

        //récupérer le nombre de commentaire du post
        $data["nb_comment"] = $nb_comment;

        //récupérer le nombre de reponses du commentaire
        $data["nb_comment_response"] = $nb_comment_response;

        //savoir si je suis admin
        $data["amIAdmin"] = is_admin($this->session->userdata("usr_id"));

        $data["usr_id"] = $this->session->userdata("usr_id");

        $data["start_from_response"] = $start_from_response;

        $commentaire_response_div = $this->load->view('_commentaire_response_div', $data, true);

        // Renvoie la vue comme réponse HTML
        echo $commentaire_response_div;
    }

    public function remove_comment(){
            
        $commentaire_id = $this->input->post("commentaire_id");
        //supprimer le commentaire
        $this->Commentaire->_update(array("commentaire_id" => $commentaire_id), array("commentaire_contenu" => "contenu supprimé", "commentaire_visibility" => 4));

        $this->EventCommentManager->_insert( array("evenement_c_type" => "delete", "commentaire_id" => $commentaire_id, "evenement_c_date" => date("Y-m-d H:i:s"), "usr_id" => $this->session->userdata("usr_id") ));

        echo "success";

    }
}
