<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organisasi extends CI_Controller
{

	// Database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('bagian_model');
	}

	// Main page Organisasi
	public function index()
	{
		$site 			= $this->konfigurasi_model->listing();
		$bagian 	= $this->bagian_model->listing_array();

		$data = array(
			'title'		=> 'Organisasi ' . $site->namaweb . ' | ' . $site->tagline,
			'deskripsi'	=> 'Organisasi ' . $site->namaweb . ' | ' . $site->tagline . ' ' . $site->tentang,
			'keywords'	=> 'Organisasi ' . $site->namaweb . ' | ' . $site->tagline . ' ' . $site->keywords,
			'site'		=> $site,
			'isi'		=> 'home/organisasi',
			'bagian'	=> $bagian
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
}

/* End of file Contact.php */
/* Location: ./application/controllers/Organisasi.php */
