<?php
class Conversation_model extends MY_Model
{
    protected $table = 'Conversation';

    public function get_all_conversations($usr_id) {
        $this->db->select('pc.conversation_id, COALESCE(NULLIF(c.conversation_name, ""), GROUP_CONCAT(DISTINCT u.usr_pseudo)) AS conversation_name, m_last.message_id AS last_message_id, m_last.usr_id AS last_message_auteur, COALESCE(NULLIF(c.conversation_image_conversation, ""), u.usr_image_profil) AS conversation_image, m_last.message_contenu AS last_message_contenu, m_last.message_date_emission AS last_message_date_emission, pc_last.pc_date_derniere_visite AS last_visit_date');
    
        $this->db->distinct();
        $this->db->from('participer_conversation pc2');
        $this->db->join('Utilisateurs u', 'pc2.usr_id = u.usr_id AND u.usr_id <> ' . $this->db->escape($usr_id));
        $this->db->join(
            "(SELECT DISTINCT pc.conversation_id FROM participer_conversation pc WHERE pc.usr_id = $usr_id AND pc.pc_actif = 1) pc",
            'pc.conversation_id = pc2.conversation_id'
        );
        $this->db->join('Conversation c', 'pc.conversation_id = c.conversation_id', 'left');
        $this->db->join(
            '(SELECT m1.conversation_id, m1.message_id, m1.usr_id, m1.message_contenu, m1.message_date_emission FROM Message m1 WHERE (m1.conversation_id, m1.message_date_emission) IN (SELECT m2.conversation_id, MAX(m2.message_date_emission) FROM Message m2 GROUP BY m2.conversation_id)) m_last',
            'c.conversation_id = m_last.conversation_id',
            'left'
        );
        $this->db->join('participer_conversation pc_last', 'pc.conversation_id = pc_last.conversation_id AND pc_last.usr_id = ' . $this->db->escape($usr_id), 'left');
        $this->db->join(
            "(SELECT pc3.conversation_id, MAX(u2.usr_image_profil) AS usr_image_profil FROM participer_conversation pc3 JOIN Utilisateurs u2 ON pc3.usr_id = u2.usr_id WHERE pc3.pc_actif = 1 AND pc3.usr_id <> $usr_id GROUP BY pc3.conversation_id) u_img",
            'pc.conversation_id = u_img.conversation_id',
            'left'
        );
    
        $this->db->group_by('pc.conversation_id, m_last.message_id, m_last.message_contenu, m_last.message_date_emission, pc_last.pc_date_derniere_visite, conversation_image');
        $this->db->order_by('m_last.message_date_emission', "desc");

        $query = $this->db->get();
        return $query->result(); 
    }
    
    public function get_messages($conversation_id){
        $this->db->select('m.*, u.usr_pseudo, u.usr_image_profil');
        $this->db->from('Conversation c');
        $this->db->join('Message m', 'c.conversation_id = m.conversation_id');
        $this->db->join('Utilisateurs u', 'm.usr_id = u.usr_id');
        $this->db->where('c.conversation_id', $conversation_id);
        $this->db->order_by('m.message_date_emission', 'asc');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    public function get_unread_msg($usr_id){
        $this->db->select('COUNT(*) as nb_msg_nu_lus');
        $this->db->from('Message m');
        $this->db->join('(SELECT c.conversation_id FROM Conversation c INNER JOIN participer_conversation pc ON c.conversation_id = pc.conversation_id WHERE pc.usr_id = '.$usr_id.') AS relevant_conversations', 'm.conversation_id = relevant_conversations.conversation_id');
        $this->db->join('participer_conversation pc', 'relevant_conversations.conversation_id = pc.conversation_id');
        $this->db->join('Utilisateurs u', 'pc.usr_id = u.usr_id');
        $this->db->where('u.usr_id', $usr_id);
        $this->db->where('m.message_date_emission > pc.pc_date_derniere_visite');
        
        // Exécution de la requête
        $query = $this->db->get();
        
        // Récupération du résultat
        $result = $query->row();
        return $result;
    }

    
}