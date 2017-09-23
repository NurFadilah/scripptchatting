<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * getLogin dengan parameter $username dan $password
 * melakukan select key terlebih dahulu di database
 * password di gabungkan dengan key lalu di enkrip dengan md5
 * select berdasarkan username dan password yang sudah di gabungkan
 * @param char idPengumuman, judulPengumuman, deskripsiPengumuman, filePengumuman, createdBy, createdDate, changeBy, changeDate
 * @package Model
 * @subpackage Model_pengumuman
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_pengumuman extends CI_Model{

	public function getPengumuman(){
		return $this->db->get('pengumuman');
	}

	public function getPengumumanLimit($start, $finish){
		$this->db->limit(0,5);
		return $this->db->get('pengumuman');
	}

	public function getPengumumanByID($key){
		return $this->db->get_where('pengumuman',array('no'=>$key));
	}

}
