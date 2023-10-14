<?php
class Suivre_model extends MY_Model
{
    protected $table = 'Suivre';

    function is_following($follower, $followed){
        // Construire la requête
        $this->db->select('COUNT(*) as count');
        $this->db->from($this->table);
        $this->db->where('usr_id = '.$follower.' and usr_id_1 = '.$followed.' AND suivre_date != ""');

        // Exécuter la requête
        $query = $this->db->get();

        // Récupérer le résultat
        $result = $query->row();

        // Le résultat est maintenant disponible dans $result->count
        return $result->count;
    }

}