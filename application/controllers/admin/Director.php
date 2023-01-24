<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Director extends CI_Controller
{

	// Load model
	public function __construct()
	{
		parent::__construct();
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		$this->simple_login->check_login($pengalihan);
		$this->load->model('director_model');
	}

	// Halaman utama
	public function index()
	{
		// Ambil data director
		$director 	= $this->director_model->listing();
		$total 	= $this->director_model->total();

		$data = array(
			'title'		=> 'Director (' . $total->total . ' data)',
			'director'	=> $director,
			'isi'		=> 'admin/director/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah
	public function tambah()
	{
		// Validasi
		$validasi = $this->form_validation;

		$validasi->set_rules(
			'nama_director',
			'Nama director',
			'required|is_unique[director.nama_director]',
			array(
				'required'		=> '%s harus diisi',
				'is_unique'		=> '%s sudah ada. Buat nama baru'
			)
		);

		$validasi->set_rules(
			'kode_director',
			'Kode director',
			'required|is_unique[director.kode_director]',
			array(
				'required'		=> '%s harus diisi',
				'is_unique'		=> '%s sudah ada. Buat kode baru'
			)
		);

		if ($validasi->run() === FALSE) {
			// End validasi

			$data = array(
				'title'		=> 'Tambah director Baru',
				'isi'		=> 'admin/director/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk ke database
		} else {
			$inp = $this->input;

			$data = array(
				'id_user'		=> 1,
				'kode_director'		=> $inp->post('kode_director'),
				'nama_director'		=> $inp->post('nama_director'),
				'status_director'	=> $inp->post('status_director'),
				'keterangan'	=> $inp->post('keterangan'),
				'wilayah'		=> $inp->post('wilayah'),
				'tanggal_post'	=> date('Y-m-d H:i:s')
			);
			$this->director_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambahkan');
			redirect(base_url('admin/director'), 'refresh');
		}
		// End masuk database
	}

	// Edit
	public function edit($id_director)
	{
		// Ambil data director yg akan diedit
		$director = $this->director_model->detail($id_director);

		// Validasi
		$validasi = $this->form_validation;

		$validasi->set_rules(
			'nama_director',
			'Nama director',
			'required',
			array('required'		=> '%s harus diisi')
		);

		$validasi->set_rules(
			'kode_director',
			'Kode director',
			'required',
			array('required'		=> '%s harus diisi')
		);

		if ($validasi->run() === FALSE) {
			// End validasi

			$data = array(
				'title'		=> 'Edit director: ' . $director->nama_director,
				'director'		=> $director,
				'isi'		=> 'admin/director/edit'
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk ke database
		} else {
			$inp = $this->input;

			$data = array(
				'id_director'		=> $id_director,
				'id_user'		=> 1,
				'kode_director'		=> $inp->post('kode_director'),
				'nama_director'		=> $inp->post('nama_director'),
				'status_director'	=> $inp->post('status_director'),
				'keterangan'	=> $inp->post('keterangan'),
				'wilayah'		=> $inp->post('wilayah'),
			);
			$this->director_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/director'), 'refresh');
		}
		// End masuk database
	}

	// Proses
	public function proses()
	{
		$id_directornya	= $this->input->post('id_director');
		$pengalihan = $this->input->post('pengalihan');

		// Check id_director kosong atau tidak
		if ($id_directornya == "") {
			$this->session->set_flashdata('warning', 'Anda belum memilih data');
			redirect($pengalihan, 'refresh');
		}

		// Proses hapus jika klik tombol "hapus", jika ga ada yg kosong
		if (isset($_POST['hapus'])) {
			// Proses hapus diloop
			for ($i = 0; $i < sizeof($id_directornya); $i++) {
				$id_director = $id_directornya[$i];
				$data = array('id_director'		=> $id_director);
				$this->director_model->delete($data);
			}
			// End proses hapus
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect($pengalihan, 'refresh');
		} elseif (isset($_POST['aktifkan'])) {
			// Proses aktifkan diloop
			for ($i = 0; $i < sizeof($id_directornya); $i++) {
				$id_director = $id_directornya[$i];
				$data = array(
					'id_director'		=> $id_director,
					'status_director'	=> 'Aktif'
				);
				$this->director_model->edit($data);
			}
			// End proses aktifkan
			$this->session->set_flashdata('sukses', 'Data telah diaktifkan');
			redirect($pengalihan, 'refresh');
		} elseif (isset($_POST['non_aktifkan'])) {
			// Proses non aktifkan diloop
			for ($i = 0; $i < sizeof($id_directornya); $i++) {
				$id_director = $id_directornya[$i];
				$data = array(
					'id_director'		=> $id_director,
					'status_director'	=> 'Non Aktif'
				);
				$this->director_model->edit($data);
			}
			// End proses non aktifkan
			$this->session->set_flashdata('sukses', 'Data telah di non aktifkan');
			redirect($pengalihan, 'refresh');
		}
	}

	// Delete
	public function delete($id_director)
	{
		$data = array('id_director'		=> $id_director);
		$this->director_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/director'), 'refresh');
	}
}

/* End of file director.php */
/* Location: ./application/controllers/admin/director.php */
