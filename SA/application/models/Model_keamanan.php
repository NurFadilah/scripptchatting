<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_keamanan extends CI_Model{

	public function getkeamanan(){
		$hakAkses = $this->session->userdata('hakAkses');
		if(empty($hakAkses)){
			$this->session->sess_destroy();
			redirect('MyAcount');
		}
	}

}
