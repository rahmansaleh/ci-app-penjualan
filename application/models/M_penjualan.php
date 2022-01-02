<?php

class M_penjualan extends CI_Model {
	protected $_table = 'penjualan';

	public function lihat(){
		$this->db->from($this->_table);
		$this->db->limit(100);
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