<?php
class Post_model extends MY_Model
{
    protected $table = 'Post';

    // public function publier($post_contenu, $usr_id){
    //     $data = array(
    //         'post_contenu' => $post_contenu,
    //         'post_date' => date("Y-m-d H:i:s"),
    //         'usr_id' => $usr_id,
    //     );
    //     $this->db->insert($this->table, $data);
    //     if ($this->db->affected_rows() > 0) {
    //         echo "Publication enregistrée !";
    //         redirect("User/mur/".$usr_id, 2);
    //     } else {
    //         echo "Erreur lors de la publication.";
    //         redirect("User/signup", 2);
    //     }
    // }
        public function publier($where_to_redirect, $post_contenu, $usr_id){
        if ($where_to_redirect == "mur") $where_to_redirect = "user/mur/";
        else if($where_to_redirect == "profil") $where_to_redirect = "user/profil/";
        
        // Récupérer param_default_post_visibility depuis la table Parametres
        $query = $this->db->get_where("Parametres", array('usr_id' => $usr_id));
        $parametres_row = $query->row();
        $post_visibility = $parametres_row->param_default_post_visibility;

        $data = array(
            'post_contenu' => $post_contenu,
            'post_date' => date("Y-m-d H:i:s"),
            'post_visibility' => $post_visibility, // Définir post_visibility avec la valeur récupérée
            'usr_id' => $usr_id,
        );
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            echo "Publication enregistrée !";
            redirect($where_to_redirect.$usr_id);
        } else {
            echo "Erreur lors de la publication.";
            redirect("User/signup", 2);
        }
    }
    
    public function get_100_last_posts($usr_id) {
        $this->db->select('p.*, u.*, 
            (SELECT COUNT(*) FROM Evenement_Post ep_like WHERE ep_like.post_id = p.post_id AND ep_like.evenement_p_type = "like") AS likes_count,
            (SELECT COUNT(*) FROM Commentaire c WHERE c.post_id = p.post_id and c.commentaire_visibility < 4) AS commentaires_count,
            (CASE WHEN EXISTS (SELECT 1 FROM Evenement_Post ep_check WHERE ep_check.post_id = p.post_id AND ep_check.evenement_p_type = "like" AND ep_check.usr_id = ' . $this->session->userdata("usr_id") . ') THEN 1 ELSE 0 END) AS did_i_like_this_post');
        $this->db->from('Post p');
        $this->db->join('Utilisateurs u', 'p.usr_id = u.usr_id', 'inner');
        $this->db->where('u.usr_id', $usr_id);
        $this->db->where('p.post_visibility <', 4);
        $this->db->order_by('p.post_id', 'desc');
        $this->db->limit(100);
    
        $query = $this->db->get();
    
        return $query->result();
    }
    public function get_posts_for_mur($usr_id, $id_admin) {

        if ($id_admin) {
            $this->db->select('p.*, u.*, IFNULL(likes_count, 0) AS likes_count, IFNULL(commentaires_count, 0) AS commentaires_count, IFNULL(did_i_like_this_post, 0) AS did_i_like_this_post');
            $this->db->from('Utilisateurs u');
            $this->db->join('Post p', 'u.usr_id = p.usr_id', 'inner');

            // Left Join for likes_count
            $this->db->join('(SELECT post_id, COUNT(*) AS likes_count FROM Evenement_Post WHERE evenement_p_type = "like" GROUP BY post_id) ep_like', 'p.post_id = ep_like.post_id', 'left');

            // Left Join for commentaires_count
            $this->db->join('(SELECT post_id, COUNT(*) AS commentaires_count FROM Commentaire WHERE commentaire_visibility < 4 GROUP BY post_id) c', 'p.post_id = c.post_id', 'left');

            // Left Join for did_i_like_this_post
            $this->db->join('(SELECT post_id, 1 AS did_i_like_this_post FROM Evenement_Post WHERE evenement_p_type = "like" AND usr_id = ' . $this->db->escape($this->session->userdata("usr_id")) . ') ep_check', 'p.post_id = ep_check.post_id', 'left');

            $this->db->where("(u.usr_id = $usr_id OR u.usr_id IN (SELECT usr_id_1 FROM Suivre WHERE Suivre.usr_id = $usr_id) OR u.usr_id IN (SELECT usr_id_1 FROM Ajouter WHERE (usr_id = $usr_id AND ajouter_state = 1)) OR u.usr_id IN (SELECT usr_id FROM Ajouter WHERE (usr_id_1 = $usr_id AND ajouter_state = 1)))");
            $this->db->where('p.post_visibility <', 4);
            $this->db->order_by('p.post_id', 'desc');
            $this->db->limit(100);

            $query = $this->db->get();

            return $query->result();
        }
        else {
            $this->db->select('p.*, u.*, IFNULL(likes_count, 0) AS likes_count, IFNULL(commentaires_count, 0) AS commentaires_count, IFNULL(did_i_like_this_post, 0) AS did_i_like_this_post');
            $this->db->from('Utilisateurs u');
            $this->db->join('Post p', 'u.usr_id = p.usr_id', 'inner');
        
            // Left Join for likes_count
            $this->db->join('(SELECT post_id, COUNT(*) AS likes_count FROM Evenement_Post WHERE evenement_p_type = "like" GROUP BY post_id) ep_like', 'p.post_id = ep_like.post_id', 'left');
        
            // Left Join for commentaires_count
            $this->db->join('(SELECT post_id, COUNT(*) AS commentaires_count FROM Commentaire WHERE commentaire_visibility < 4 GROUP BY post_id) c', 'p.post_id = c.post_id', 'left');
        
            // Left Join for did_i_like_this_post
            $this->db->join('(SELECT post_id, 1 AS did_i_like_this_post FROM Evenement_Post WHERE evenement_p_type = "like" AND usr_id = ' . $this->db->escape($this->session->userdata("usr_id")) . ') ep_check', 'p.post_id = ep_check.post_id', 'left');
        
            $this->db->where("(u.usr_id = $usr_id OR u.usr_id IN (SELECT usr_id_1 FROM Suivre WHERE Suivre.usr_id = $usr_id) OR u.usr_id IN (SELECT usr_id_1 FROM Ajouter WHERE (usr_id = $usr_id AND ajouter_state = 1)) OR u.usr_id IN (SELECT usr_id FROM Ajouter WHERE (usr_id_1 = $usr_id AND ajouter_state = 1)))");
            $this->db->where('(p.post_visibility = 3 OR (p.post_visibility = 2 AND (u.usr_id = ' . $this->db->escape($this->session->userdata("usr_id")) . ' OR ((u.usr_id IN (SELECT usr_id_1 FROM Ajouter WHERE (usr_id = ' . $this->db->escape($this->session->userdata("usr_id")) . ' AND usr_id_1 = p.usr_id AND ajouter_state = 1)) OR u.usr_id IN (SELECT usr_id FROM Ajouter WHERE (usr_id_1 = ' . $this->db->escape($this->session->userdata("usr_id")) . ' AND usr_id = p.usr_id AND ajouter_state = 1)))))) OR (p.post_visibility = 1 AND u.usr_id = ' . $this->db->escape($this->session->userdata("usr_id")) . '))');
            $this->db->order_by('p.post_id', 'desc');
            $this->db->limit(100);
        
            $query = $this->db->get();
        
            return $query->result();
        }
       
    }
    public function _edit($id, $post_contenu){
        $data = array(
            'post_contenu' => $post_contenu
        );

        $this->db->where('post_id', $id);
        $this->db->update($this->table, $data);

        if ($this->db->affected_rows() > 0) {
            echo "Publication mise à jour avec succès !";
        } else {
            echo "Erreur lors de la mise à jour.";
        }
    }

}
