<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param char idBerita, judulBerita, deskripsi, gambar, createdBy, createdDate, changeBy, changDate
 * @package Model
 * @subpackage Model_berita
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_berita extends CI_Model{

	public function getBerita(){
		$this->db->order_by('idBerita','DESC');
		return $this->db->get('berita');
	}
	public function getBeritaLimit(){
		$this->db->order_by('idBerita','DESC');
		$this->db->limit(3);
		return $this->db->get('berita');
	}

	public function getInsertBerita($data){
		$this->db->insert('berita',$data);
	}

	public function getBeritaByID($key){
		$this->db->join('user','user.idUser = berita.createdBy','inner');
		return $this->db->get_where('berita',array('idBerita'=>$key));
	}

	public function getBeritaByGambar($key){
		return $this->db->get_where('berita',array('gambar'=>$key));
	}

	public function updateBerita($data,$key){
		$this->db->where('idBerita',$key);
        $update = $this->db->update('berita',$data);
        if($update){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }
        return $output;
	}

	public function deleteBerita($key){
		$this->db->where('idBerita',$key);
        $delete = $this->db->delete('berita');
        if($delete){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }

        return $output;
	}

	public function cari_berita($cari){
		$query = "SELECT * FROM berita INNER JOIN user ON user.idUser = berita.createdBy WHERE judulBerita LIKE '%".$cari."%' ORDER BY idBerita";
		return $this->db->query($query);
	}
}
