<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * getLogin dengan parameter $username dan $password
 * melakukan select key terlebih dahulu di database
 * password di gabungkan dengan key lalu di enkrip dengan md5
 * select berdasarkan username dan password yang sudah di gabungkan
 * @param char idProgram, judulProgram, deskripsi, gambar, createdBy, createdDate, changeBy, ChangeDate
 * @package Model
 * @subpackage Model_program
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_program extends CI_Model{

	public function getProgram(){
		$this->db->join('user','user.idUser = program.createdBy','inner');
		$this->db->order_by('idProgram','DESC');
		return $this->db->get('program');
	}

	public function getProgramLimit($start, $finish){
		$this->db->join('user','user.idUser = program.createdBy','inner');
		$this->db->limit($start, $finish);
		return $this->db->get('program');
	}

	public function getInsertProgram($data){
		$this->db->insert('program',$data);
	}

	public function getProgramByID($key){
		$this->db->join('user','user.idUser = program.createdBy','inner');
		return $this->db->get_where('program',array('idProgram'=>$key));
	}

	public function getProgramByGambar($key){
		return $this->db->get_where('program',array('gambar'=>$key));
	}

	public function updateProgram($data,$key){
		$this->db->where('idProgram',$key);
        $update = $this->db->update('program',$data);
        if($update){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }
        return $output;
	}

	public function deleteProgram($key){
		$this->db->where('idProgram',$key);
        $delete = $this->db->delete('program');
        if($delete){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }

        return $output;
	}

	public function cari_program($cari){
		$query = "SELECT * FROM program INNER JOIN user ON user.idUser = program.createdBy WHERE judulProgram LIKE '%".$cari."%' ORDER BY idProgram";
		return $this->db->query($query);
	}
}
