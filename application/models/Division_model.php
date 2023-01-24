<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Division_model extends CI_Model
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
		$this->db->from('division');
		$this->db->order_by('id_division', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('division');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id_division)
	{
		$this->db->select('*');
		$this->db->from('division');
		// where
		$this->db->where('id_division', $id_division);
		$this->db->order_by('id_division', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('division', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id_division', $data['id_division']);
		$this->db->update('division', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_division', $data['id_division']);
		$this->db->delete('division', $data);
	}
}

/* End of file division_model.php */
/* Location: ./application/models/division_model.php */
