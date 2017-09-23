<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * getLogin dengan parameter $username dan $password
 * melakukan select key terlebih dahulu di database
 * password di gabungkan dengan key lalu di enkrip dengan md5
 * select berdasarkan username dan password yang sudah di gabungkan
 * @param char idRegulasi, judul, file, createdBy, createdDate, changeBy, changeDate
 * @package Model
 * @subpackage Model_regulasi
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_regulasi extends CI_Model{

	public function getRegulasi(){
		$this->db->join('user','user.idUser = regulasi.createdBy','inner');
		$this->db->order_by('idRegulasi','DESC');
		return $this->db->get('regulasi');
	}

	public function getRegulasiByID($key){
		return $this->db->get_where('regulasi',array('idRegulasi'=>$key));
	}

	public function getInsertRegulasi($data){
		$insert = $this->db->insert('regulasi',$data);
		if($insert){
			$output = "Berhasil";
		}else{
			$output = "Gagal";
		}
		return $output;
	}

	public function getUpdateBerita($data,$key){
		$this->db->where('idRegulasi',$key);
        $update = $this->db->update('regulasi',$data);
        if($update){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }
        return $output;
	}

	public function deleteRegulasi($key){
		$this->db->where('idRegulasi',$key);
        $delete = $this->db->delete('regulasi');
        if($delete){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }

        return $output;
	}
}
