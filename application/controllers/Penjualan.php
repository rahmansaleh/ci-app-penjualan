<?php

use Dompdf\Dompdf;

class Penjualan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->load->helper('date');
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_detail_penjualan', 'm_detail_penjualan');
		$this->data['aktif'] = 'penjualan';
	}

	public function index(){
		redirect('penjualan/lihat');
	}

	public function lihat() {
		$this->data['title'] = 'Data Penjualan';
		$from = get_date('d/m/Y');
		$to = get_date('d/m/Y');
		
		if(isset($_GET['penjualan-list-daterange'])) {

			$from = change_format_date(trim(explode('-', $_GET['penjualan-list-daterange'])[0]), 'd/m/Y');
			$to = change_format_date(trim(explode('-', $_GET['penjualan-list-daterange'])[1]), 'd/m/Y');
		}
		$this->data['penjualan_list_daterange'] = isset($_GET['penjualan-list-daterange']) ? $_GET['penjualan-list-daterange'] : "";
		$this->data['all_penjualan'] = $this->m_penjualan->lihat($from, $to);
		$this->data['total_pendapatan'] = "Rp. ".number_format($this->m_penjualan->total_pendapatan($from, $to)->total, 0, ',', '.');
		$this->data['total_barang_terjual'] = $this->m_penjualan->total_barang_terjual($from, $to)->total." item";
		$this->data['total_transaksi'] = $this->m_penjualan->total_transaksi($from, $to)->total."x";
		$this->load->view('penjualan/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Penjualan';
		$this->data['all_barang'] = $this->m_barang->lihat_stok();

		$this->load->view('penjualan/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_dibeli = count($this->input->post('nama_barang_hidden'));
		
		$data_penjualan = [
			'no_penjualan' => $this->input->post('no_penjualan'),
			'nama_kasir' => $this->input->post('nama_kasir'),
			'tgl_penjualan' => $this->input->post('tgl_penjualan'),
			'jam_penjualan' => $this->input->post('jam_penjualan'),
			'total' => $this->input->post('total_hidden'),
			'nama_pembeli' => strtoupper($this->input->post('nama_pembeli')),
		];

		$data_detail_penjualan = [];

		for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
			array_push($data_detail_penjualan, ['nama_barang' => $this->input->post('nama_barang_hidden')[$i]]);
			$data_detail_penjualan[$i]['no_penjualan'] = $this->input->post('no_penjualan');
			$data_detail_penjualan[$i]['harga_barang'] = $this->input->post('harga_barang_hidden')[$i];
			$data_detail_penjualan[$i]['jumlah_barang'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_penjualan[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_penjualan[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if($this->m_penjualan->tambah($data_penjualan) && $this->m_detail_penjualan->tambah($data_detail_penjualan)){
			for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
				$this->m_barang->min_stok($data_detail_penjualan[$i]['jumlah_barang'], $data_detail_penjualan[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan/tambah');
		} else {
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan/tambah');
		}
	}

	public function detail($no_penjualan){
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['no'] = 1;

		$this->load->view('penjualan/detail', $this->data);
	}

	public function hapus($no_penjualan){
		if($this->m_penjualan->hapus($no_penjualan) && $this->m_detail_penjualan->hapus($no_penjualan)){
			$this->session->set_flashdata('success', 'Invoice Penjualan <strong>Berhasil</strong> Dihapus!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penjualan <strong>Gagal</strong> Dihapus!');
			redirect('penjualan');
		}
	}


	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('penjualan/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_penjualan'] = $this->m_penjualan->lihat();
		$this->data['title'] = 'Laporan Data Penjualan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penjualan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penjualan Tanggal ' . get_date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_penjualan){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['title'] = 'Laporan Detail Penjualan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penjualan/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penjualan Tanggal ' . get_date('d F Y'), array("Attachment" => false));
	}
}