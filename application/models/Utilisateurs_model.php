<?php
class Utilisateurs_model extends MY_Model
{
    protected $table = 'Utilisateurs';

    public function cb_users($pseudo, $mdp)
    {

       $query = $this->db->where('(usr_pseudo = "'.$pseudo.'" OR usr_mail = "'.$pseudo.'")')
        ->where('usr_mdp', $mdp)
        ->from($this->table)
        ->count_all_results();

    return $query;
    }
    public function cb_users_unique_champ($champ)
    {
        $query = $this->db->where('(usr_pseudo = "' . $champ . '" OR usr_mail = "' . $champ . '")', null, false)
            ->from($this->table)
            ->count_all_results();
    
        return $query;
    }
    public function get_user($pseudo, $mdp)
    {

        $query =  $this->db->select("*")
            ->where('usr_pseudo', $pseudo)
            ->or_where('usr_mail', $pseudo)
            ->where('usr_mdp', $mdp)
            ->from($this->table)
            ->get()
            ->row();

        return $query;
    }
    public function add_user($pseudo, $nom, $prenom, $mail, $adresse, $cp, $ville, $mdp)
    {
        $data = array(
            'usr_pseudo' => $pseudo,
            'usr_nom' => $nom,
            'usr_prenom' => $prenom,
            'usr_mdp' => md5($mdp),
            'usr_mail' => $mail,
            'usr_adresse' => $adresse,
            'usr_cp' => $cp,
            'usr_ville' => $ville,
            'usr_date_creation' => date("Y-m-d"),
            'usr_rang' => 5,
            'usr_image_profil' => "default.jpeg",
            'usr_image_border' => "default_border.webp"
        );
    
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0) {
            // User insertion successful, now add data to "Parametres" table
            $query = $this->db->get_where($this->table, array('usr_pseudo' => $pseudo, 'usr_mail' => $mail));
            $row = $query->row();
            if ($row) {
                $id = $row->usr_id;

                $parametres_data = array(
                    'param_default_post_visibility' => 3,
                    'param_default_info_visibility' => 3,
                    'param_default_amis_visibility' => 3,
                    'param_default_photo_visibility' => 3,
                    'param_default_commentaire_visibility' => 3,
                    'param_default_theme' => 'default',
                    'param_nom_visibility' => 3,
                    'param_prenom_visibility' => 3,
                    'param_ville_visibility' => 3,
                    'usr_id' => $id,
                );
                $this->db->insert('Parametres', $parametres_data);

                if ($this->db->affected_rows() > 0) {
                    echo "Inscription effectuée avec succès ! <br />Vous allez être redirigé et vous pourrez vous connecter.";
                    header("Refresh: 1; url=" . site_url("User/"));
                    exit;
                } else {
                    echo "Erreur lors de l'insertion des données dans la table parametres.";
                    header("Refresh: 1; url=" . site_url("User/signup"));
                    exit;
                }
            } else {
                echo "Erreur lors de la récupération de l'identifiant utilisateur.";
                header("Refresh: 1; url=" . site_url("User/signup"));
                exit;
            }
        } else {
            echo "Erreur lors de l'insertion des données.";
            header("Refresh: 1; url=" . site_url("User/signup"));
            exit;
        }
    }



    public function set_temp_mdp($mail, $chaine)
    {

        $this->db->set('usr_recup_mdp', $chaine);
        $this->db->where('usr_mail', $mail);
        $this->db->update($this->table);

        if ($this->db->affected_rows() > 0) {
            header('Refresh: 1, url="/ProjetX/User/"');
            echo "Demande prise en compte";
            // redirect("User/", 2);
        } else {
            header('Refresh: 1, url="/ProjetX/User/"');
            echo "Une erreur s'est produite";
        }
    }
    public function set_new_mdp($mdp, $temp)
    {

        $this->db->set('usr_mdp', md5($mdp));
        $this->db->where('usr_recup_mdp', $temp);
        $this->db->update($this->table);

        if ($this->db->affected_rows() > 0) {
            header('Refresh: 1, url="/ProjetX/User/"');
            echo "Changement de mot de passe effectué";
            // redirect("User/", 2);
        } else {
            header('Refresh: 1, url="/ProjetX/User/"');
            echo "Une Erreur s'est produite";
        }
    }

    // a faire plus tard
    public function chercher_amis ($nombreDeMembresParPage,  $premierMembreAafficher = 0, $order_by = 'id', $sens = 'desc', $search='')
	{
	
		$mots = explode('-', $search); //On sépare l'expression en mots clés
		$this->db->select('m.*, COUNT(dl.id) as count_dossiers')
			->from($this->table . ' m')
			->join('relation_locataire_dossier rld', 'm.id = rld.id_membre', 'left')
			->join('dossier_locatif dl', 'dl.id = rld.id_dossier_locatif', 'left')
			->group_by('m.id')
			->order_by($order_by, $sens)
			->limit($nombreDeMembresParPage, $premierMembreAafficher);
	
		foreach ($mots as $mot) {
			$this->db->or_like('nom', $mot);
			$this->db->or_like('prenom', $mot);
			$this->db->or_like('c_postal', $mot);
			$this->db->or_like('ville', $mot);
			$this->db->or_like('email', $mot);
			$this->db->or_like('adresse', $mot);
			$this->db->or_like('"count_dossiers"', $mot);

		}
	
		$query = $this->db->get();
		return $query->result_array();
	}


    public function get_contacts($usr_id){
        
        $sql = "SELECT DISTINCT
        contacts.usr_id,
        contacts.usr_pseudo,
        contacts.usr_image_profil
            FROM (
                SELECT Suivre.usr_id AS usr_id, Utilisateurs.usr_pseudo, Utilisateurs.usr_image_profil
                FROM Suivre
                JOIN Utilisateurs ON Suivre.usr_id_1 = Utilisateurs.usr_id
                WHERE Suivre.usr_id = $usr_id

                UNION

                SELECT Ajouter.usr_id_1 AS usr_id, Utilisateurs.usr_pseudo, Utilisateurs.usr_image_profil
                FROM Ajouter
                JOIN Utilisateurs ON Ajouter.usr_id_1 = Utilisateurs.usr_id
                WHERE Ajouter.usr_id = $usr_id AND Ajouter.ajouter_state = 0

                UNION

                SELECT Ajouter.usr_id_1 AS usr_id, Utilisateurs.usr_pseudo, Utilisateurs.usr_image_profil
                FROM Ajouter
                JOIN Utilisateurs ON Ajouter.usr_id_1 = Utilisateurs.usr_id
                WHERE Ajouter.usr_id = $usr_id AND Ajouter.ajouter_state = 1
                
                UNION
                
                SELECT Ajouter.usr_id AS usr_id, Utilisateurs.usr_pseudo, Utilisateurs.usr_image_profil
                FROM Ajouter
                JOIN Utilisateurs ON Ajouter.usr_id = Utilisateurs.usr_id
                WHERE Ajouter.usr_id_1 = $usr_id AND Ajouter.ajouter_state = 1

                UNION

                SELECT pc.usr_id, u.usr_pseudo, u.usr_image_profil
                FROM Message m
                INNER JOIN participer_conversation pc ON m.conversation_id = pc.conversation_id
                INNER JOIN Utilisateurs u ON pc.usr_id = u.usr_id
                WHERE m.usr_id = $usr_id
                
                
            ) AS contacts
            WHERE contacts.usr_id != $usr_id;";

        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }
}
