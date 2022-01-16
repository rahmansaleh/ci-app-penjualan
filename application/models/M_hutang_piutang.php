<?php

class M_hutang_piutang extends CI_Model {
    protected $_table = 'hutang_piutang';

    public function lihat() {
        $query = $this->db->get($this->_table);
        return $query->result();
    }
}
?>