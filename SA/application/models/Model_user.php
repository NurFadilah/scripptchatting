<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * getLogin dengan parameter $username dan $password
 * @package Model
 * @subpackage Model_user
 * @author Danis Yogaswara <danistutorial@gmail.com>
 */
class Model_user extends CI_Model{

	public function getUser(){
		$this->db->order_by('idUser','DESC');
		return $this->db->get('user');
	}

	public function getInsertUser($data){
		$this->db->insert('user',$data);
	}

	public function getUserByID($key){
		return $this->db->get_where('user',array('idUser'=>$key));
	}

	public function deleteUser($key){
		$this->db->where('idUser',$key);
        $delete = $this->db->delete('user');
        if($delete){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }

        return $output;
	}

	public function getUpdateUser($data,$key){
		$this->db->where('idUser',$key);
        $update = $this->db->update('user',$data);
        if($update){
        	$output = "Berhasil";
        }else{
        	$output = "Gagal";
        }
        return $output;
	}
}
