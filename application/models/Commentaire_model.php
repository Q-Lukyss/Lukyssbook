<?php
class Commentaire_model extends MY_Model
{
    protected $table = 'Commentaire';

    public function _commenter($usr_id, $contenu, $post_id){
        $data = array(
            'commentaire_contenu' => $contenu,
            'commentaire_date' => date("Y-m-d H:i:s"),
            'post_id' => $post_id
        );
        $this->db->insert($this->table, $data);
    }
    public function get_id_post($contenu, $post_id){
        $query = $this->db->select("commentaire_id")
        ->where("post_id", $post_id)
        ->where("commentaire_contenu", $contenu)
        ->from($this->table)
        ->limit(1)
        ->order_by("commentaire_id", "desc")
        ->get()
        ->result();

        return $query;
    }
    public function get_commentaires($start_from, $post_id) {
        // $this->db->select('c1.*, c2.usr_id, u.*');
        // $this->db->select('COALESCE(el.nb_like, 0) AS nb_like');
        // $this->db->select('COALESCE(ec.nb_commentaire, 0) AS nb_commentaire');
        // $this->db->select('CASE WHEN c2.usr_id = ' . $this->session->userdata("usr_id") . ' THEN TRUE ELSE FALSE END AS is_it_my_commentaire', FALSE);
        // $this->db->select('CASE WHEN EXISTS (
        //     SELECT 1
        //     FROM Evenement_commentaire elc
        //     WHERE elc.commentaire_id = c1.commentaire_id
        //       AND elc.evenement_c_type = "like"
        //       AND elc.usr_id = ' . $this->session->userdata("usr_id") . '
        // ) THEN TRUE ELSE FALSE END AS did_i_like_this_commentaire');
        
        // $this->db->from('Commentaire c1');
        // $this->db->join('commenter c2', 'c1.commentaire_id = c2.commentaire_id', 'inner');
        // $this->db->join('Utilisateurs u', 'c2.usr_id = u.usr_id', 'inner');
        // $this->db->join(
        //     '(SELECT commentaire_id, COUNT(*) AS nb_like FROM Evenement_commentaire WHERE evenement_c_type = "like" GROUP BY commentaire_id) el',
        //     'c1.commentaire_id = el.commentaire_id',
        //     'left'
        // );
        // $this->db->join(
        //     '(SELECT commentaire_id, COUNT(*) AS nb_commentaire FROM Evenement_commentaire WHERE evenement_c_type = "commentaire" GROUP BY commentaire_id) ec',
        //     'c1.commentaire_id = ec.commentaire_id',
        //     'left'
        // );
        
        // $this->db->where('c1.post_id', $post_id);
        // $this->db->where('c1.commentaire_visibility <', 4);
        // $this->db->limit(10, $start_from);
        
        // $query = $this->db->get();
        // $result = $query->result();
        
        // return $result;

        
            // $this->db->select('c1.*, c2.usr_id, u.*');
            // $this->db->select('COALESCE(el.nb_like, 0) AS nb_like');
            // $this->db->select('COALESCE(ec.nb_commentaire, 0) AS nb_commentaire');
            // $this->db->select('CASE WHEN c2.usr_id = ' . $this->session->userdata("usr_id") . ' THEN TRUE ELSE FALSE END AS is_it_my_commentaire', FALSE);
            // $this->db->select('CASE WHEN EXISTS (
            //     SELECT 1
            //     FROM Evenement_commentaire elc
            //     WHERE elc.commentaire_id = c1.commentaire_id
            //       AND elc.evenement_c_type = "like"
            //       AND elc.usr_id = ' . $this->session->userdata("usr_id") . '
            // ) THEN TRUE ELSE FALSE END AS did_i_like_this_commentaire');
            
            // $this->db->from('Commentaire c1');
            // $this->db->join('commenter c2', 'c1.commentaire_id = c2.commentaire_id', 'inner');
            // $this->db->join('Utilisateurs u', 'c2.usr_id = u.usr_id', 'inner');
            // $this->db->join(
            //     '(SELECT commentaire_id, COUNT(*) AS nb_like FROM Evenement_commentaire WHERE evenement_c_type = "like" GROUP BY commentaire_id) el',
            //     'c1.commentaire_id = el.commentaire_id',
            //     'left'
            // );
            
            // // Nouvelle jointure pour compter les commentaires
            // $this->db->join(
            //     '(SELECT commentaire_id, COUNT(*) AS nb_commentaire FROM commenter_commentaire GROUP BY commentaire_id) ec',
            //     'c1.commentaire_id = ec.commentaire_id',
            //     'left'
            // );
            
            // $this->db->where('c1.post_id', $post_id);
            // $this->db->where('c1.commentaire_visibility <', 4);
            // $this->db->limit(10, $start_from);
            
            // $query = $this->db->get();
            // $result = $query->result();
            
            // return $result;

            $this->db->select('c1.*, c2.usr_id, u.*');
        $this->db->select('COALESCE(el.nb_like, 0) AS nb_like');
        $this->db->select('COALESCE(ec.nb_commentaire, 0) AS nb_commentaire');
        $this->db->select('CASE WHEN c2.usr_id = ' . $this->session->userdata("usr_id") . ' THEN TRUE ELSE FALSE END AS is_it_my_commentaire', FALSE);
        $this->db->select('CASE WHEN EXISTS (
            SELECT 1
            FROM Evenement_commentaire elc
            WHERE elc.commentaire_id = c1.commentaire_id
            AND elc.evenement_c_type = "like"
            AND elc.usr_id = ' . $this->session->userdata("usr_id") . '
        ) THEN TRUE ELSE FALSE END AS did_i_like_this_commentaire');

        $this->db->from('Commentaire c1');
        $this->db->join('commenter c2', 'c1.commentaire_id = c2.commentaire_id', 'inner');
        $this->db->join('Utilisateurs u', 'c2.usr_id = u.usr_id', 'inner');
        $this->db->join(
            '(SELECT commentaire_id, COUNT(*) AS nb_like FROM Evenement_commentaire WHERE evenement_c_type = "like" GROUP BY commentaire_id) el',
            'c1.commentaire_id = el.commentaire_id',
            'left'
        );

        // Nouvelle jointure pour compter les commentaires
        $this->db->join(
            '(SELECT commentaire_id, COUNT(*) AS nb_commentaire FROM commenter_commentaire GROUP BY commentaire_id) ec',
            'c1.commentaire_id = ec.commentaire_id',
            'left'
        );

        $this->db->where('c1.post_id', $post_id);
        $this->db->where('c1.commentaire_visibility <', 4);

        // Ajoute la condition NOT EXISTS pour exclure les commentaires avec commentaire_id égal à commentaire_id_response
        $this->db->where('NOT EXISTS (
            SELECT 1
            FROM commenter_commentaire cc
            WHERE cc.commentaire_id_response = c1.commentaire_id
        )', NULL, FALSE);

        $this->db->limit(10, $start_from);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
        
    }

    public function get_responses($start_from_response, $post_id, $commentaire_id){
        
        $this->db->select('c1.*, c2.usr_id, u.*');
        $this->db->select('COALESCE(el.nb_like, 0) AS nb_like');
        $this->db->select('COALESCE(ec.nb_commentaire, 0) AS nb_commentaire');
        $this->db->select('CASE WHEN c2.usr_id = ' . $this->session->userdata("usr_id") . ' THEN TRUE ELSE FALSE END AS is_it_my_commentaire', FALSE);
        $this->db->select('CASE WHEN EXISTS (
            SELECT 1
            FROM Evenement_commentaire elc
            WHERE elc.commentaire_id = c1.commentaire_id
            AND elc.evenement_c_type = "like"
            AND elc.usr_id = ' . $this->session->userdata("usr_id") . '
        ) THEN TRUE ELSE FALSE END AS did_i_like_this_commentaire');
        
        $this->db->from('Commentaire c1');
        $this->db->join('commenter_commentaire cc', 'c1.commentaire_id = cc.commentaire_id_response', 'inner');
        $this->db->join('commenter c2', 'c1.commentaire_id = c2.commentaire_id', 'inner');
        $this->db->join('Utilisateurs u', 'c2.usr_id = u.usr_id', 'inner');
        $this->db->join('(SELECT commentaire_id, COUNT(*) AS nb_like FROM Evenement_commentaire WHERE evenement_c_type = "like" GROUP BY commentaire_id) el', 'c1.commentaire_id = el.commentaire_id', 'left');
        $this->db->join('(SELECT commentaire_id, COUNT(*) AS nb_commentaire FROM commenter_commentaire GROUP BY commentaire_id) ec', 'c1.commentaire_id = ec.commentaire_id', 'left');

        $this->db->where('c1.post_id', $post_id);
        $this->db->where('c1.commentaire_visibility <', 4);
        $this->db->where('cc.commentaire_id', $commentaire_id); // Condition pour récupérer les commentaires réponses au commentaire donné

        $this->db->limit(10, $start_from_response);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }
}