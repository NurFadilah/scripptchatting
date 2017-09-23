<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChaesarChiper extends CI_Model{
public function __construct() {
        parent::__construct();
		$this->model_keamanan->getkeamanan();
		$this->load->model('Ascii2biner');
		$this->load->model('Mod64');
		
    }
	function enkrip($pesan,$key){	
		$x = $pesan.$key;
		return $x;
		
	}
public function enkripPesan($kalimat,$pesan)//proses mengenkripsi pesan
		{	
			$gabunganRumusKey 	= '';
			$penggalan 			= array(); ///var wadah untuk menyatukan nilai kunci yag sudah di ubah ke binner
			$wadah 				= ""; //untuk menyatukan array penggalan dan guna nanti di tampilkan
			$panjang 			= strlen($kalimat); //untuk menghitung nilai panjang kunci yang di gunakan untuk prosses pengulangan
			for ($i=0; $i < $panjang ; $i++) { 
				$satupersatu 	= substr($kalimat,$i,1);//proses pemecahan nilai kunci untuk proses prubahan ascii ke binner 8bit
				$cek 			= $this->Ascii2biner->cek($satupersatu);//mengirimkan dan menerima ascii yang di ubah ke binner 8 bit 
				$penggalan[$i] 	= $cek; //peoses mengisi variabel penggalan(menjadi gabungan/di gabungkan)
			}
			for ($p=0; $p < count($penggalan) ; $p++) { 
				$wadah = $wadah.$penggalan[$p];//proses menggabungkan nilai binner yang sudah di ubah dari ascii ke binnert 8 bit
			}
			//rumus transposisi untuk proses enkripsi 
			//|1|2|3|4|5|6|
			//================	
			//|3|5|1|6|4| start
			$pecahPesan 		= array(); //wadah untuk menampung pesan yang sudah di tambahkanpenambah x,y,z,a,b
			$panjangPesan		= strlen($pesan);//menghitung banyak atau panjang pesan yang akan di enkrip
			$rumus_P 			= array();
			$tambahan 			= array('x','y','z','a','b' ); //string yang di gunakan untuk menambah agar manjadi kelipatan 6
			$penambah			= ''; //untuk menggabungkan nilai penambah menjadi satu

			if($panjangPesan %6 == 0){//proses pengecekan apakah sudah kelipatan 6 atau belum jika belum di tambah jika sudah cukup
				//echo "<br />habis";
			}else{
			//tambahan|x|y|z|a|b|	
				$n 				= 6;//untuk melakukan pengulangan sebanyak 6 x karena sesuai dengan aturan rumus 1,2,3,4,5,6 dan yang kurang akan di tambahkan xyz ab agar genap menjadi kelipatan 6
				$pp 			= 1;//untuk menentukan kekurangan jumlah string
				for ($p=1; $p < $n ; $p++) {
					$panjangPesan = $panjangPesan + $pp;//proses penambahan pesan agar manjadi kelipatan 6 
					if($panjangPesan %6 == 0){//jika panjang sudah habis di bagi 6 maka break 
						break;
						}$pp = $pp++;//menambah nilai untuk menambah penambah
					} $datas=array('banyaktambah'=>$p);
           				$this->session->set_userdata($datas);
				for ($t=0; $t < $p ; $t++) { 
					//echo $tambahan[$t];
					$penambah 	= $penambah.$tambahan[$t];//proses menggabungkan nilai tambahan x,y,z,a,b
					}
				}

				$gabung 			= $pesan.$penambah; //penggabungan pesan dan penambah x,y,z,a,b
				$setelahDigabung	= strlen($gabung); //meghitung panjang nilai pesan yang sudah di gabung dengan penambah x,y,z,a,b
				for ($j=0; $j <$setelahDigabung ; $j++) { 
					$dataPecahPesan	= substr($gabung,$j,1); //memisahkan pesanyang sudah di tambahkan ke dalam array untuk di proses
					$pecahPesan[$j]	= $dataPecahPesan; //memasukan nilai yang sudah di paecah 1/1 kedala arrar pecahPesan[]
					}

				$panjagGabung 		= strlen($gabung);//menghitung panjang pesan yang sudah di gabunfkan dengan penambah x,y,z,a,b
				$rumus 				= $panjangPesan/6;//membagi panjang pesan yang sudah di tambahkan menjadi kelipatan 6 di bagi menjadi 6 sehingga di dapat nilai bulat
				$dataRumusSementara = array();//adalah variabel[] untuk memenggal nilai pesan yang sudah di gabung menjadi 6 string
				$dataRumusKedua 	= array();//akan kembali di kembalikan menjadi 1 string dan di setiap 6 sstring akan di masukan kedalam rumus ke 3[]
				$dataRumusKetiga 	= array();//di isi pesan yang sudah di rekayasa menjadi yang sudah di tetapkan|1|2|3|4|5|6|-->|3|5|1|6|4|
				$dataRumusKeempat 	= array();
				$rr 				= 0;
				for ($r = 0; $r < $rumus ; $r++) { //untuk mengisi rumus pertama
					$dataRumusSementara[$r] 	= substr($gabung, $rr,6);
					$rr 						= $rr + 6;
				}
				for ($a=0; $a < $rumus ; $a++) { //untuk mengisi rumus ke dua start
					$b 				= $dataRumusSementara[$a];
					for ($o=0; $o < 6 ; $o++) { 
							$dataRumusKedua[$o] = substr($b, $o, 1);//memenggal pesan yang sudah di tambahkan penambah menjadi [] 1 string untuk mengisi ruus ketiga []
						}
						for ($k=0; $k < 6 ; $k++) {//rumus yang sudah di tetapkan|1|2|3|4|5|6|//|3|5|1|6|4| start
							$s 		= $k+1; 
							if ($k == 0) {
								$dataRumusKetiga['0'] = $dataRumusKedua[$k];
							}elseif($k == 1){
								$dataRumusKetiga['1'] = $dataRumusKedua[$k];
							}elseif($k == 2){
								$dataRumusKetiga['2'] = $dataRumusKedua[$k];
							}elseif($k == 3){
								$dataRumusKetiga['3'] = $dataRumusKedua[$k];
							}elseif($k == 4){
								$dataRumusKetiga['4'] = $dataRumusKedua[$k];
							}elseif($k == 5){
								$dataRumusKetiga['5'] = $dataRumusKedua[$k];
							}
						}
					$gabungkeDua = '';//untuk menampung data yang sudah di rekayasa yang sudah di tetapkan|1|2|3|4|5|6|-->|3|5|1|6|4|2
						for ($k=0; $k < 6 ; $k++) { 
							$s = $k+1;
							if($k == 0){$s = $k+1;
								$gabungkeDua = $gabungkeDua.$dataRumusKetiga['2'];
							}elseif($k == 1){
								$gabungkeDua = $gabungkeDua.$dataRumusKetiga['4'];
							}elseif($k == 2){
								$gabungkeDua = $gabungkeDua.$dataRumusKetiga['0'];
							}elseif($k == 3){
								$gabungkeDua = $gabungkeDua.$dataRumusKetiga['5'];
							}elseif($k == 4){
								$gabungkeDua = $gabungkeDua.$dataRumusKetiga['3'];
							}elseif($k == 5){
								$gabungkeDua = $gabungkeDua.$dataRumusKetiga['1'];
							}
						}
						$gabunganRumusKey = $gabunganRumusKey.$gabungkeDua; //menampung semua pesan yang sudah di proses rumus 123456=>351642
					} //untuk mengisi rumus ke dua end

				$ascii2binerPesan 			= array();
				$gabungascii2binerPesan 	= '';//untuk menggabugkan binner mennjadi satu pariabel
				$rubahbinerkedecimalPesan 	= array();//untun menyimpan data yang sudah di konversi dari biner 6 bit ke decimal

					for ($i=0; $i < $panjangPesan  ; $i++) { 
						$penggalgabunganRumusKey 	= substr($gabunganRumusKey, $i,1);
						if($penggalgabunganRumusKey == ' '){
							//echo "__ini yang tidak memiliki binner :".$i.$penggalgabunganRumusKey;
						}
						$ascii2binerPesan[$i] 		= $this->Ascii2biner->cek($penggalgabunganRumusKey);
						$gabungascii2binerPesan 	= $gabungascii2binerPesan.$ascii2binerPesan[$i];
					}

				$panjanggabungascii2binerPesan 		= strlen($gabungascii2binerPesan);//menghitung panjang biner yang di gabung
				$dibagi6 							= $panjanggabungascii2binerPesan / 6;	
				$membagiBitPesanMenjadiEnam 		= array();
				$ii 								= 0;
				$membagiBitKeyMenjadiEnam 			= array();
					for ($i=0; $i < $dibagi6 ; $i++) { 
						$membagiBitPesanMenjadiEnam[$i] = substr($gabungascii2binerPesan,$ii,6);
						$ii = $ii + 6;
					}
				$untukMengisiarraymembagiBitPesanMenjadiEnam = '';

					for ($i=0; $i <count($membagiBitPesanMenjadiEnam) ; $i++) { 
						$rubahbinerkedecimalPesan[$i] = bindec($membagiBitPesanMenjadiEnam[$i]);
					}

					for ($i=0; $i <count($rubahbinerkedecimalPesan); $i++) { 
						$no = $i+1;
						$rumus_P[$i] = $rubahbinerkedecimalPesan[$i]; 
					}
			
						$ii = 0;
					for ($i=0; $i < count($rubahbinerkedecimalPesan) ; $i++) { 
						if (substr($wadah,$ii,6) == ''){
							break;
						}else{
						$membagiBitKeyMenjadiEnam[$i] = substr($wadah,$ii,6);
						}
						$ii = $ii + 6;
					}

				$kuncibiner6bit 					= array();
				$wadahkuncibiner6bitSelanjutnya 	= '';
				$w 									= 0;
					for ($i=0; $i < count($membagiBitKeyMenjadiEnam) ; $i++) { //24
							$w 								= $i;
							$wadahkuncibiner6bitSelanjutnya = '';
						for ($ii=0; $ii < count($membagiBitKeyMenjadiEnam) ; $ii++) { //n kunci
							if ($w > count($membagiBitKeyMenjadiEnam)-1) {
								$w = 0;
							}
							$wadahkuncibiner6bitSelanjutnya = $wadahkuncibiner6bitSelanjutnya.$membagiBitKeyMenjadiEnam[$w];
							$kuncibiner6bit[$i] 			= $membagiBitKeyMenjadiEnam[$i];
							$w++;
						}

					}

				$dataMenyimpanyangdikeluarkan 				= array(); //nilaibiner 
				$putar 										= ''; //untuk menyimpan data pesna ke 6 bit sementara
				$datapenambah 								= array(); //key yang sudah manjadi 6 bit dan valid
				$pemecah 									= 0;
				
					for ($i=0; $i < count($rubahbinerkedecimalPesan) ; $i++) { 
						$no = $i+1;
						if($i == 0){		
									$datapenambah[$i] = substr($wadah, $pemecah, 6);
									$dataMenyimpanyangdikeluarkan[$i] = $wadah;
									$wadah 	= $wadah.$datapenambah[$i];
						}else{
									$datapenambah[$i] = substr($wadah, $pemecah, 6);
									$dataMenyimpanyangdikeluarkan[$i] = substr($wadah, $pemecah, strlen($wadah));
									$wadah 	= $wadah.$datapenambah[$i];
							}
							$pemecah 		= $pemecah + 6;

					}
				$rumus_b 					= array(); //untuk manampung data biner ke decimal pesan
				$rumus_C_hasil 				= array();//kumpulan perhitungan chaesar
				$rumus_HasilDecimalKeBiner 	= array();//untuk menamung data yang sudah di ubah dari decimal ke binner
				$gabunganHasilDecimal 		= '';//menggabungkan nilai decimal dari pesan yang di enkripsi
				$hasilbinner8bit 			= array();//merubah gabungan hasil decimal kembali ke 8 bit
				$hasilEknripsiakhir 		= array(); //mengubah biner ke ascii dan proses enkrip selesai

					for ($i=0; $i < count($dataMenyimpanyangdikeluarkan) ; $i++) { 
						$no 				= $i+1;
						$rumus_b[$i] 		= bindec($datapenambah[$i]);
					}

					for ($i=0; $i <= count($rumus_P)-1 ; $i++) { 
						$no 							= $i+1;
						$hasil_chaesar					= $this->Mod64->rumusChaesar($rumus_P[$i],$rumus_b[$i]);//mengambil perhitungan dari models
						$rumus_HasilDecimalKeBiner[$i]	= sprintf( "%06d", decbin( $hasil_chaesar ));//proses konversi dan penyimpanan [] desimal ke biner
						$rumus_C_hasil[$i] 				= $hasil_chaesar ;//proses menamung hasil kedalam[]
						$gabunganHasilDecimal 			= $gabunganHasilDecimal.$rumus_HasilDecimalKeBiner[$i];//kumpulan binner yang akan di enkripsi kedalam ascii
					}
					
					 return($gabunganHasilDecimal);
	}
	public function tampil($biner)
	{
		$klipatan8 							= 0;
		$panjangPesan 						= strlen($biner)/8;
		$hasilbinner8bit					= array();
		$sendBack 							= '';
		for ($i=0; $i <$panjangPesan ; $i++) { 
			$hasilbinner8bit[$i] 			= substr($biner, $klipatan8, 8);//proses pemecahan biner manjadi 8 bit
			$klipatan8 						= $klipatan8 + 8;
			$enkripbinerkeascii 			= $this->Ascii2biner->biner2ascii($hasilbinner8bit[$i]);//mengirimkan dan menerima nilai dari model login
			$hasilEknripsiakhir[$i]			= $enkripbinerkeascii;//menampung semua hasil enkripsi kedalam []
			}
		for ($i=0; $i <count($hasilEknripsiakhir) ; $i++) { //mengeluarkan hasil yang telah di proses sesuai dengan aturan yang berlaku
		 	$sendBack = $sendBack.$hasilEknripsiakhir[$i];
		 }
		return($sendBack);
	}

	public function bacaPesan($pesan,$kalimat)
		{
			$gabunganRumusKey 						= '';
			$penggalan 								= array();//hasil penggalan kode yang akan di deskrip
			$wadah 									= "";//untuk menampung data yang sudah di penggal
			$panjang 								= strlen($kalimat);//panjang kunci
			$pesanChiper 							= array();//untuk memasukan data ascii kode dan akan di masukan 1/1 ke []
			for ($i=0; $i < $panjang ; $i++) { 
				$satupersatu 						= substr($kalimat,$i,1);
				$cek 								= $this->Ascii2biner->cek($satupersatu);//mengirimkan dan menerima nilai konversi ascii ke biner kunci
				$penggalan[$i] 						= $cek; //data yang sudah di konversi di masukankedalam [] peggalan
			}
			for ($p=0; $p < count($penggalan) ; $p++) { //proses mengeluarkan data yang sudah di masukan kedalam array satu pr satu
				$wadah 								= $wadah.$penggalan[$p];//proses memasukan data array kedalam satu variable
			}
			for ($i=0; $i < strlen($pesan)-1 ; $i++) { 
				if (mb_substr($pesan,$i,1)== '') {					
				}else{
					$pesanChiper[$i] 				= mb_substr($pesan,$i,1);//proses memasukan data /pemenggalan ascii
				}
			}

			$tampil 								= '';//gabungan pesan yang akan di desskrip
			$asciikebinerdeskrip 					= array();
			for ($i=0; $i < count($pesanChiper) ; $i++) {
			 	$cek 								= $this->Ascii2biner->cek($pesanChiper[$i]);//mengirimkan dan menerima nilai dari model as2biner ascii to binner
				//echo $pesanChiper[$i];
				$asciikebinerdeskrip[$i]			= $cek; //menggabungkan nilai yang sudah di konversi kedalam array []1/1
				$tampil 							= $tampil.$asciikebinerdeskrip[$i];//menggabungkan data kedalam satu var
			}

			$n 										= strlen($tampil) / 6; //membagi nilai panjang pesan oleh 6

			$dataMenyimpanyangdikeluarkan 			= array();
			$putar 									= ''; //untuk menyimpan data pesna ke 6 bit sementara
			$datapenambah 							= array(); //key yang sudah manjadi 6 bit dan vaid
			$pemecah 								= 0;
			for ($i=0; $i < $n ; $i++) { 
				$no = $i+1;
				if($i == 0){		
					$datapenambah[$i] 					= substr($wadah, $pemecah, 6);
					$dataMenyimpanyangdikeluarkan[$i] 	= $wadah;
					$wadah 								= $wadah.$datapenambah[$i];
				}else{
					$datapenambah[$i] 					= substr($wadah, $pemecah, 6);
					$dataMenyimpanyangdikeluarkan[$i] 	= substr($wadah, $pemecah, strlen($wadah));
					$wadah 								= $wadah.$datapenambah[$i];
					}$pemecah 							= $pemecah + 6;
				}
			for ($i=0; $i < count($dataMenyimpanyangdikeluarkan) ; $i++) { 
				$no 									= $i+1;
				$rumus_b[$i] 							= bindec($datapenambah[$i]);
			}

			$rumusdeskripnilai_biner 					= array();
			$hasilcaesardeskrip 						= array();
			$ii 										= 0;
			$wadahdeskrip = '';
			//echo "<br />".$tampil;
			$rumusdeskripnilai_b 						= array();//adalah niai dari biner ke desimal
			$rumusdeskripnilai_p 						= array();//adalah niai dari biner ke desimal
			for ($i=0; $i < $n ; $i++) { 
				$rumusdeskripnilai_biner[$i] 			= substr($tampil,$ii ,6);
				$ii 									= $ii + 6;
				$rumusdeskripnilai_p[$i] 				= bindec($rumusdeskripnilai_biner[$i]);
				$hasil_chaesar_descript					= $this->Mod64->rumusChaesarRead($rumusdeskripnilai_p[$i],$rumus_b[$i]);
				$hasilcaesardeskrip[$i]					= $hasil_chaesar_descript;
				$wadahdeskrip 							= $wadahdeskrip.sprintf("%06d",decbin($hasilcaesardeskrip[$i]));
			}
			$ii 										= 0;
			$deskrip_361524 							= '';
			$carikata 									= array();
			for ($i=0; $i <strlen($wadahdeskrip)/8 ; $i++) { 
				$carikata[$i] 							= substr($wadahdeskrip, $ii,8);
				$ii 									= $ii + 8;
				$cek 									= $this->Ascii2biner->biner2ascii($carikata[$i]);//mengirimkan dan menerima nilai dari model login
				$deskrip_361524 						= $deskrip_361524.$cek;
			}

			$deskrip_123456 							= array();
			$ix 										= 0;
			for ($i=0; $i <strlen($deskrip_361524)/6 ; $i++) { 
				$deskrip_123456[$i] = substr($deskrip_361524,$ix,6);
				$ix= $ix + 6;
			}
			$wadah_123456_array 						= array();
			$wadah_123456 								= array();
			$pesan = '';
			for ($i=0; $i < count($deskrip_123456) ; $i++) { 
				for ($j=0; $j < 6 ; $j++) { 
						$wadah_123456_array[$j] = substr( $deskrip_123456[$i], $j,1);
					}
				$finish = '';
				for ($m=0; $m < 6 ; $m++) { 
					if ($m == 0) {
						$pesan = $pesan.$wadah_123456_array[2];
					}elseif($m ==1){
						$pesan = $pesan.$wadah_123456_array[5];
						
					}elseif($m ==2){
						$pesan = $pesan.$wadah_123456_array[0];
						
					}elseif($m ==3){
						$pesan = $pesan.$wadah_123456_array[4];
						
					}elseif($m ==4){
						$pesan = $pesan.$wadah_123456_array[1];
						
					}elseif($m ==5){
						$pesan = $pesan.$wadah_123456_array[3];
						
					}
				}
			}

			return($pesan);






















	}
}
