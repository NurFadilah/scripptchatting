<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* penyederhanaan fungsi */
function _page($total_row, $per_page, $uri_segment, $url) {
	$CI 	=& get_instance();
	$CI->load->library('pagination');
	$config['base_url'] 	= $url;
	$config['total_rows'] 	= $total_row;
	$config['uri_segment'] 	= $uri_segment;
	$config['per_page'] 	= $per_page; 
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close']= '</li>';
	$config['prev_link'] 	= '<span aria-hidden="true">Previous</span>';
	$config['prev_tag_open']='<li>';
	$config['prev_tag_close']='</li>';
	$config['next_link'] 	= '<span aria-hidden="true">Next</span>';
	$config['next_tag_open']='<li>';
	$config['next_tag_close']='</li>';
	$config['cur_tag_open']='<li class="active"><a href="#" aria-label="Next">';
	$config['cur_tag_close']='</a></li>';
	$config['first_tag_open']='<li>';
	$config['first_tag_close']='</li>';
	$config['last_tag_open']='<li>';
	$config['last_tag_close']='</li>';
	
	$CI->pagination->initialize($config); 
	return $CI->pagination->create_links();
}

function time_ago($timestamp){
	$time_ago = strtotime($timestamp);
	$curren_time = time();
	$time_difference = $curren_time - $time_ago;
	$seconds 	= $time_difference;
	$minutes 	= round($seconds / 60);
	$hours 		= round($seconds / 3600);
	$days 		= round($seconds / 86400);
	$weeks 		= round($seconds / 604800);
	$mounths 	= round($seconds / 2629440);
	$years 		= round($seconds / 31553280);

	if($seconds <= 60){
		return "Just Now";
	}else if($minutes <= 60){
		if($minutes==1){
			return "one minutes ago";
		}else{
			return "$minutes minutes ago";
		}
	}else if($hours <=24){
		if($hours==1){
			return "an hour ago";
		}else{
			return "$hours hrs ago";
		}
	}else if($days <=7){
		if($days==1){
			return "yesterday";
		}else{
			return "$days days ago";
		}
	}else if($weeks <=4.3){
		if($weeks==1){
			return "a weeks ago";
		}else{
			return "$weeks weeks ago";
		}
	}else if($mounths <=12){
		if($mounths==1){
			return "a mounth ago";
		}else{
			return "$mounths days ago";
		}
	}
}
function waktu(){
	date_default_timezone_set('Asia/Jakarta');
	return date("Y-m-d H:i:s");
}

function tanggal(){
	date_default_timezone_set('Asia/Jakarta');
	return date("Y-m-d");
}

function jam(){
	date_default_timezone_set('Asia/Jakarta');
	return date("H:i:s");
}

function selectTanggal(){
		for ($i=1; $i<=31; $i++){
	    $lebar=strlen($i);
	    switch($lebar){
	      case 1:
	      {
	        $g="0".$i;
	        break;     
	      }
	      case 2:
	      {
	        $g=$i;
	        break;     
	      }      
	    }  
	    if ($i==date("d"))
	      echo "<option value=$g selected>$g</option>";
	    else
	      echo "<option value=$g>$g</option>";
	  }
	}

function selectBulan(){
		$nama_bln = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		  for ($bln=1; $bln<=12; $bln++){
		      if ($bln==date("m"))
		         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
		      else
		        echo "<option value=$bln>$nama_bln[$bln]</option>";
		  }
	}

function selectTahun(){
		$thun = date("Y");
		for($t=$thun; $t>=1970; $t--){
			echo "<option value='$t'>$t</option>";
		}
	}

function bulan($tgl, $bln, $thn){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
		$result = $tgl . " " . $BulanIndo[(int)$bln-1] . " ". $thn;		
	return($result);
}

function editTanggal($tgl){
		for ($i=1; $i<=31; $i++){
	    $lebar=strlen($i);
	    switch($lebar){
	      case 1:
	      {
	        $g="0".$i;
	        break;     
	      }
	      case 2:
	      {
	        $g=$i;
	        break;     
	      }      
	    }  
	    if ($i==$tgl)
	      echo "<option value=$g selected>$g</option>";
	    else
	      echo "<option value=$g>$g</option>";
	  }
	}
function editBulan($bulan){
		$nama_bln = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		  for ($bln=1; $bln<=12; $bln++){
		      if ($bln==$bulan)
		         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
		      else
		        echo "<option value=$bln>$nama_bln[$bln]</option>";
		  }
	}
function editTahun($tahun){
		$thun = date("Y");
		for($t=$thun; $t>=1970; $t--){
			if($t==$tahun){
				echo "<option value='$t' selected>$t</option>";
			}else{
				echo "<option value='$t'>$t</option>";
			}
		}
	}
function parse_tanggal($tanggal){
	$date = $tanggal;
    $pisahtgl = explode("-", $tanggal);
    $tgl = $pisahtgl[2];
    $bln = $pisahtgl[1];
    $thn = $pisahtgl[0];
    return bulan($tgl,$bln,$thn);
}
function parse_tanggal_waktu($tanggal){
	$date = $tanggal;
    $pindah = explode(" ", $date);
    $tanggal = $pindah[0];
    $waktu = $pindah[1];
    $pisahtgl = explode("-", $tanggal);
    $tgl = $pisahtgl[2];
    $bln = $pisahtgl[1];
    $thn = $pisahtgl[0];
    return bulan($tgl,$bln,$thn);
}

function parse_waktu_tanggal($tanggal){
	$date = $tanggal;
    $pindah = explode(" ", $date);
    $tanggal = $pindah[0];
    $waktu = $pindah[1];
    $pisahtgl = explode("-", $tanggal);
    $tgl = $pisahtgl[2];
    $bln = $pisahtgl[1];
    $thn = $pisahtgl[0];
    return $waktu;
}

function hari(){
	$tanggal = '10';
	$day = date('D', strtotime($tanggal));
	$dayList = array(
		'Sun' => 'Minggu',
		'Mon' => 'Senin',
		'Tue' => 'Selasa',
		'Wed' => 'Rabu',
		'Thu' => 'Kamis',
		'Fri' => 'Jumat',
		'Sat' => 'Sabtu'
	);

	return $dayList;
}

function rand_color() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

function hapussemua($folderhapus) {
    $files = glob( $folderhapus . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
            linuxfun_hapussemua( $file );
        else
            unlink( $file );
    }

    if (is_dir($folderhapus)) rmdir( $folderhapus );

}

function color($warna){
	$color = array(1=>
					"#000000",
					"#0000FF",
					"#A52A2A",
					"#7FFF00",
					"#DC143C",
					"#006400",
					"#FF8C00",
					"#8B0000",
					"#9400D3",
					"#008000",
					"#B22222",
					"#00FF00",
					"#FFA500",
					"#800080",
					"#2E8B57",
					"#4682B4",
					"#008080",
					"#40E0D0",
					"#9ACD32",
					"#9370DB",
					"#C71585",
					);
	return $color[$warna];
}

function arraywarna($warna){
	$color = array(1=>
					"blightblue",
					"bgreen",
					"borange",
					"bblue",
					);
	return $color[$warna];
}