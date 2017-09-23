<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * getLogin dengan parameter $username dan $password
 * melakukan select key terlebih dahulu di database
 * password di gabungkan dengan key lalu di enkrip dengan md5
 * select berdasarkan username dan password yang sudah di gabungkan
 * @param char idGalery,judul,deskripsi,gambar, createdBy, createdDate, changeBy, changDate
 * @package Model
 * @subpackage Model_galery
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_galery extends CI_Model{

	public function getGalery(){
		$this->db->join('user','user.idUser = galeri.createdBy','inner');
		return $this->db->get('galeri');
	}
}
