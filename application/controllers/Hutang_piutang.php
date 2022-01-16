<?php

class Hutang_piutang extends CI_Controller {

    public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->load->helper('date');
		$this->load->model('M_hutang_piutang', 'm_hutang_piutang');
		$this->data['aktif'] = 'hutang_piutang';
	}

    public function index() {

        $this->data['title'] = 'Data Hutang/Piutang';
        $this->load->view('hutang_piutang/lihat', $this->data);
    }
}
?>