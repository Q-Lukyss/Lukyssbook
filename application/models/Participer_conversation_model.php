<?php
class Participer_conversation_model extends MY_Model
{
    protected $table = 'participer_conversation';

    public function does_conversation_exist($id_1, $id_2) {
        $this->db->select('participer_conversation.conversation_id'); 
        $this->db->from('participer_conversation');
        $this->db->join('participer_conversation pc2', 'participer_conversation.conversation_id = pc2.conversation_id');
        $this->db->where('participer_conversation.usr_id', $id_1);
        $this->db->where('pc2.usr_id', $id_2);
        $this->db->where('participer_conversation.pc_actif', 1);
        $this->db->where('pc2.pc_actif', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Si la requête a renvoyé des résultats, on retourne le conversation_id commun.
            return $query->row()->conversation_id;
        } else {
            // Si aucun résultat n'a été trouvé, on retourne 0.
            return 0;
        }
    }

}