<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Director_model extends CI_Model
{

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('director');
		$this->db->order_by('id_director', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('director');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_director)
	{
		$this->db->select('*');
		$this->db->from('director');
		// where
		$this->db->where('id_director', $id_director);
		$this->db->order_by('id_director', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('director', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_director', $data['id_director']);
		$this->db->update('director', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_director', $data['id_director']);
		$this->db->delete('director', $data);
	}
}

/* End of file director_model.php */
/* Location: ./application/models/director_model.php */
