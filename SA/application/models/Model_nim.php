<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_nim extends CI_Model{

	function cek_nim($table,$where){		
		return $this->db->get_where($table,$where);
	}
}
