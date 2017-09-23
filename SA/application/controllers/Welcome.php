<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->model('Model_login');
    }

public function index()
	{	if($this->session->userdata('hakAkses') == TRUE){//jika masih ada session 'isnKontak' maka akan di kembalikan ke halaman admin
    		redirect('Home');
        }else{
		$this->load->view('welcome/header');
		$this->load->view('welcome/sigin');
		$this->load->view('welcome/footer');
	}
}
public function SignUp()
	{
		$this->load->view('welcome/header');
		$this->load->view('welcome/signUp');
		$this->load->view('welcome/footer');
	}
public function register()
	{
		$fild['nama']				= addslashes(htmlentities($this->input->post('nama')));
		$fild['isnKontak']			= addslashes(htmlentities($this->input->post('kode')));
		$fild['online']				= 'online';

		$data['nama']				= addslashes(htmlentities($this->input->post('nama')));
		$data['telepon']			= addslashes(htmlentities($this->input->post('telepon')));
		$data['username']			= addslashes(htmlentities($this->input->post('username')));
		$data['isnKontak']			= addslashes(htmlentities($this->input->post('kode')));
		$data['password']			= addslashes(htmlentities(md5($this->input->post('password'))));
		$data['email']				= addslashes(htmlentities($this->input->post('email')));

		$banyak = $this->Model_login->cek_banyak('kontak');

		$n = $banyak->num_rows();
		if ($n >= 2) {
			echo "untuk sementara hanya di gunakan untuk 2 user";
			?>
<a href="<?php echo base_url() ?>">
			<?php
		}else{
		$insert						= $this->db->insert('user',$data);

		$insert						= $this->db->insert('kontak',$fild);

		if ($insert) {
			$this->session->set_userdata('status','<div class="alert alert-success">
													    <div class="alert-icon fa fa-check-circle"></div>
													    <div class="alert-content">
													        <strong>Sukses Silahkan Login!</strong>
													        <p>Anda Sudah Berhasil daftar silahkan Login.</p>
													    </div>
													</div>'
										);
		}else{
			$this->session->set_userdata('status','<div class="alert alert-danger">
													    <div class="alert-icon fa fa-check-circle"></div>
													    <div class="alert-content">
													        <strong>Gagal Membuat Acount!</strong>
													        <p>silahkan coba beberapa saat lagi.</p>
													    </div>
													</div>'
										);
		}
		redirect('Welcome');
		}

	}
	public function cekBanyak()
	{

		echo $n;
	}
}
