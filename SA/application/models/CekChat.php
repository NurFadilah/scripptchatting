<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekChat extends CI_Model{

	function cek($table,$where){

		return $this->db->get_where($table,$where);

	}
	public function cekKode($myisn,$isnKontak)
	{

		$this->db->select('*');

		$this->db->from('key');

		$this->db->where('myisn',$myisn);
		
		$this->db->where('isnKontak',$isnKontak);

		return $this->db->get();

	}
}
