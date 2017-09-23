<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function __construct() {
        parent::__construct();
		$this->model_keamanan->getkeamanan();
		$this->load->model('Ascii2biner');
		$this->load->model('Mod64');
		$this->load->model('ChaesarChiper');
		$this->load->model('CekChat');
		$this->load->helper('text');
		$this->load->library('biodata');

    }

public function index()
	{
		$this->session->set_userdata('isnKontak', '');
		$data['kontak'] = $this->crud->getAll('kontak');
		$data['banyak'] = $this->crud->getAll('kontak')->num_rows();
		$this->load->view('home/header');
		$this->load->view('home/home',$data);
		$this->load->view('home/welcome_body');
		$this->load->view('home/footer');
	}
public function pilihTeman()
	{
		$isnKontak				= addslashes(htmlentities($this->input->post('id')));
		$this->session->set_userdata('isnKontak','');
		$this->db->select('*');
		$this->db->from('kontak');
		$this->db->where('isnKontak',$isnKontak);
		$data['kontak']			= $this->db->get();
		$this->load->view('home/chat/startChat',$data);
	}
public function openChat()
	{
		$key						= addslashes(htmlentities($this->input->post('key')));
		$isnKontak					= addslashes(htmlentities($this->input->post('isnKontak')));
		$myisn						= $this->session->userdata('hakAkses');
		
			$where = array(
			'isnKontak' => $isnKontak
			);
		$cek = $this->CekChat->cek("key",$where);
			if($cek->num_rows() > 0){
				$this->session->set_userdata('kunci',$key);
			}else{
				$this->session->set_userdata('kunci',$key);
				$data['isnKontak']		= $isnKontak;
				$data['myisn']			= $myisn;
				$data['key']			= md5($key);
				$insert					= $this->crud->insert('key',$data);
			}
		if ($this->session->userdata('isnKontak') == '') {
			$this->session->set_userdata('isnKontak', $isnKontak);
		}else{

		}
		$this->db->select('*');
		$this->db->from('kontak');
		$this->db->where('isnKontak',$isnKontak);
		$data['identitas']			= $this->db->get();
		$data['kontak'] 			= $this->crud->getAll('kontak');
		$data['banyak'] 			= $this->crud->getAll('kontak')->num_rows();
		$this->db->select('*');
		$this->db->from('chatting');
		$this->db->where('id_pengirim',$this->session->userdata('hakAkses'));
		$this->db->where('id_penerima',$this->session->userdata('isnKontak'));
		$this->db->or_where('id_pengirim',$this->session->userdata('isnKontak'));
		$this->db->where('id_penerima',$this->session->userdata('hakAkses'));
		$data['chatting']			= $this->db->get();
		if ($this->session->userdata('isnKontak') == '') {
			redirect('Home');
		}elseif($this->session->userdata('isnKontak') == ' '){
			redirect('Home');
		}else{
		$this->load->view('home/header');
		$this->load->view('home/home',$data);
		$this->load->view('home/chat/body_chat',$data);
		$this->load->view('home/footer');
		}
	}
	public function SendMessage()
	{

		$isnKontak 							= $this->session->userdata('isnKontak');
        $ses 								= $this->session->userdata('hakAkses');
		$field['nama_pengirim']             = $this->session->userdata('nama');
        $field['email_pengirim']            = $this->session->userdata('email');
        $field['id_pengirim']               = $this->session->userdata('hakAkses');
        $field['id_penerima']               = $this->session->userdata('isnKontak');
        $field['waktu_kirim']               = waktu();
        $pesan 								= $this->input->post('pesan');
        $kunci 								= $this->session->userdata('kunci');
        $field['key']               		= $kunci;

			$where = array(
			'isnKontak' => $isnKontak
			);
			$cek = $this->CekChat->cek("key",$where);
			if($cek->num_rows() > 0){
				$d = $cek->row_array();
					$data = array(
						'key'=>$d['key']);
				$key_key =  $data['key'];
				if (md5($kunci) == $key_key) {
			        
			        $pesanYangDikirim					= $this->ChaesarChiper->enkripPesan($kunci,$pesan);
			        $field['pesan_keluar']              = htmlspecialchars($pesanYangDikirim);
			        $field['banyak_tambahan']			= $this->session->userdata('banyaktambah');
			        $this->crud->insert('chatting',$field);
					
				}else{
					?>
						<script type="text/javascript">
							alert('wrong password');
						</script>
					<?php
				}
			}

		$this->db->select('*');
		$this->db->from('chatting');
		$this->db->where('id_pengirim',$this->session->userdata('hakAkses'));
		$this->db->where('id_penerima',$this->session->userdata('isnKontak'));
		$this->db->or_where('id_pengirim',$this->session->userdata('isnKontak'));
		$this->db->where('id_penerima',$this->session->userdata('hakAkses'));
		$data['chatting']					= $this->db->get();

		$this->db->select('*');
		$this->db->from('kontak');
		$this->db->where('isnKontak',$isnKontak);
		$data['identitas']					= $this->db->get();
		$data['kontak'] 					= $this->crud->getAll('kontak');
		$data['banyak'] 					= $this->crud->getAll('kontak')->num_rows();
		if ($isnKontak == '') {
			redirect('Home');
		}else{
		$this->load->view('home/chat/bukaPesan',$data);
		}
	}
	public function cek()
	{
		$isnKontak 							= $this->session->userdata('isnKontak');
		$this->db->select('*');
		$this->db->from('chatting');
		$this->db->where('id_pengirim',$this->session->userdata('hakAkses'));
		$this->db->where('id_penerima',$this->session->userdata('isnKontak'));
		$this->db->or_where('id_pengirim',$this->session->userdata('isnKontak'));
		$this->db->where('id_penerima',$this->session->userdata('hakAkses'));
		$data['chatting']		= $this->db->get();
				if ($isnKontak == '') {
			redirect('Home');
		}else{
		$this->load->view('home/chat/bukaPesan',$data);
		}

	}
public function openMassage()
	{
		$isnKontak = $this->session->userdata('isnKontak');
		$this->db->select('*');
		$this->db->from('kontak');
		$this->db->where('isnKontak',$isnKontak);
		$data['identitas']			= $this->db->get();
		$data['kontak'] = $this->crud->getAll('kontak');
		$data['banyak'] = $this->crud->getAll('kontak')->num_rows();
		$this->db->select('*');
		$this->db->from('chatting');
		$this->db->where('id_pengirim',$this->session->userdata('hakAkses'));
		$this->db->where('id_penerima',$this->session->userdata('isnKontak'));
		$this->db->or_where('id_pengirim',$this->session->userdata('isnKontak'));
		$this->db->where('id_penerima',$this->session->userdata('hakAkses'));
		$data['chatting']		= $this->db->get();
		if ($isnKontak == '') {
			redirect('Home');
		}else{
		$this->load->view('home/header');
		$this->load->view('home/home',$data);
		$this->load->view('home/chat/body_chat',$data);
		$this->load->view('home/footer');
		}
	}

public function key()
		{
		$this->load->view('chesar/home');
		}
public function read()
		{
		$this->load->view('chesar/bacaPesan');
		}
public function library()
		{	
			$gabunganRumusKey = '';
			$wadah 				= "";
			$wadahnomorarray 	= "";
			$kalimat			= $this->input->post('key');
			$pesan				= $this->input->post('pesan');
			$penggalan = array();
			$panjang=strlen($kalimat);
			for ($i=0; $i < $panjang ; $i++) { 
				$satupersatu = substr($kalimat,$i,1);
				$cek = $this->Ascii2biner->cek($satupersatu);//mengirimkan dan menerima nilai dari model login
				$penggalan[$i] = $cek;
			}
for ($p=0; $p < count($penggalan) ; $p++) { //proses mengeluarkan data yang sudah di masukan kedalam array satu pr satu
	echo  $penggalan[$p]; echo "_";
	$wadah = $wadah.$penggalan[$p];
	$wadahnomorarray = $wadahnomorarray.$p;
}	
			echo "<br />panjang : ".$panjang;
			echo "<br />kalimat :". $kalimat;
			echo '<br />';
			echo "wadah : ".$wadah." : banyak".strlen($wadah);
			//echo "<br />wadah nomor array : ".$wadahnomorarray;
			echo "<br />===============================================================||";

//rumus transposisi untuk proses enkripsi 
//|1|2|3|4|5|6|
//================	
//|3|5|1|6|4| start
$pecahPesan 		= array();
$panjangPesan		= strlen($pesan);//15
$penambah			= '';
$rumus_P = array();
$tambahan = array('x','y','z','a','b' );
if($panjangPesan %6 == 0){
	echo "<br />habis";
}else{
//tambahan|x|y|z|a|b|
	echo "<br /> ";
	$n = 6;
	$pp = 1;
	for ($p=1; $p < $n ; $p++) {
		$panjangPesan = $panjangPesan + $pp;
		if($panjangPesan %6 == 0){
			break;
		}$pp = $pp++;
	}echo " harus di tambah ".$p; echo "<br /> maka akan di tambahkan :";
	for ($t=0; $t < $p ; $t++) { 
		echo $tambahan[$t];
		$penambah = $penambah.$tambahan[$t];
	}
}
echo "<br />Panjang Pesan menjadi:".$panjangPesan;
//echo "<br />";
			echo "<br />Pesan : ".$pesan;
			echo "<br />Pesan tambahan : ".$penambah;
			$gabung = $pesan.$penambah;
			echo "<br />Setelah di gabung menjadi : ".$gabung;
			echo "<br />";
			$setelahDigabung = strlen($gabung);
//echo "===============================================================||<br />";
	for ($j=0; $j <$setelahDigabung ; $j++) { 
		$dataPecahPesan	= substr($gabung,$j,1);
		$pecahPesan[$j]= $dataPecahPesan; 
		}
	for ($c=0; $c <count($pecahPesan) ; $c++) { 
		//echo "[$c]".$pecahPesan[$c]; echo " ";
		}

//echo "<br />===============================================================||";
	$panjagGabung = strlen($gabung);
	$rumus =$panjangPesan/6;
	$dataRumusSementara = array();
	$dataRumusKedua = array();
	$dataRumusKetiga = array();
	$dataRumusKeempat = array();
	$rr = 0;
	for ($r=0; $r < $rumus ; $r++) { 
		//echo "<br />".substr($gabung, $rr,6);
		$dataRumusSementara[$r] = substr($gabung, $rr,6);
		$rr = $rr + 6;
//echo "<br />===============================================================||<br />";
	}
	for ($a=0; $a < $rumus ; $a++) { 
		//echo "<br />";
		$b = $dataRumusSementara[$a];
		$panjangb = strlen($b);	
			for ($o=0; $o < 6 ; $o++) { 
				$dataRumusKedua[$o] = substr($b, $o, 1);
			}
			for ($k=0; $k < 6 ; $k++) {$s = $k+1; 
				//echo "_ [$s]",$dataRumusKedua[$k];
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
//echo "<br />============================<br />";
$gabungkeDua = '';
for ($k=0; $k < 6 ; $k++) { $s = $k+1;
	if($k == 0){$s = $k+1;
		//echo "_ [$s]",$dataRumusKetiga['2'];
$gabungkeDua = $gabungkeDua.$dataRumusKetiga['2'];
	}elseif($k == 1){
		//echo "_ [$s]",$dataRumusKetiga['4'];
$gabungkeDua = $gabungkeDua.$dataRumusKetiga['4'];
	}elseif($k == 2){
		//echo "_ [$s]",$dataRumusKetiga['0'];
$gabungkeDua = $gabungkeDua.$dataRumusKetiga['0'];
	}elseif($k == 3){
		//echo "_ [$s]",$dataRumusKetiga['5'];
$gabungkeDua = $gabungkeDua.$dataRumusKetiga['5'];
	}elseif($k == 4){
		//echo "_ [$s]",$dataRumusKetiga['3'];
$gabungkeDua = $gabungkeDua.$dataRumusKetiga['3'];
	}elseif($k == 5){
		//echo "_ [$s]",$dataRumusKetiga['1'];
$gabungkeDua = $gabungkeDua.$dataRumusKetiga['1'];
	}
}
//echo $gabungkeDua;
$gabunganRumusKey = $gabunganRumusKey.$gabungkeDua;
	}

// echo "<br />=============data rumus ke dua============================== <br/>";
// print_r($dataRumusKedua);
// echo "<br />=============data rumus ke tiga============================== <br/>";
// print_r($dataRumusKetiga);
//kunci adalah penggalan()
echo "<br />============================<br />";
$ascii2binerPesan = array();
$gabungascii2binerPesan = '';//untuk menggabugkan binner mennjadi satu pariabel
$rubahbinerkedecimalPesan = array();//untun menyimpan data yang sudah di konversi dari biner 6 bit ke decimal
echo "hasilnya adalah : ".$gabunganRumusKey;//nilai yang akan di kirim dan akan di lakukan proses selanjutnya
	for ($i=0; $i < $panjangPesan  ; $i++) { 
		$penggalgabunganRumusKey = substr($gabunganRumusKey, $i,1);
		if($penggalgabunganRumusKey == ' '){
			echo "__ini yang tidak memiliki binner :".$i.$penggalgabunganRumusKey;
		}
		$ascii2binerPesan[$i] = $this->Ascii2biner->cek($penggalgabunganRumusKey);
		$gabungascii2binerPesan = $gabungascii2binerPesan.$ascii2binerPesan[$i];
	}
	echo "<br />Di Ubah Ke binner menjadi<br /> ";
	for ($i=0; $i <$panjangPesan ; $i++) { 
		echo "_".$ascii2binerPesan[$i];
	}
echo "<br />Setelah di gabung menjadi :<br/>====================<br /> ".$gabungascii2binerPesan;//hasil dari gabungan biner
	$panjanggabungascii2binerPesan = strlen($gabungascii2binerPesan);//menghitung panjang biner yang di gabung
	echo "<br /> panjang:".$panjanggabungascii2binerPesan." akan dibagi 6 maka hasilnya :";
	$dibagi6 = $panjanggabungascii2binerPesan / 6;
	echo $dibagi6;
$membagiBitPesanMenjadiEnam = array();
$ii = 0;
		for ($i=0; $i < $dibagi6 ; $i++) { 
			$membagiBitPesanMenjadiEnam[$i] = substr($gabungascii2binerPesan,$ii,6);
			$ii = $ii + 6;
		}
$untukMengisiarraymembagiBitPesanMenjadiEnam = '';
print_r($membagiBitPesanMenjadiEnam);
	for ($i=0; $i <count($membagiBitPesanMenjadiEnam) ; $i++) { 
		$rubahbinerkedecimalPesan[$i] = bindec($membagiBitPesanMenjadiEnam[$i]);
	
	}

	for ($i=0; $i <count($rubahbinerkedecimalPesan) ; $i++) { $no = $i+1;
		echo "<br />P".$no." :".$rubahbinerkedecimalPesan[$i]."";
		$rumus_P[$i] = $rubahbinerkedecimalPesan[$i]; 
	}
			$membagiBitKeyMenjadiEnam = array();
			
			$ii = 0;
		for ($i=0; $i < count($rubahbinerkedecimalPesan) ; $i++) { 
			if (substr($wadah,$ii,6) == ''){
				break;
			}else{
			$membagiBitKeyMenjadiEnam[$i] = substr($wadah,$ii,6);
			}
			$ii = $ii + 6;
		}
print_r($penggalan);
echo "<br /> kunci ";
print_r($membagiBitKeyMenjadiEnam);
$kuncibiner6bit = array();
$wadahkuncibiner6bitSelanjutnya = '';
		$w = 0;
for ($i=0; $i < count($membagiBitKeyMenjadiEnam) ; $i++) { //24
		$w = $i;
		$wadahkuncibiner6bitSelanjutnya = '';
		echo "<br/> : ".$i." : ";
	for ($ii=0; $ii < count($membagiBitKeyMenjadiEnam) ; $ii++) { //n kunci
		if ($w > count($membagiBitKeyMenjadiEnam)-1) {
			$w = 0;
		}
		$wadahkuncibiner6bitSelanjutnya = $wadahkuncibiner6bitSelanjutnya.$membagiBitKeyMenjadiEnam[$w];
		echo $membagiBitKeyMenjadiEnam[$w]."_" ;
		$kuncibiner6bit[$i] = $membagiBitKeyMenjadiEnam[$i];
		$w++;
	}

}//$wadah = '01000010011000010110111001100100011101010110111001100111010000100110000101101110011001000111010101101110011001110100001001100001011011100110011101';
echo "<br />";
print_r($kuncibiner6bit);
echo $wadahkuncibiner6bitSelanjutnya;
echo "<br /> kode kunci <br />".$wadah." : ".strlen($wadah);
echo "<br />-====================================-<br />";

$dataMenyimpanyangdikeluarkan = array();
$putar = ''; //untuk menyimpan data pesna ke 6 bit sementara
$datapenambah = array(); //key yang sudah manjadi 6 bit dan vaid
$pemecah = 0;
$panjangPutar = strlen($putar)-1;
for ($i=0; $i < count($rubahbinerkedecimalPesan) ; $i++) { 
	$no = $i+1;
	if($i == 0){		
				echo "<br />".$no."_".$wadah;
				$datapenambah[$i] = substr($wadah, $pemecah, 6);
				$dataMenyimpanyangdikeluarkan[$i] = $wadah;
				$wadah = $wadah.$datapenambah[$i];
	}else{
				$datapenambah[$i] = substr($wadah, $pemecah, 6);
				$dataMenyimpanyangdikeluarkan[$i] = substr($wadah, $pemecah, strlen($wadah));
				//echo "<br />_".substr($wadah, $pemecah, 6);
				echo "<br />".$no."_".$dataMenyimpanyangdikeluarkan[$i];
				echo "<br/>banyak wadah : ".strlen($wadah);
				$wadah = $wadah.$datapenambah[$i];
		}
		$pemecah = $pemecah + 6;

}
echo "<br />".$putar;
echo "<br /><br />panjang :".strlen($putar);
echo "<br/>";
print_r($datapenambah);
echo "<br />=========================<br />";
echo "<br /> ====================dari binner 6 bit di putar dengan aturan chipper====================";
echo "<br />================================================================================";
//print_r($dataMenyimpanyangdikeluarkan);
//P = Plaintext 
//rumus caesar C = m.P + b(mod n); n=64; m=17 default
$rumus_m = 17;
$rumus_b = array();
$rumus_C_hasil = array();
$rumus_HasilDecimalKeBiner = array();
$gabunganHasilDecimal = '';
$hasilbinner8bit = array();
$hasilEknripsiakhir = array();
//$rumus_P = array();-->sudah di deklarasi di atas
for ($i=0; $i < count($dataMenyimpanyangdikeluarkan) ; $i++) { 
	$no = $i+1;
	$rumus_b[$i] = bindec($datapenambah[$i]);
	echo "<br />".$no." : " .$dataMenyimpanyangdikeluarkan[$i];
	echo " : dalam decimal : ".$rumus_b[$i];

}
echo "<br />=========================<br />";
echo "<br /> ====================Plaintext====================";
echo "<br />================================================================================";

echo "<br />__P____________b===============hasilnya adalah.=======decimal ke biner ";
for ($i=0; $i <= count($rumus_P)-1 ; $i++) { 
	$no = $i+1;
	echo "<br />".$no." :".$rumus_P[$i]; echo "___||___:".$no." : ".$rumus_b[$i];
	$hasil_chaesar	= $this->Mod64->rumusChaesar($rumus_P[$i],$rumus_b[$i]);
	$rumus_HasilDecimalKeBiner[$i]	= sprintf( "%06d", decbin( $hasil_chaesar ));
	$rumus_C_hasil[$i] = $hasil_chaesar ;echo "===============|".$rumus_C_hasil[$i]."-------".$rumus_HasilDecimalKeBiner[$i];
	$gabunganHasilDecimal = $gabunganHasilDecimal.$rumus_HasilDecimalKeBiner[$i];
}


echo "<br />";

echo $gabunganHasilDecimal."<br />panjang setelah di potong per 8 :".strlen($gabunganHasilDecimal)/8;
echo "<br />";
$klipatan8 = 0;
for ($i=0; $i <$panjangPesan ; $i++) { 
	$hasilbinner8bit[$i] = substr($gabunganHasilDecimal, $klipatan8, 8);
	$klipatan8 = $klipatan8 + 8;
	$enkripbinerkeascii = $this->Ascii2biner->biner2ascii($hasilbinner8bit[$i]);//mengirimkan dan menerima nilai dari model login
	$hasilEknripsiakhir[$i]		=  $enkripbinerkeascii;
	//echo "".$hasilEknripsiakhir[$i];
}


echo "<br />";
print_r($hasilEknripsiakhir);

echo "<h1>hasil enkripsi adalah</h1>";
for ($i=0; $i <count($hasilEknripsiakhir) ; $i++) { 
	echo $hasilEknripsiakhir[$i];
}

	}

public function libraryRead()
{
	$gabunganRumusKey = '';
	$wadah 				= "";
	$wadahnomorarray 	= "";
	// $pesan				= $this->input->post('pesan');
	$kalimat			= 'Bandung';
	$pesan				= "äÃ‡Ø¼Ä€ˮ!ˆ®ÎÔ³ZÚ¶";
	//$string 		= ord($pesan);

	$penggalan = array();
	$panjang=strlen($kalimat);
			for ($i=0; $i < $panjang ; $i++) { 
				$satupersatu = substr($kalimat,$i,1);
				$cek = $this->Ascii2biner->cek($satupersatu);//mengirimkan dan menerima nilai dari model login
				$penggalan[$i] = $cek;
			}
for ($p=0; $p < count($penggalan) ; $p++) { //proses mengeluarkan data yang sudah di masukan kedalam array satu pr satu
	echo  $penggalan[$p]; echo "_";
	$wadah = $wadah.$penggalan[$p];
	$wadahnomorarray = $wadahnomorarray.$p;
}

echo "<br />panjang : ".$panjang;
			echo "<br />kalimat :". $kalimat;
			echo '<br />';
			echo "wadah : ".$wadah." : banyak".strlen($wadah);
			echo "<br />===============================================================||<br />";
echo "pesan yang akan di deskrip adalah : ".$pesan;
$pesanChiper = array();
for ($i=0; $i < strlen($pesan)-1 ; $i++) { 
	if (mb_substr($pesan,$i,1)== '') {
		
	}else{
		$pesanChiper[$i] = mb_substr($pesan,$i,1);
	}
}

print_r($pesanChiper);
$tampil = '';
$wadahauntukmengisiasciikebinerdeskrip = '';
$asciikebinerdeskrip = array();
for ($i=0; $i < count($pesanChiper) ; $i++) {
 $cek = $this->Ascii2biner->cek($pesanChiper[$i]);//mengirimkan dan menerima nilai dari model login
	$wadahauntukmengisiasciikebinerdeskrip = $cek;
	echo $pesanChiper[$i];
	$asciikebinerdeskrip[$i] = $wadahauntukmengisiasciikebinerdeskrip;
	$tampil = $tampil.$asciikebinerdeskrip[$i];
}
// $string = "‘Hello,’ she said.";
// $result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);


//build an array we can re-use across several operations
$badchar=array(
    // control characters
    chr(0), chr(1), chr(2), chr(3), chr(4), chr(5), chr(6), chr(7), chr(8), chr(9), chr(10),
    chr(11), chr(12), chr(13), chr(14), chr(15), chr(16), chr(17), chr(18), chr(19), chr(20),
    chr(21), chr(22), chr(23), chr(24), chr(25), chr(26), chr(27), chr(28), chr(29), chr(30),
    chr(31),
    // non-printing characters
    chr(127)
);
$str = 'g';
//replace the unwanted chars
$str2 = str_replace($badchar, '', $str);
echo "<br/>++++++++++++++++++++++++++++++++++++++++<br />";
$n = strlen($tampil) / 6;

$dataMenyimpanyangdikeluarkan = array();
$putar = ''; //untuk menyimpan data pesna ke 6 bit sementara
$datapenambah = array(); //key yang sudah manjadi 6 bit dan vaid
$pemecah = 0;
$panjangPutar = strlen($putar)-1;
for ($i=0; $i < $n ; $i++) { 
	$no = $i+1;
	if($i == 0){		
				//echo "<br />".$no."_".$wadah;
				$datapenambah[$i] = substr($wadah, $pemecah, 6);
				$dataMenyimpanyangdikeluarkan[$i] = $wadah;
				$wadah = $wadah.$datapenambah[$i];
	}else{
				$datapenambah[$i] = substr($wadah, $pemecah, 6);
				$dataMenyimpanyangdikeluarkan[$i] = substr($wadah, $pemecah, strlen($wadah));
				//echo "<br />_".substr($wadah, $pemecah, 6);
				//echo "<br />".$no."_".$dataMenyimpanyangdikeluarkan[$i];
				//echo "<br/>banyak wadah : ".strlen($wadah);
				$wadah = $wadah.$datapenambah[$i];
		}
		$pemecah = $pemecah + 6;

}
for ($i=0; $i < count($dataMenyimpanyangdikeluarkan) ; $i++) { 
	$no = $i+1;
	$rumus_b[$i] = bindec($datapenambah[$i]);
	echo "<br />".$no." : " .$dataMenyimpanyangdikeluarkan[$i];
	echo " : dalam decimal : ".$rumus_b[$i];

}

print_r($asciikebinerdeskrip);
$rumusdeskripnilai_biner = array();
$hasilcaesardeskrip = array();
$ii = 0;
$wadahdeskrip = '';
//echo "<br />".$tampil;
$rumusdeskripnilai_b = array();//adalah niai dari biner ke desimal
$rumusdeskripnilai_p = array();//adalah niai dari biner ke desimal
for ($i=0; $i < $n ; $i++) { 
	$rumusdeskripnilai_biner[$i] = substr($tampil,$ii ,6);
	$ii = $ii + 6;
	$rumusdeskripnilai_p[$i] = bindec($rumusdeskripnilai_biner[$i]);
	$hasil_chaesar_descript	= $this->Mod64->rumusChaesarRead($rumusdeskripnilai_p[$i],$rumus_b[$i]);
	$hasilcaesardeskrip[$i]	= $hasil_chaesar_descript;
	echo "<br />".$rumusdeskripnilai_biner[$i]."--------------dalam decimal : ".$rumusdeskripnilai_p[$i]."---".$rumus_b[$i]." rumus maka di dapat: ".$hasilcaesardeskrip[$i];
	echo "==========>".sprintf("%06d",decbin($hasilcaesardeskrip[$i]));
	$wadahdeskrip = $wadahdeskrip.sprintf("%06d",decbin($hasilcaesardeskrip[$i]));
}
$ii = 0;
$deskrip_361524 = '';
$carikata = array(); 
echo "<br />".$wadahdeskrip."panjang".strlen($wadahdeskrip);
$setelahjadiascii = '';
for ($i=0; $i <strlen($wadahdeskrip)/8 ; $i++) { 
	$carikata[$i] = substr($wadahdeskrip, $ii,8);
	$ii = $ii + 8;
	$cek = $this->Ascii2biner->biner2ascii($carikata[$i]);//mengirimkan dan menerima nilai dari model login
	$deskrip_361524 = $deskrip_361524.$cek;
	echo "<br />".$carikata[$i]."================>".$cek;
	$setelahjadiascii = $setelahjadiascii.$cek;
}

echo "<br />".$deskrip_361524."============>123456============>361524<br />";
$deskrip_123456 = array();
$ix = 0;
for ($i=0; $i <strlen($deskrip_361524)/6 ; $i++) { 
	$deskrip_123456[$i] = substr($deskrip_361524,$ix,6);
	$ix= $ix + 6;
}
$wadah_123456_array = array();
$wadah_123456 = array();

for ($i=0; $i < count($deskrip_123456) ; $i++) { 

	for ($j=0; $j < 6 ; $j++) { 
			$wadah_123456_array[$j] = substr( $deskrip_123456[$i], $j,1);

	}
$finish = '';
	for ($m=0; $m < 6 ; $m++) { 
		if ($m == 0) {
			echo $wadah_123456_array[2];
		}elseif($m ==1){
			echo $wadah_123456_array[5];
			
		}elseif($m ==2){
			echo $wadah_123456_array[0];
			
		}elseif($m ==3){
			echo $wadah_123456_array[4];
			
		}elseif($m ==4){
			echo $wadah_123456_array[1];
			
		}elseif($m ==5){
			echo $wadah_123456_array[3];
			
		}
	}


}






















	}

public function lib()
	{
		$nama = "ramdan";
		$this->biodata->nama_saya($nama);
	}

public function sub()
{
	$string = 'itu air di bawah';
	$n = strlen($string);
	$sum = $n-2;
	$penggalan = 	substr($string, 0,$sum);
	echo $penggalan.'-'.$n;
}
}
