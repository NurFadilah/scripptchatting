<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param char idBerita, judulBerita, deskripsi, gambar, createdBy, createdDate, changeBy, changDate
 * @package Model
 * @subpackage Model_berita
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_about extends CI_Model{

	public function getAbout(){
		$this->db->limit(0,1);
		$this->db->order_by('idAbout','DESC');
		return $this->db->get('about');
	}
}
