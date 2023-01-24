<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Division extends CI_Controller
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
		$this->load->model('division_model');
	}

	// Halaman utama
	public function index()
	{
		// Ambil data division
		$division 	= $this->division_model->listing();
		$total 	= $this->division_model->total();

		$data = array(
			'title'		=> 'division (' . $total->total . ' data)',
			'division'	=> $division,
			'isi'		=> 'admin/division/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	// Tambah
	public function tambah()
	{
		// Validasi
		$validasi = $this->form_validation;

		$validasi->set_rules(
			'nama_division',
			'Nama division',
			'required|is_unique[division.nama_division]',
			array(
				'required'		=> '%s harus diisi',
				'is_unique'		=> '%s sudah ada. Buat nama baru'
			)
		);

		$validasi->set_rules(
			'kode_division',
			'Kode division',
			'required|is_unique[division.kode_division]',
			array(
				'required'		=> '%s harus diisi',
				'is_unique'		=> '%s sudah ada. Buat kode baru'
			)
		);

		if ($validasi->run() === FALSE) {
			// End validasi

			$data = array(
				'title'		=> 'Tambah division Baru',
				'isi'		=> 'admin/division/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk ke database
		} else {
			$inp = $this->input;

			$data = array(
				'id_user'		=> 1,
				'kode_division'		=> $inp->post('kode_division'),
				'nama_division'		=> $inp->post('nama_division'),
				'status_division'	=> $inp->post('status_division'),
				'keterangan'	=> $inp->post('keterangan'),
				'wilayah'		=> $inp->post('wilayah'),
				'tanggal_post'	=> date('Y-m-d H:i:s')
			);
			$this->division_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambahkan');
			redirect(base_url('admin/division'), 'refresh');
		}
		// End masuk database
	}

	// Edit
	public function edit($id_division)
	{
		// Ambil data division yg akan diedit
		$division = $this->division_model->detail($id_division);

		// Validasi
		$validasi = $this->form_validation;

		$validasi->set_rules(
			'nama_division',
			'Nama division',
			'required',
			array('required'		=> '%s harus diisi')
		);

		$validasi->set_rules(
			'kode_division',
			'Kode division',
			'required',
			array('required'		=> '%s harus diisi')
		);

		if ($validasi->run() === FALSE) {
			// End validasi

			$data = array(
				'title'		=> 'Edit division: ' . $division->nama_division,
				'division'		=> $division,
				'isi'		=> 'admin/division/edit'
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
			// Masuk ke database
		} else {
			$inp = $this->input;

			$data = array(
				'id_division'		=> $id_division,
				'id_user'		=> 1,
				'kode_division'		=> $inp->post('kode_division'),
				'nama_division'		=> $inp->post('nama_division'),
				'status_division'	=> $inp->post('status_division'),
				'keterangan'	=> $inp->post('keterangan'),
				'wilayah'		=> $inp->post('wilayah'),
			);
			$this->division_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data telah diupdate');
			redirect(base_url('admin/division'), 'refresh');
		}
		// End masuk database
	}

	// Proses
	public function proses()
	{
		$id_divisionnya	= $this->input->post('id_division');
		$pengalihan = $this->input->post('pengalihan');

		// Check id_division kosong atau tidak
		if ($id_divisionnya == "") {
			$this->session->set_flashdata('warning', 'Anda belum memilih data');
			redirect($pengalihan, 'refresh');
		}

		// Proses hapus jika klik tombol "hapus", jika ga ada yg kosong
		if (isset($_POST['hapus'])) {
			// Proses hapus diloop
			for ($i = 0; $i < sizeof($id_divisionnya); $i++) {
				$id_division = $id_divisionnya[$i];
				$data = array('id_division'		=> $id_division);
				$this->division_model->delete($data);
			}
			// End proses hapus
			$this->session->set_flashdata('sukses', 'Data telah dihapus');
			redirect($pengalihan, 'refresh');
		} elseif (isset($_POST['aktifkan'])) {
			// Proses aktifkan diloop
			for ($i = 0; $i < sizeof($id_divisionnya); $i++) {
				$id_division = $id_divisionnya[$i];
				$data = array(
					'id_division'		=> $id_division,
					'status_division'	=> 'Aktif'
				);
				$this->division_model->edit($data);
			}
			// End proses aktifkan
			$this->session->set_flashdata('sukses', 'Data telah diaktifkan');
			redirect($pengalihan, 'refresh');
		} elseif (isset($_POST['non_aktifkan'])) {
			// Proses non aktifkan diloop
			for ($i = 0; $i < sizeof($id_divisionnya); $i++) {
				$id_division = $id_divisionnya[$i];
				$data = array(
					'id_division'		=> $id_division,
					'status_division'	=> 'Non Aktif'
				);
				$this->division_model->edit($data);
			}
			// End proses non aktifkan
			$this->session->set_flashdata('sukses', 'Data telah di non aktifkan');
			redirect($pengalihan, 'refresh');
		}
	}

	// Delete
	public function delete($id_division)
	{
		$data = array('id_division'		=> $id_division);
		$this->division_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/division'), 'refresh');
	}
}

/* End of file division.php */
/* Location: ./application/controllers/admin/division.php */
