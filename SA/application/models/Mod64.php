<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod64 extends CI_Model{

	function cek($hasil,$mod){			
			$hasil = fmod($hasil, $mod);
			return $hasil;
		
	}
	function rumusChaesar($p,$b){
		//m.P+B(MOD 64) di rumus sudah mutlak 64 
		$m 			= 17;
		$mod 		= 64;
		$c 			= ($m*$p) + $b;
		$hasil_c	= fmod($c, $mod);

		return $hasil_c;



	}
	function rumusChaesarRead($p,$b){
		//m.P+B(MOD 64) di rumus sudah mutlak 64 
		$m 			= 17;
		$mod 		= 64;
		$c 			= 49*($p-$b);
//$hasil_c	= $c;
		if ($c < 0) {
			$c1 = $c /64; //cmod 64
			$c_bulat = ceil($c1);
			$d = (64*$c_bulat)*-1;
			$d_tambah = $c + $d;
			$hasil_c =  $d_tambah + 64;

		return $hasil_c;
		}else{

		$hasil_c	= fmod($c, $mod);
		return $hasil_c;
		}



	}

}
