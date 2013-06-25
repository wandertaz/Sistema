<?php
class frontend extends CI_Controller{
	public function avisar(){
		$this->load->view('avisar');
	}
	
	public function indique(){
		$this->load->view('indique');
	}
	
	public function pesquisa_online(){
		$this->load->view('pesquisa_online/pesquisa_online');
	}
}
?>