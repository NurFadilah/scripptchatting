<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyAcount extends CI_Controller {

public function __construct() 
	{
        parent::__construct();
        $this->load->model('Model_login');//inisialisasi model login
    }

public function index()
	{
	if($this->session->userdata('hakAkses') == TRUE){//jika masih ada session 'isnKontak' maka akan di kembalikan ke halaman admin
    		redirect('Home');
        }else{
            $this->load->view('welcome/header');
            $this->load->view('welcome/sigin');
            $this->load->view('welcome/footer');//jika tidak ada sessi0n 'no' maka halman login akan di tampilkan
        }
	}

	function actLogin()//proses login
	{
		$username 	= addslashes(htmlentities($this->input->post('username')));//nilai username yang dikirimkan dari form login
		$pass 		= addslashes(htmlentities(md5($this->input->post('password'))));//nilai password yang dikirimkan dari form login
		//memasukan kedalam array untuk di kirimkan kedalam model
		$where = array(
			'username' => $username,
			'password' => $pass
			);

		$cek = $this->Model_login->cek_login("user",$where);//mengirimkan dan menerima nilai dari model login

		if($cek->num_rows() > 0){//jika di temukan data yang dikirimkan
        	$r = $cek->row_array();
            $data=array('hakAkses'=>$r['isnKontak'],
                'nama'=>$r['nama'],
                'qrcode'=>$r['qrcode'],
                'email'=>$r['email'],
                'gambar'=>$r['gambar']);
           	$this->session->set_userdata($data);//membuat session data yang berbentuk array
            if($this->session->userdata('hakAkses') == TRUE){ 
	        	redirect('Home');
		    }else{
		    	show_404();
		    }                  
        }else{
        	?>
        	<script type="text/javascript">alert('username atau password salah');
        	location.href = 'index';</script>
        	<?php
        }	
	}

public function logout()
    {
        $this->session->sess_destroy();
        redirect('MyAcount');
    }
}
