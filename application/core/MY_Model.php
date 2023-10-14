<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	/**
	 *	Ins�re une nouvelle ligne dans la base de donn�es.
	 */
	public function _insert($options_echappees = array(), $options_non_echappees = array())
	{
		//	V�rification des donn�es � ins�rer
		if(empty($options_echappees) AND empty($options_non_echappees))
		{
			return false;
		}
		
		return (bool) $this->db->set($options_echappees)
					->set($options_non_echappees, null, false)
					->insert($this->table);
	}

	/**
	 *	R�cup�re des donn�es dans la base de donn�es.
	 */
	public function _get($select = '*', $where = array())
	{
		return $this->db->select($select)
						->from($this->table)
						->where($where)
						->get()
						->result_array();  // Version tableau
	}
	
	public function _get_row($select = '*',$where = array(), $valeur = null) // Si $champ est un array, la variable $valeur sera ignor�e par la m�thode where()
	{
		return $this->db->select($select)
						->from($this->table)
						->where($where, $valeur)
						->get()
						->row_array();  // Version tableau
	}
	
	/**
	 *	Modifie une ou plusieurs lignes dans la base de donn�es.
	 */
	public function _update($where, $options_echappees = array(), $options_non_echappees = array())
	{		
		//	V�rification des donn�es � mettre � jour
		if(empty($options_echappees) AND empty($options_non_echappees))
		{
			return false;
		}
		
		//	Raccourci dans le cas o� on s�lectionne l'id
		if(is_integer($where))
		{
			$where = array('id' => $where);
		}

		return (bool) $this->db->set($options_echappees)
								->set($options_non_echappees, null, false)
								->where($where)
								->update($this->table);

	}
	
	/**
	 *	Supprime une ou plusieurs lignes de la base de donn�es.
	 */
	public function _delete($where)
	{
		if(is_integer($where))
		{
			$where = array('id' => $where);
		}
		
		return (bool) $this->db->where($where)
								->delete($this->table);
	}

	/**
	 *	Retourne le nombre de r�sultats.
	 */
	public function _count($champ = array(), $valeur = null) // Si $champ est un array, la variable $valeur sera ignor�e par la m�thode where()
	{
		return (int) $this->db->where($champ, $valeur)
								->from($this->table)
								->count_all_results();
	}

	/**
	 *	Retourne le dernier id 
	 */
	public function _get_last_id()
	{
		$r= $this->db->select('id')
						->from($this->table)
						->order_by('id', 'desc')
						->limit(1,0)
						->get()
						->row_array();
		return $r['id'];
	}
}

/* End of file MY_Model.php */