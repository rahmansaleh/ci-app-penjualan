<?php

class M_penjualan extends CI_Model {
	protected $_table = 'penjualan';

	public function lihat($from = null, $to = null){
		$this->db->select('a.no_penjualan, a.tgl_penjualan, a.jam_penjualan, a.nama_pembeli, b.nama_barang, b.jumlah_barang, b.harga_barang, b.sub_total');
		$this->db->from($this->_table.' AS a');
		$this->db->join('detail_penjualan b', 'a.no_penjualan = b.no_penjualan', 'left');
		$this->db->where('tgl_penjualan >=', $from);
		$this->db->where('tgl_penjualan <=', $to);
		$this->db->order_by('tgl_penjualan', 'desc');
		$this->db->order_by('jam_penjualan', 'desc');
		return $this->db->get()->result();
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_penjualan($no_penjualan){
		return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_penjualan){
		return $this->db->delete($this->_table, ['no_penjualan' => $no_penjualan]);
	}
}