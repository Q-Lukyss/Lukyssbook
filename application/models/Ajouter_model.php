<?php
class Ajouter_model extends MY_Model
{
    protected $table = 'Ajouter';

    function count_is_friend($id_1, $id_2){
        // Construire la requête
        $this->db->select('COUNT(*) as count');
        $this->db->from($this->table);
        $this->db->where('(( usr_id = '.$id_1.' and usr_id_1 = '.$id_2.' ) OR ( usr_id = '.$id_2.' and usr_id_1 = '.$id_1.' )) AND ajouter_state = 1');

        // Exécuter la requête
        $query = $this->db->get();

        // Récupérer le résultat
        $result = $query->row();

        // Le résultat est maintenant disponible dans $result->count
        return $result->count;
    }
    function count_is_friend_request_pending($id_1, $id_2){
        // Construire la requête
        $this->db->select('COUNT(*) as count');
        $this->db->from($this->table);
        $this->db->where(' usr_id = '.$id_1.' and usr_id_1 = '.$id_2.' AND ajouter_state = 0');

        // Exécuter la requête
        $query = $this->db->get();

        // Récupérer le résultat
        $result = $query->row();

        // Le résultat est maintenant disponible dans $result->count
        return $result->count;
    }
    function count_nb_friends($id){
               // Construire la requête
               $this->db->select('COUNT(*) as count');
               $this->db->from($this->table);
               $this->db->where('(( usr_id = '.$id.' ) OR ( usr_id_1 = '.$id.' )) AND ajouter_state = 1');
       
               // Exécuter la requête
               $query = $this->db->get();
       
               // Récupérer le résultat
               $result = $query->row();
       
               // Le résultat est maintenant disponible dans $result->count
               return $result->count;
    }
    
    function liste_amis($id_profil, $order_by = null, $limit = null) {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('Ajouter a');
        $this->db->join('Utilisateurs u', '(a.usr_id = u.usr_id OR a.usr_id_1 = u.usr_id)', 'inner');
        $this->db->where("(a.usr_id = $id_profil OR a.usr_id_1 = $id_profil)");
        $this->db->where('a.ajouter_state', 1);
        $this->db->where("u.usr_id <> $id_profil"); // Exclure l'utilisateur lui-même
    
        if ($order_by !== null) {
            $this->db->order_by($order_by);
        }
    
        if ($limit !== null) {
            $this->db->limit($limit);
        }
        
        $query = $this->db->get();
        $result = $query->result();
    
        return $result;
    }

    function get_all_possible_friend($user_id, $order_by, $sens, $search) {
        $this->db->select('U.usr_id, U.usr_pseudo');
    
        $this->db->select("CASE
            WHEN P.param_nom_visibility = 3 THEN U.usr_nom
            WHEN P.param_nom_visibility = 1 THEN ''
            WHEN P.param_nom_visibility = 2 AND (
                EXISTS (
                    SELECT 1
                    FROM Ajouter
                    WHERE (usr_id = $user_id AND ajouter_state = 1)
                          OR (usr_id_1 = $user_id AND ajouter_state = 1)
                )
            ) THEN U.usr_nom
            ELSE ''
        END AS usr_nom", FALSE);
    
        $this->db->select("CASE
            WHEN P.param_prenom_visibility = 3 THEN U.usr_prenom
            WHEN P.param_prenom_visibility = 1 THEN ''
            WHEN P.param_prenom_visibility = 2 AND (
                EXISTS (
                    SELECT 1
                    FROM Ajouter
                    WHERE (usr_id = $user_id AND ajouter_state = 1)
                          OR (usr_id_1 = $user_id AND ajouter_state = 1)
                )
            ) THEN U.usr_prenom
            ELSE ''
        END AS usr_prenom", FALSE);
    
        $this->db->select("CASE
            WHEN P.param_ville_visibility = 3 THEN U.usr_ville
            WHEN P.param_ville_visibility = 1 THEN ''
            WHEN P.param_ville_visibility = 2 AND (
                EXISTS (
                    SELECT 1
                    FROM Ajouter
                    WHERE (usr_id = $user_id AND ajouter_state = 1)
                          OR (usr_id_1 = $user_id AND ajouter_state = 1)
                )
            ) THEN U.usr_ville
            ELSE ''
        END AS usr_ville", FALSE);
    
        $this->db->select('U.usr_image_profil');
        $this->db->from('Utilisateurs U');
        $this->db->join('Parametres P', 'U.usr_id = P.usr_id', 'LEFT');
        $this->db->where('U.usr_id !=', $user_id);
    
        $mots = explode('-', $search);
    
        foreach ($mots as $mot) {
            $this->db->group_start();
            $this->db->or_like('U.usr_nom', $mot);
            $this->db->or_like('U.usr_prenom', $mot);
            $this->db->or_like('U.usr_pseudo', $mot);
            $this->db->or_like('U.usr_ville', $mot);
            $this->db->group_end();
        }
    
        if ($order_by && $sens) {
            $this->db->order_by($order_by, $sens);
        }
    
        $this->db->limit(200);
    
        $query = $this->db->get();
        return $query->result();
    }
}