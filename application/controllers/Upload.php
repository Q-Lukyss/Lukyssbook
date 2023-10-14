<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('Utilisateurs_model', 'user');
        }

        public function index()
        {
            
            $data['error'] = ' '; // Les données à passer à la vue
            $upload_form = $this->load->view('upload_form', $data, true); // Le troisième argument "true" renvoie la vue sous forme de chaîne

            // Renvoie la vue comme réponse HTML
            echo $upload_form;
        }

        public function do_upload($id_usr)
        {

            $upload_path = FCPATH . 'assets/uploads/' . $id_usr;

            // Vérifier si le répertoire d'upload existe, sinon le créer
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true); // Créer le répertoire récursivement
            }

            $config['upload_path']          = $upload_path;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('upload_form', $error);
            }
            else
            {
                 // Récupérer les informations sur le fichier téléchargé
                $upload_data = $this->upload->data();
                
                // Récupérer le nom du fichier téléchargé
                $new_img_profil = strval($this->session->userdata('usr_id').'/'.$upload_data['file_name']);

                // Insérer le nom du fichier en base de données
                $this->user->_update(array('usr_id' => $this->session->userdata('usr_id')), array('usr_image_profil' => $new_img_profil));

                // changer l'image de profil en session
                $this->session->set_userdata('usr_image_profil', $new_img_profil);

                // Charger la vue de succès avec les données
                $data = array('upload_data' => $upload_data);
                echo "changement d'image de profil pris en compte";
                header("Location: ". site_url("User/editer_profil/".$this->session->userdata("usr_id"))."");
                exit();
            }
        }
}
?>